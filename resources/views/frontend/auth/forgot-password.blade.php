@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="login">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto marg">
                <div class="login-main card card-body shadow-lg p-4">
                    <div class="content">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo" />
                            </a>
                        </div>
                        @include('frontend.includes.message')
                        <h1 class="text-center heading2 text-primary mb-4 sec-title-wrapper">Forgot Password</h1>

                        <div class="login-form">
                            <form action="{{ route('resetlink') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label text-grey-300">Please enter your
                                        Email so we
                                        can send you an email to reset your password. <span class="text-secondary">*</span>
                                    </label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm mb-3">
                                    Submit
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
