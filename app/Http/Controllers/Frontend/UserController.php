<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreReviewRequest;
use App\Http\Requests\Frontend\UpdateBillingDetailRequest;
use App\Http\Requests\Frontend\UpdateProfileRequest;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ProductReview;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;


class UserController extends Controller
{
    public function myDashboard()
    {
        return view('frontend.user.dashboard');
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('frontend.user.edit-profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = User::findorFail(Auth::user()->id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        if ($request->current_password && $request->new_password && $request->new_confirm_password) {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => 'required',
                'new_confirm_password' => ['same:new_password'],
            ]);
            User::find(auth()->user()->id)->update(['password' => $request->new_password]);
        }

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function myOrders()
    {
        $myorders = Order::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('frontend.user.orders', compact('myorders'));
    }

    public function orderDetails(Order $order)
    {
        $orderItems = OrderItems::where('order_id', $order->id)->get();
        $billing = BillingAddress::where('user_id', Auth::user()->id)->first();

        return view('frontend.user.order-details', compact('order', 'orderItems', 'billing'));
        // return view('frontend.user.invoice', compact('order', 'orderItems', 'billing'));
    }

    public function billingDetails()
    {
        $billing_address = BillingAddress::where('user_id', Auth::user()->id)->first();
        return view('frontend.user.billing-detail', compact('billing_address'));
    }

    public function billingDetailsUpdate(UpdateBillingDetailRequest $request)
    {
        BillingAddress::updateOrCreate(
            [
                'user_id'   => Auth::user()->id,
            ],
            $request->all()
        );

        return redirect()->back()->with('success', 'Billing Address Update Successfully');
    }

    public function myAccount()
    {
        $user = Auth::user();
        $shipping = ShippingAddress::where('user_id', Auth::user()->id)->first();
        $billing = BillingAddress::where('user_id', Auth::user()->id)->first();
        $orders = Order::where('user_id', $user->id)->latest()->get();
        return view('frontend.user.my-account', compact('orders', 'user', 'shipping', 'billing'));
    }

    public function reviewStore(StoreReviewRequest $request)
    {
        ProductReview::create([
            'comments' => $request->review,
            'status' => 0,
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('message', 'Your review has been submitted. It will be show after admin approved!');
    }
}
