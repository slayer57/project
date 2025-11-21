<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_name',
        'coupon_code',
        'coupon_value',
        'coupon_type',
        'cart_value',
        'description',
        'valid_from',
        'valid_to',
        'status',
    ];
}
