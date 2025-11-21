<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'company_name',
        'phone',
        'email',
        'address',
        'address_2',
        'country',
        'city',
        'postal_code',
        'user_id'
    ];

    public const country = [
        'Nepal' => 'Nepal',
        'Afghanistan' => 'Afghanistan',
        'Bangladesh' => 'Bangladesh',
        'Bhutan' => 'Bhutan',
        'India' => 'India',
        'Maldives' => 'Maldives',
        'Pakistan' => 'Pakistan',
        'Sri Lanka' => 'Sri Lanka',
    ];
}
