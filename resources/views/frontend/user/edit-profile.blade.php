@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="checkout">
        <div class="container mt-3">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="row">
                    @include('frontend.user.includes.menu')

                    <div class="col-md-10 col-sm-12 col-xs-12">
                        @include('frontend.includes.message')
                        <div class="container card card-body shadow-lg p-4">
                            <h3 class="mb-4 sec-title-wrapper">Account Details</h3>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="firstname">First Name <span class="text-secondary">*</span></label>
                                    <input type="text"
                                        class="form-control px-3 mb-0 @error('first_name') is-invalid @enderror"
                                        name="first_name" id="firstname" placeholder="First Name"
                                        value="{{ old('first_name', $user->first_name ?? '') }}">
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
                                        value="{{ old('last_name', $user->last_name ?? '') }}">
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">Email <span class="text-secondary">*</span></label>
                                <input type="email" class="form-control px-3 mb-0 @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="you@example.com"
                                    value="{{ old('email', $user->email ?? '') }}" readonly>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <h4 class="mb-4 mt-3 sec-title-wrapper">Password Change</h4>

                            <div class="form-group">
                                <label for="current_password">Current Password (leave blank to leave unchanged) </label>
                                <input type="password"
                                    class="form-control px-3 mb-0 @error('current_password') is-invalid @enderror"
                                    name="current_password" id="current_password" placeholder=""
                                    value="{{ old('current_password') }}">
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="email">New Password (leave blank to leave unchanged) </label>
                                <input type="password"
                                    class="form-control px-3 mb-0 @error('new_password') is-invalid @enderror"
                                    name="new_password" id="new_password" placeholder="" value="{{ old('new_password') }}">
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <label for="confirm_new_password">Confirm New Password </label>
                                <input type="password"
                                    class="form-control px-3 mb-0 @error('new_confirm_password') is-invalid @enderror"
                                    name="new_confirm_password" id="new_confirm_password" placeholder=""
                                    value="{{ old('new_confirm_password') }}">
                                @error('new_confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"
                                            aria-hidden="true"></i>
                                        Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
