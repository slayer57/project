<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateCouponRequest extends FormRequest
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
    public function rules()
    {
        return [
            // 'promo_name' => ['required', Rule::unique('coupons', 'promo_name')->ignore($this->coupon)],
            'coupon_code' => ['required', Rule::unique('coupons', 'coupon_code')->ignore($this->coupon)],
            'valid_from' => 'required',
            'valid_to' => 'required|after:valid_from',
            'coupon_value' => 'required',
            'cart_value' => 'required',
        ];
    }
}
