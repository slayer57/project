@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="checkout">
        <div class="container">
            <div class="d-flex justify-content-between mt-4 sec-title-wrapper">
                <h3>Checkout</h3>
            </div>
            <div class="my-5">
                <div class="bg-primary text-white p-3">
                    Have a coupon? <a class="text-white" data-bs-toggle="collapse" href="#collapseExample" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        Click here to enter your code
                    </a> </div>
                <div class="collapse border-0  card card-body shadow-lg" id="collapseExample">
                    <div class="container mx-5">
                        <p class="text-gray-300">If you have a coupon code, please apply it below.</p>
                        <div class="coupons flex-fill py-3">
                            <form class="w-50" id="couponform">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control px-4 mb-0" name="coupon_code"
                                        placeholder="Coupon Code">
                                    <button class="input-group-text btn btn-primary px-5 desk-search" type="submit"
                                        id="applycoupon">
                                        Apply <i style="display: none" id="loader" class="fas fa-sync fa-spin"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('frontend.includes.message')
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row ">
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <div class="container card card-body shadow-lg p-4">
                            <h3 class="mb-4 sec-title-wrapper">Billing & Shipping Address</h3>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="firstname">First Name <span class="text-secondary">*</span></label>
                                    <input type="text"
                                        class="form-control px-3 mb-0 @error('first_name') is-invalid @enderror"
                                        name="first_name" id="firstname" placeholder="First Name"
                                        value="{{ old('first_name', $billing_address->first_name ?? '') }}">
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="lastname">Last Name <span class="text-secondary">*</span></label>
                                    <input type="text"
                                        class="form-control px-3 mb-0 @error('last_name') is-invalid @enderror"
                                        name="last_name" id="lastname" placeholder="Last Name"
                                        value="{{ old('last_name', $billing_address->last_name ?? '') }}">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group mt-3">
                                    <label for="company_name">Company Name</label>
                                    <span class="text-muted">(Optional)</span>
                                    <input type="company_name" class="form-control px-3" name="company_name"
                                        id="company_name" placeholder="Company"
                                        value="{{ old('company_name', $billing_address->company_name ?? '') }}">
                                </div>

                                <div class="col-md-6 form-group mt-3">
                                    <label for="phone">Phone <span class="text-secondary">*</span></label>
                                    <input type="phone"
                                        class="form-control px-3 mb-0 @error('phone') is-invalid @enderror" name="phone"
                                        id="phone" placeholder="Phone"
                                        value="{{ old('phone', $billing_address->phone ?? '') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="email">Email <span class="text-secondary">*</span></label>
                                <input type="email" class="form-control px-3 mb-0 @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="you@example.com"
                                    value="{{ old('email', $billing_address->email ?? '') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="adress">Address <span class="text-secondary">*</span></label>
                                <input type="text" class="form-control px-3 mb-0 @error('address') is-invalid @enderror"
                                    name="address" id="address" placeholder="1234 Main Street"
                                    value="{{ old('address', $billing_address->address ?? '') }}">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="address2">Address 2
                                    <span class="text-muted">(Optional)</span>
                                </label>
                                <input type="text" class="form-control px-3" name="address_2" id="adress2"
                                    placeholder="Flat No"
                                    value="{{ old('address_2', $billing_address->address_2 ?? '') }}">
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="country">Country <span class="text-secondary">*</span></label>
                                    <select type="text"
                                        class="form-select px-3 py-2 @error('country') is-invalid @enderror"
                                        name="country" id="country">
                                        <option value>Choose...</option>
                                        @foreach (App\Models\BillingAddress::country as $key => $item)
                                            <option {{ ($billing_address->country ?? '') == $key ? 'selected' : '' }}
                                                value="{{ $key }}">{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="city">Town / City <span class="text-secondary">*</span></label>
                                    <input type="text"
                                        class="form-control @error('city') is-invalid @enderror px-3 mb-0" name="city"
                                        id="city" placeholder="City"
                                        value="{{ old('city', $billing_address->city ?? '') }}">
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3 form-group">
                                    <label for="postcode">Postcode / ZIP</label>
                                    <span class="text-muted">(Optional)</span>
                                    <input type="text" class="form-control px-3" name="postal_code" id="adress2"
                                        placeholder="Postal"
                                        value="{{ old('postal_code', $billing_address->postal_code ?? '') }}">
                                    <div class="invalid-feedback">
                                        Postcode required.
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div id="order-view"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            loadOrderComponent();
        })

        function loadOrderComponent() {
            $.ajax({
                url: "{{ route('order.view') }}",
                type: "GET",
                success: function(data) {
                    $('#order-view').html(data);
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });
        }
    </script>

    <script>
        $('#applycoupon').click(function(e) {
            e.preventDefault();

            var couponFormData = new FormData($('#couponform')[0]);
            $.ajax({
                url: "{{ route('coupon') }}",
                method: 'POST',
                data: couponFormData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(data) {
                    $('#loader').hide();
                    if (data.error == true) {
                        toastr.error(data.message);
                    } else {
                        loadOrderComponent();
                        toastr.success(data.message);
                    }

                    $('#couponform')[0].reset();
                },
                error: function() {
                    $('#loader').hide();
                    alert("Some Problems Occured");
                }
            });
        })
    </script>
@endsection
