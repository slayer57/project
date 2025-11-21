<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;



class StoreCouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'coupon_code' => 'required|unique:coupons',
            'valid_from' => 'required',
            'valid_to' => 'required|after:valid_from',
            'coupon_value' => 'required',
            'cart_value' => 'required',
        ];
    }
}
