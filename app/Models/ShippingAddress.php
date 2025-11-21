<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'full_name',
        'email',
        'address',
        'apartment',
        'city',
        'state',
        'postal_code',
        'phone',
        'country',
        'user_id'
    ];
}
