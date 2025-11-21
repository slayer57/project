<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Order::all();
    }

    public function map($orders): array
    {
        return [
            $orders->id,
            $orders->order_number,
            $orders->payment_method,
            $orders->user->first_name . ' ' . $orders->user->last_name,
            $orders->total_amount,
            $orders->status,
            $orders->transaction_id,
            $orders->transaction_status,
            $orders->coupon->coupon_code ?? 'N/A',
            date('Y-m-d, h:i A', strtotime($orders->created_at)),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order Number',
            'Payment Method',
            'User',
            'Total Amount',
            'Order Status',
            'Transaction ID',
            'Transaction Status',
            'Coupon',
            'Order Placed',
        ];
    }
}
