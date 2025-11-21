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
                        <div class="" id="orderdetail">
                            <section class="invoice-nav">
                                <div class="container">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-3">
                                            <div class="media-wrapper">
                                                <img src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : 'https://leideu.durgaupadhyaya.com.np/frontend/assets/images/logo.png' }}"
                                                    alt="logo">
                                            </div>
                                        </div>
                                        <div class="col-3 heading">
                                            <h1>INVOICE</h1>
                                        </div>
                                    </div>

                                </div>
                            </section>
                            <!-- Navigation Bar Ends -->
                            @if ($order)
                                <!-- User info section Starts -->
                                <section class="invoice-info">
                                    <div class="container">
                                        <div class="row justify-content-between">
                                            <div class="col-6 customer-name">
                                                <h2>Hello, <strong class="text-uppercase">{{ $billing->first_name ?? '' }}
                                                        {{ $billing->last_name ?? '' }}</strong></h2>
                                                <p>Thank you for shopping from our store and for your order.</p>
                                            </div>
                                            <div class="col-3">
                                                <h2>ORDER #<span class="order">{{ $order->order_number ?: 'N/A' }}</span>
                                                </h2>
                                                <h2>
                                                    {{ date('F d Y, h:i A', strtotime(now())) }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- User info section Ends -->

                                <!-- Invoice Form section Starts -->
                                <section class="invoice-form">
                                    <div class="container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">PRICE</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($orderItems as $item)
                                                    @php
                                                        $subTotal = $item->product->price * $item->quantity;
                                                        $total += $subTotal;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $item->product->name }}</td>
                                                        <td>R.s {{ number_format($item->product->price) }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>R.s {{ number_format($subTotal) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                                <!-- Invoice Form section Ends -->

                                <!-- Invoice Result Starts -->
                                <section class="invoice-result">
                                    <div class="container">
                                        <div class="d-flex justify-content-end">
                                            <div class="invoice-result-content">
                                                <div class="subtotal d-flex justify-content-between">
                                                    <h6>Subtotal</h6>
                                                    <p>Rs. {{ number_format($total) }}</p>
                                                </div>
                                                <div class="shipping d-flex justify-content-between">
                                                    <h6>Shipping</h6>
                                                    <p>Rs. {{ getShippingCharge() }}</p>
                                                </div>

                                                @if ($order->coupon)
                                                    <div class="shipping d-flex justify-content-between">
                                                        <h6>Coupon</h6>
                                                        <p>{{ $order->coupon->coupon_type == 'fixed' ? 'R.s ' : '' }}{{ $order->coupon->coupon_value ?? '' }}{{ $order->coupon->coupon_type == 'percent' ? '%' : '' }}
                                                        </p>
                                                    </div>
                                                @endif
                                                <div class="total d-flex justify-content-between">
                                                    <h6><b>Grand Total (Incl. Tax)</b></h6>
                                                    <p class="g-total">Rs. {{ number_format($order->total_amount, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <!-- Invoice Result Ends -->

                                <!-- Invoice Billing Section Sta -->
                                <section class="invoice-billing seperater">
                                    <div class="container">
                                        <div class="d-flex justify-content-between">
                                            <div class="invoice-billing-information">
                                                <fieldset class="border p-3">
                                                    <legend class="float-none w-auto legend-title">
                                                        <h4 class="mb-0">BILLING INFORMATION</h4>
                                                    </legend>

                                                    <div class="name">
                                                        <p class="">Full Name : <span class="text-uppercase">
                                                                {{ $billing->first_name ?? '' }}
                                                                {{ $billing->last_name ?? '' }}</span></p>
                                                    </div>
                                                    <div class="address">
                                                        <p>Address : {{ $billing->address ?? '' }},
                                                            {{ $billing->city ?? '' }},
                                                            {{ $billing->country ?? '' }}</p>
                                                    </div>

                                                    @if ($billing->address_2)
                                                        <div class="address">
                                                            <p>Address 2 : {{ $billing->address_2 ?? '' }}</p>
                                                        </div>
                                                    @endif

                                                    <div class="phone">
                                                        <p>Contact: {{ $billing->phone ?? '' }}</p>
                                                    </div>
                                                    @if ($billing->postal_code)
                                                        <div class="state">
                                                            <p>Postal : {{ $billing->postal_code ?? '' }}</p>
                                                        </div>
                                                    @endif
                                                    <div class="state">
                                                        <p>Email : {{ $billing->email ?? '' }}</p>
                                                    </div>
                                                    @if ($billing->company_name)
                                                        <div class="state">
                                                            <p>Company : {{ $billing->company_name ?? '' }}</p>
                                                        </div>
                                                    @endif
                                                </fieldset>


                                            </div>
                                            <div class="invoice-billing-payment">
                                                <fieldset class="border p-3">
                                                    <legend class="float-none w-auto legend-title">
                                                        <h4 class="mb-0">PAYMENT METHOD</h4>
                                                    </legend>

                                                    <div class="info">
                                                        <p>Payment Method: {{ $order->payment_method ?: 'N/A' }}</p>
                                                    </div>

                                                    <div class="transaction">
                                                        <p>Transaction ID: {{ $order->transaction_id ?: 'N/A' }}</p>
                                                    </div>
                                                    <div class="right">
                                                        <p>Transaction Status:
                                                            {{ $order->transaction_status ?: 'Not Paid' }}
                                                        </p>
                                                    </div>
                                                </fieldset>

                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </section>
@endsection
