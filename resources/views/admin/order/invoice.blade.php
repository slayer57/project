@extends('layouts.admin.master')
@section('title', 'Orders')

@section('content')
    <style>
        .invoice-nav {
            margin-bottom: 30px;
        }

        .invoice-nav .media-wrapper {
            width: 150px;
            height: 45px;
            overflow: hidden !important;
        }

        .invoice-nav .media-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .invoice-nav h1 {
            color: #007c00;
            font-size: 2rem !important;
            font-weight: 500 !important;
            line-height: 120% !important;
        }

        .invoice-info {
            margin-bottom: 25px;
        }

        .invoice-info h2 {
            font-size: 1rem !important;
            font-weight: 400 !important;
            line-height: 150% !important;
            color: #414141;
        }

        .invoice-info p {
            font-size: 1rem !important;
            font-weight: 400 !important;
            line-height: 180% !important;
        }

        .invoice-info h3 {
            font-size: 1rem !important;
            font-weight: 400 !important;
            line-height: 150% !important;
            color: #414141;
        }

        .invoice-form {
            margin-bottom: 50px;
        }

        .invoice-form tr {
            border-bottom: 1px solid #566a7f
        }

        .invoice-form th {
            font-size: 1.125rem !important;
            font-weight: 400 !important;
            line-height: 150% !important;
            color: #414141;
        }

        .invoice-form td {
            padding: 15px;
            font-size: 1rem;
            font-weight: 300;
            line-height: 150%;
            color: #414141;
        }

        .invoice-form td:nth-child(1) {
            color: #007c00;
            font-weight: 500 !important;
        }

        .invoice-result {
            margin-bottom: 40px;
        }

        .invoice-result-content {
            min-width: 280px;
        }

        .invoice-result-content h6 {
            font-size: 1rem;
            font-weight: 400;
            line-height: 150%;
            color: #696969 !important;
        }

        .invoice-result-content .total h6 {
            font-weight: 600 !important;
        }

        .invoice-result-content .total p {
            font-weight: 600 !important;
        }

        .invoice-billing {
            margin-bottom: 40px;
        }

        .invoice-billing h4 {
            font-size: 1.125rem !important;
            font-weight: 700 !important;
            line-height: 150% !important;
            color: #696969;
        }

        .invoice-billing p {
            font-size: 1rem !important;
            font-weight: 500 !important;
            line-height: 180% !important;
            color: #414141;
            margin: 5px 0;
        }

        .invoice-message {
            font-size: 1.5rem !important;
            font-weight: 500 !important;
            line-height: 150% !important;
            color: #414141;
        }

        /*# sourceMappingURL=style.css.map */
    </style>
    @include('admin.includes.message')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Order "{{ $order->order_number ?? '' }}" </h5>
                <small class="text-muted float-end">
                    <a href="javascript:void()" class="btn btn-secondary" onclick="printdiv()"><i class="fa fa-print"
                            aria-hidden="true"></i> Print
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                </small>
            </div>
            <div class="card-body">
                <div class="card-body">
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
                                            <h2>ORDER #<span class="order">{{ $order->order_number ?: 'N/A' }}</span></h2>
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
                                                    <p>Transaction Status: {{ $order->transaction_status ?: 'Not Paid' }}
                                                    </p>
                                                </div>
                                            </fieldset>
                                            {{-- <div class="type">
                                                <p>Registered Customer: {{ $order->user->email ?? 'Not Registered' }}</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Invoice Billing Section Ends -->
                            <section class="invoice-message" id="noprint">
                                <div class="container">
                                    <div class="div mt-3" id="noprint">
                                        <fieldset class="border p-3">
                                            <legend class="float-none w-auto legend-title">
                                                <h6 class="font-weight-bold mb-0">
                                                    Status Action
                                                </h6>
                                            </legend>
                                            <form class="" action="{{ route('admin.order.status', $order->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h6>Order Status</h6>
                                                        <select class="form-select" name="status" id="">
                                                            @foreach (App\Models\Order::status as $key => $value)
                                                                <option value="{{ $key }}"
                                                                    {{ old('status', $order->status) == $key ? 'selected' : '' }}>
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6>Payment Status</h6>
                                                        <select class="form-select" name="transaction_status"
                                                            id="">
                                                            @foreach (App\Models\Order::paystatus as $key => $value)
                                                                <option value="{{ $value }}"
                                                                    {{ old('transaction_status', $order->transaction_status) == $key ? 'selected' : '' }}>
                                                                    {{ $key }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6></h6>
                                                        <button class="btn btn-primary mt-2" type="submit"><i
                                                                class="fa-solid fa-rotate"></i>
                                                            Update</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </fieldset>
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Bar Starts -->
@endsection

@section('scripts')
    <script>
        function printdiv() {
            var newstr = document.getElementById("orderdetail").innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = newstr;
            window.print();
            window.location.reload();
            return false;
        }
    </script>
@endsection
