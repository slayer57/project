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

                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="container card card-body shadow-lg p-4">
                        <h3 class="mb-4 sec-title-wrapper">Dashboard</h3>
                        <div class="table-responsive text-nowrap">

                            <p class="text-grey-300 fw-600">Hello <b>{{ Auth::user()->first_name ?? '' }}
                                    {{ Auth::user()->last_name ?? '' }}</b>, ({{ Auth::user()->email ?? '' }} <a
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('userlogout-form').submit();">Log
                                    out?</a> )
                            </p>
                            <p class="text-grey-300 mt-4"> From your account <a
                                    href="{{ route('mydashboard') }}">dashboard</a> you can view
                                your <a href="{{ route('myorder') }}">recent orders,</a>
                                manage
                                your
                                <a href="{{ route('billing.details') }}"> billing addresses,</a>
                                and <a href="{{ route('profile.edit') }}">edit your password and account details.</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
