<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::when($request->search, function ($query) use ($request) {
            $query->where('order_number', 'LIKE', '%' . $request->search . '%');
        })->when($request->start_date, function ($query) use ($request) {
            $query->whereDate('created_at',  '>=', $request->start_date);
        })->when($request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at',  '<=', $request->end_date);
        })->latest()->paginate(10);

        $searchParams =  $_GET ?? '';

        return view('admin.order.index', compact('orders', 'searchParams'));
    }

    public function orderItems(Order $order)
    {
        $order->update([
            'is_seen' => 1
        ]);
        $orderItems = OrderItems::where('order_id', $order->id)->get();
        $shipping = ShippingAddress::where('user_id', $order->user_id)->first();
        $billing = BillingAddress::where('user_id', $order->user_id)->first();
        // return view('admin.order.order-items', compact('order', 'orderItems', 'shipping', 'billing', 'settings'));
        return view('admin.order.invoice', compact('order', 'orderItems', 'billing'));
    }

    public function changeOrderStatus(Request $request, Order $order)
    {
        if ($order->status == 'Delivered') {
            return redirect()->back()->with('error', 'This order has already been delivered');
        }
        $order->update([
            'status' => $request->status,
            'transaction_status' => $request->transaction_status
        ]);

        return redirect()->back()->with('message', 'Order status changed');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        $order->orderitems()->delete();
        return redirect()->back()->with('success', 'Order Deleted');
    }

    public function invoice()
    {
        $order = Order::find(3);
        $orderItems = OrderItems::where('order_id', $order->id)->get();
        $shipping = ShippingAddress::where('user_id', $order->user_id)->first();
        $billing = BillingAddress::where('user_id', $order->user_id)->first();
        return view('admin.order.invoice', compact('order', 'orderItems', 'billing'));
    }

    public function excelExport()
    {
        $filename = date('YmdHis');
        return Excel::download(new OrdersExport, "$filename.xlsx");
    }
}
