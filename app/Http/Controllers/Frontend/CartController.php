<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class CartController extends Controller
{
    public function index()
    {
        session()->forget('couponDiscount');

        $cartItems = \Cart::getContent();
        $related_products = Product::where('status', 1)->inRandomOrder()->limit(6)->get();
        return view('frontend.cart.index', compact('cartItems', 'related_products'));
    }

    public function store(Request $request)
    {
        $product = Product::where('id', $request->product_id)->first();
        $quantity = $request->quantity;

        if ($request->quantity <= 1) {
            $quantity = 1;
        }

        $cart = \Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity ?? 1,
            'attributes' => array(
                'image' => $product->featured_image,
                'product_id' => $product->id
            )
        ]);

        if ($request->buynow == 'yes') {
            return 'checkout';
        }

        return $this->cartTotalQuantity();
    }

    public function cartItems()
    {
        $cartItems = \Cart::getContent()->sort();
        return view('frontend.cart.component', compact('cartItems'));
    }

    public function cartItemsIncrease($id)
    {
        $row = \Cart::get($id);
        $qty = $row->quantity + 1;
        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $qty
            ],
        ]);
    }

    public function cartItemsDecrease($id)
    {
        $row = \Cart::get($id);
        $qty = $row->quantity - 1;
        if ($qty < 1) {
            $qty = 1;
        }

        \Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $qty
            ],
        ]);
    }

    public function cartItemsRemove($id)
    {
        \Cart::remove($id);
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->forget('couponDiscount');
        return redirect()->back();
    }

    public function cartTotalQuantity()
    {
        return \Cart::getContent()->count();
    }

    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where(DB::raw('BINARY `coupon_code`'), $request->coupon_code)->where('status', 1)->first();
        if ($coupon) {
            $startDate = Carbon::createFromFormat('Y-m-d', $coupon->valid_from);
            $endDate = Carbon::createFromFormat('Y-m-d', $coupon->valid_to);

            $valid = Carbon::now()->startOfDay()->between($startDate, $endDate);

            if ($valid == true) {

                if (\Cart::getTotal() < $coupon->cart_value) {
                    return [
                        'message' => 'You have atleast R.s ' . $coupon->cart_value . ' value in your cart',
                        'error' => true
                    ];
                }

                if (\Cart::getTotal() < $coupon->coupon_value) {
                    return [
                        'message' => 'coupon discount value greater than your cart value',
                        'error' => true
                    ];
                }

                $couponData = [
                    'couponvalue' => $coupon->coupon_value,
                    'coupontype' => $coupon->coupon_type,
                    'couponid' => $coupon->id,
                ];

                Session::put('couponDiscount', $couponData);

                return [
                    'message' => 'Coupon Applied',
                    'error' => false
                ];
            } else {
                return [
                    'message' => 'Invalid Date',
                    'error' => true
                ];
            }
        } else {
            return [
                'message' => 'Invalid Coupon',
                'error' => true
            ];
        }
    }
}
