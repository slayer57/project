<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'payment_method',
        'user_id',
        'total_amount',
        'status',
        'transaction_id',
        'transaction_status',
        'is_seen',
        'coupon_id'
    ];

    public const status = [
        'Pending' => 'Pending',
        'Delivered' => 'Delivered',
        'Cancelled' => 'Cancelled',
        'Failed' => 'Failed',
    ];

    public const paystatus = [
        'Not Paid' => '',
        'Success' => 'Success',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderitems()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
