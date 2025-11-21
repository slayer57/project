<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreCheckoutRequest;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = \Cart::getContent()->sort();

        $billing_address = '';
        if (Auth::check()) {
            $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
        }

        if (!session()->has('errors')) {
            session()->forget('couponDiscount');
        }

        return view('frontend.checkout.index', compact('cartItems', 'billing_address'));
    }

    public function store(StoreCheckoutRequest $request)
    {
        $cartItems = \Cart::getContent()->sort();
        if ($cartItems->count() < 1) {
            return redirect()->back()->with('error', 'No items found in cart. Please select atleast one');
        }

        $total_amount = getTotalAmount();
        $order_number = date('YmdHis');

        if (Session::has('couponDiscount')) {
            $coupon =  Session::get('couponDiscount');
            $coupon_id = $coupon['couponid'];
        }

        $order = Order::create([
            'order_number' => $order_number,
            'payment_method' => $request->payment_method ?? '',
            'user_id' => Auth::user()->id ?? 0,
            'total_amount' => $total_amount ?? 0,
            'status' => 'Pending',
            'transaction_id' => '',
            'transaction_status' => '',
            'is_seen' => 0,
            'coupon_id' => $coupon_id ?? NULL
        ]);

        foreach ($cartItems as $item) {
            OrderItems::create([
                'order_id' => $order->id ?? '',
                'product_id' => $item->attributes->product_id ?? '',
                'quantity' => $item->quantity ?? '',
                'price' => $item->price ?? '',
            ]);
        }

        $billing_shipping_data = [
            'order_id' => $order->id ?? '',
            'first_name' => $request->first_name ?? '',
            'last_name' => $request->last_name ?? '',
            'company_name' => $request->company_name ?? '',
            'phone' => $request->phone ?? '',
            'email' => $request->email ?? '',
            'address' => $request->address ?? '',
            'address_2' => $request->address_2 ?? '',
            'country' => $request->country ?? '',
            'city' => $request->city ?? '',
            'postal_code' => $request->postal_code ?? '',
            'user_id' => Auth::user()->id ?? 0,
        ];

        BillingAddress::updateOrCreate(
            [
                'user_id'   => Auth::user()->id,
            ],
            $billing_shipping_data
        );

        if ($request->payment_method == 'eSewa') {
            return view('frontend.payment.esewa', compact('order_number'));
        }

        \Cart::clear();
        session()->forget('couponDiscount');

        return redirect()->route('checkout.thankyou', $order_number);
    }

    public function thankyou($order_number)
    {
        \Cart::clear();

        return view('frontend.checkout.thankyou', compact('order_number'));
    }

    public function esewaSuccess(Request $request)
    {
        $status = $request->q;

        if ($status == 'su') {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $order = Order::where('order_number', $request->oid)->first();
            $order->update(['transaction_status' => 'processing']);

            $data = [
                'amt' => $order->total_amount ?? NULL,
                'rid' => $request->refId,
                'pid' => $order->order_number ?? NULl,
                'scd' => 'EPAYTEST'
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            if (strpos($response, 'Success')) {
                $order->update([
                    'transaction_id' => $request->refId,
                    'transaction_status' => 'Success',
                ]);

                \Cart::clear();
                session()->forget('couponDiscount');

                return redirect()->route('checkout.thankyou', $order->order_number);
            } else {
                $order->update([
                    'transaction_id' => $request->refId,
                    'transaction_status' => 'Failed',
                ]);
                session()->forget('couponDiscount');

                dd('transaction failed');
            }
        } else {
            dd('transaction failed');
        }
    }

    public function esewaFailure(Request $request)
    {
        session()->forget('couponDiscount');
        return redirect()->route('checkout')->with('error', 'Payment could not be made.');
    }

    public function OrderItems()
    {
        $cartItems = \Cart::getContent()->sort();
        return view('frontend.checkout.order-component', compact('cartItems'));
    }
}
