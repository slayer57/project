@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="checkout">
        <div class="container mt-3">
            <div class="row">
                @include('frontend.user.includes.menu')
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="container card card-body shadow-lg p-4">
                        <h4 class="text-center"><u>Order Details</u></h4>
                        <div class="order-number-container d-flex justify-content-between mt-5 p-2 profile-sub-container">
                            <div class="order-info-wrapper ms-3">
                                <h5>Order <span
                                        class="order-number text-grey-300 fw-600">#{{ $order->order_number ?? '' }}</span>
                                </h5>

                            </div>
                            <div class="back">
                                <a href="{{ route('myorder') }}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i> Back</a>
                            </div>
                        </div>
                        <div class="product-description-container ms-4">
                            <div class="hr my-4"></div>
                            @if ($orderItems->count() > 0)
                                @php
                                    $total = 0;
                                @endphp
                                <table class="table table-border table-sm">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                    @foreach ($orderItems as $item)
                                        @php
                                            $subTotal = $item->product->price * $item->quantity;
                                            $total += $subTotal;
                                        @endphp
                                        <tr>
                                            <td> <img
                                                    src="{{ asset('admin/images/product/' . ($item->product->featured_image ?? '')) }}"
                                                    class="product-img" alt="product" srcset="" height="50"></td>
                                            <td> {{ $item->product->name ?? '' }}</td>
                                            <td> {{ number_format($item->price ?? '') }}</td>
                                            <td> {{ $item->quantity ?? 0 }}</td>
                                            <td>{{ number_format($subTotal ?? 0) }}</td>
                                        </tr>
                                        <div class="hr my-4"></div>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        @if ($order->coupon)
                                            <td>Coupon Discount
                                            </td>
                                            <td class="text-primary">
                                                {{ $order->coupon->coupon_type == 'fixed' ? 'R.s ' : '' }}{{ $order->coupon->coupon_value ?? '' }}{{ $order->coupon->coupon_type == 'percent' ? '%' : '' }}
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        <td>{{ number_format($order->total_amount ?? 0) }}
                                        </td>
                                    </tr>
                                </table>
                            @endif

                        </div>
                        <div class="order-details-bottom-container">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-6 col-12 ml-md-2 p-3 profile-sub-container">
                                    <fieldset class="border p-3">
                                        <legend class="float-none w-auto legend-title">
                                            <h6 class="font-weight-bold mb-0">
                                                Billing Details
                                            </h6>
                                        </legend>

                                        <div class="shipping-address-container">
                                            <p class="orderReciverName">Full Name:
                                                {{ $billing->first_name ?? '' }}
                                                {{ $billing->last_name ?? '' }}
                                            </p>
                                            <p class="order-shipping address">Address: {{ $billing->address ?? '' }},
                                                {{ $billing->city ?? '' }},
                                                {{ $billing->country ?? '' }}</p>

                                            @if ($billing->address_2)
                                                <p class="order-shipping address">Address 2:
                                                    {{ $billing->address_2 ?? '' }}
                                                </p>
                                            @endif

                                            <p class="order-shipping-contact">Contact:
                                                {{ $billing->phone ?? '' }}</p>

                                            @if ($billing->postal_code)
                                                <p class="order-shipping address">Postal:
                                                    {{ $billing->postal_code ?? '' }}
                                                </p>
                                            @endif
                                            <p class="order-shipping-contact">Email:
                                                {{ $billing->email ?? '' }}</p>
                                            @if ($billing->company_name)
                                                <p class="order-shipping address">Company:
                                                    {{ $billing->company_name ?? '' }}
                                                </p>
                                            @endif
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-5 col-12 mx-md-2 p-3 profile-sub-container">
                                    <fieldset class="border p-3">
                                        <legend class="float-none w-auto legend-title">
                                            <h6 class="font-weight-bold mb-0">
                                                Payment Summary
                                            </h6>
                                        </legend>

                                        <div class="text-left">
                                            <div class="items-summary d-flex justify-content-between">

                                                <p class="">Cart Total:</p>
                                                <p class="totalCartItem price">{{ number_format($total ?? '') }}</p>
                                            </div>
                                            <div class="cart-total-container d-flex justify-content-between">
                                                <p class="">Delivery Cost:</p>
                                                <p class="totalCartPrice price">{{ getShippingCharge() }}</p>
                                            </div>

                                            @if ($order->coupon)
                                                <div class="cart-total-container d-flex justify-content-between">
                                                    <p class="">Coupon Discount:</p>
                                                    <p class="totalCartPrice price text-primary">
                                                        {{ $order->coupon->coupon_type == 'fixed' ? 'R.s ' : '' }}{{ $order->coupon->coupon_value ?? '' }}{{ $order->coupon->coupon_type == 'percent' ? '%' : '' }}
                                                    </p>
                                                </div>
                                            @endif

                                            <div class="hr"></div>
                                            <div class="cart-total-container d-flex justify-content-between mt-2">
                                                <p class="font-weight-bold fw-600">Total:</p>
                                                <p class="totalCartPrice price font-weight-bold fw-600">
                                                    R.s. {{ number_format($order->total_amount ?? 0, 2) }}
                                                </p>
                                            </div>
                                            <div class="cart-payment-type">
                                                <div class="hr my-2"></div>
                                                <p class="payment-type">Paid with
                                                    <span class="text-primary">{{ $order->payment_method ?: 'N/A' }}</span>
                                                </p>

                                                <p class="mt-1">Order Status:
                                                    {{ $order->status ?: 'N/A' }}</p>

                                                <p class="mt-1">Pay Status:<span
                                                        class="bg-primary text-white text-success m-1 p-1">
                                                        {{ $order->transaction_status ?: 'Not Paid' }}</span></p>
                                            </div>
                                        </div>
                                </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </section>
@endsection
