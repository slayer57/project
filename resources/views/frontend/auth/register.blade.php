@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="login">
        <div class="row">
            <div class="col-md-6 col-sm-12 mx-auto marg">
                <div class="login-main card card-body shadow-lg p-4">
                    <div class="content">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('frontend/assets/images/logo.png') }}"
                                    alt="logo" />
                            </a>
                        </div>
                        <h1 class="text-center heading2 text-primary mb-4 sec-title-wrapper">Register</h1>
                        <div class="login-form">
                            <form action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                    <div class="form-floating col-md-6">
                                        <input type="text" name="first_name"
                                            class="form-control  @error('first_name') is-invalid @enderror"
                                            id="floatingInput" placeholder="your first name"
                                            value="{{ old('first_name') }}" />
                                        <label for="floatingInput" class="px-4">First Name</label>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-floating col-md-6">
                                        <input type="text" name="last_name"
                                            class="form-control @error('last_name') is-invalid @enderror" id="floatingInput"
                                            placeholder="your last name" value="{{ old('last_name') }}" />
                                        <label for="floatingInput" class="px-4">Last Name</label>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                                        placeholder="name@example.com" value="{{ old('email') }}" />
                                    <label for="floatingInput">Email address</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                                        placeholder="Password" />
                                    <label for="floatingPassword">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-floating">
                                    <input type="password" name="password_confirm"
                                        class="form-control @error('password_confirm') is-invalid @enderror"
                                        id="floatingPassword" placeholder="Password" />
                                    <label for="floatingPassword">Confirm Password</label>
                                    @error('password_confirm')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary my-3">
                                    Register
                                </button>

                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        By signing to Leideu you agree our website
                                        <a href="{{ route('page.show', 'terms-and-conditions') }}" target="_blank">
                                            terms and
                                            conditions</a>
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>

                                <div class="login">
                                    <p> Already have an account?<a href="{{ route('login') }}"> Login</a></p>

                                </div>
                            </form>
                        </div>

                        <p class="divider line one-line text-grey-200">Sign in with:</p>

                        <div class="media d-flex gap-8 justify-content-center mt-4">
                            <div class="facebook d-flex align-items-center position-relative mb-2">
                                <i class="fa-brands fa-square-facebook"></i>
                                <h2 class="d-flex align-items-center">LOGIN WITH FACEBOOK</h2>
                                <a href="{{ route('login.facebook') }}" class="stretched-link"></a>
                            </div>
                            <div class="google d-flex align-items-center position-relative mb-2">
                                <i class="fa-brands fa-google"></i>
                                <h2 class="d-flex align-items-center">LOGIN WITH GOOGLE</h2>
                                <a href="{{ route('login.google') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
