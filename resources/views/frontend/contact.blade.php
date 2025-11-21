@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection

@section('content')
    <section class="contact">
        <div class="contact-banner bg-primary mb-4">
            <div class="container">
                <h1 class="text-white px-3">Contact Us</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 ps-3">
                    <p>
                        {{ $settings['contact_section_description'] ?? '' }}
                    </p>
                    <div class="contact-email paragraph d-flex my-4">
                        <i class="fa-solid fa-envelope text-primary pt-2"></i>
                        <p class="text-grey-200 align-items-center px-3">
                            Send us an email <br />
                            {{ $settings['site_email'] ?? '' }}
                        </p>
                    </div>
                    <div class="contact-phone paragraph d-flex mb-4">
                        <i class="fa-solid fa-phone text-primary pt-2"></i>
                        <p class="text-grey-200 align-items-center px-3">
                            Give us a call <br />
                            {{ $settings['site_contact'] ?? '' }}
                        </p>
                    </div>

                    <div class="contact-address paragraph d-flex mb-5">
                        <i class="fa-solid fa-location-dot text-primary pt-2"></i>
                        <p class="text-grey-200 align-items-center px-3">
                            Visit our office <br />
                            {{ $settings['site_location'] ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="social">
                        <h3 class="heading-4 text-secondary">Get in touch</h3>
                        <div class="social text-primary bold mt-4">
                            @foreach ($socialmedias as $media)
                                <a href="{{ $media->link ?? '' }}"><i
                                        class="fa-brands {{ $media->icon ?? '' }} mx-2"></i></a>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="contact-form">
                        @include('frontend.includes.message')

                        <form class="text-primary" action="{{ route('inquiry') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Full Name</label>
                                <input type="text" name="full_name"
                                    class="form-control mt-2 @error('full_name') is-invalid @enderror" id="name"
                                    placeholder="Enter your full name" class="br-0" value="{{ old('full_name') }}" />
                                @error('full_name')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email"
                                    class="form-control mt-2 @error('email') is-invalid @enderror" id="email"
                                    placeholder="Enter your email address" value="{{ old('email') }}" />
                                @error('email')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone"
                                    class="form-control mt-2 @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="Enter your phone" />
                                @error('phone')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control mt-2 @error('message') is-invalid @enderror" id="" cols="30"
                                    rows="6" placeholder="Leave a message"></textarea>
                                @error('message')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-secondary text-white py-2 mt-4">
                                Inquiry Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
