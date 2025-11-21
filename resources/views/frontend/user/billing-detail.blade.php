@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="checkout">
        <div class="container mt-3">
            <form action="{{ route('billing.details.update') }}" method="POST">
                @csrf
                <div class="row">
                    @include('frontend.user.includes.menu')
                    <div class="col-md-10 col-sm-12 col-xs-12">
                        @include('frontend.includes.message')

                        <div class="container card card-body shadow-lg p-4">
                            <h3 class="mb-4 sec-title-wrapper">Billing Details</h3>
                            <form action="billing.details.update" method="POST">
                                @csrf
                                <div class="row ">
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
                                                class="form-control px-3 mb-0 @error('phone') is-invalid @enderror"
                                                name="phone" id="phone" placeholder="Phone"
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
                                        <input type="email"
                                            class="form-control px-3 mb-0 @error('email') is-invalid @enderror"
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
                                        <input type="text"
                                            class="form-control px-3 mb-0 @error('address') is-invalid @enderror"
                                            name="address" id="adress" placeholder="1234 Main Street"
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
                                                    <option
                                                        {{ ($billing_address->country ?? '') == $key ? 'selected' : '' }}
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
                                            <label for="city">Town / City <span
                                                    class="text-secondary">*</span></label>
                                            <input type="text"
                                                class="form-control @error('city') is-invalid @enderror px-3 mb-0"
                                                name="city" id="city" placeholder="City"
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
                                            <input type="text" class="form-control px-3" name="postal_code"
                                                id="postal_code" placeholder="Postal"
                                                value="{{ old('postal_code', $billing_address->postal_code ?? '') }}">
                                            <div class="invalid-feedback">
                                                Postcode required.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"
                                                    aria-hidden="true"></i>
                                                Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
