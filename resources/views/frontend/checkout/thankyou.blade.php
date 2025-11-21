@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <div class="container-fluid mx-auto my-5">
        <div class="container mx-auto">
            <div class="col-12 d-flex justify-content-center align-content-center">
                <div class="">
                    <div class="row d-flex justify-content-center mt-3">
                        <div class="col-sm-6 col-12 order-confirm-img-container">
                            <img class="img-fluid" src="https://media.tenor.com/YiscpdGUTFYAAAAj/clipp-delivery-kradac.gif"
                                alt="">
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mx-auto">
                        <div class="col-12 text-center">
                            <h2 class="p-3 text-primary">Thank You for your order</h2>
                            <p>Your order has been confirmed. You can easily track your order using your order ID <span
                                    class="text-grey-300 fw-600 order-id"> #{{ $order_number ?? '' }}</span></p>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
