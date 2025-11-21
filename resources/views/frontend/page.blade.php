@extends('layouts.frontend.master')

@section('seo')
    <title>{{ $settings['homepage_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['homepage_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['homepage_seo_description'] ?? 'Leideu' }}">
@endsection

@section('content')
    <div class="bg-img-hero text-center mb-5 mb-lg-8"
        style="background-image: url('{{ $pagedetail->banner_image ? asset('admin/images/page/' . $pagedetail->banner_image) : asset('frontend/assets/images/banner.jpg') }}');">
        <div class="container space-top-xl-1 py-6 py-xl-0">
            <div class="row justify-content-center py-xl-4">
                <!-- Info -->
                <div class="py-xl-10 py-5">
                    <h1 class="font-size-40 font-size-xs-30 text-white font-weight-bold mb-0">
                        {{ $pagedetail->title ?? '' }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter justify-content-center mb-0">
                            <li class="breadcrumb-item font-size-14"><a class="text-white"
                                    href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item custom-breadcrumb-item text-white font-size-14 active"
                                aria-current="page">
                                {{ $pagedetail->title ?? '' }}</li>
                        </ol>
                    </nav>
                </div>
                <!-- End Info -->
            </div>
        </div>
    </div>
    <div class="container mb-4 mt-4">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <h4 class="text-size-21 font-weight-semi-bold text-gray-3 mb-3 pb-1">
                    {{ $pagedetail->title ?? '' }}</h4>
                <p class="text-lh-lg text-gray-1">{!! $pagedetail->description ?? '' !!}</p>

            </div>
        </div>
    </div>
@endsection
