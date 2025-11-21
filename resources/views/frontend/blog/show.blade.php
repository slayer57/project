@extends('layouts.frontend.master')

@section('seo')
    <title>{{ $blogdetails->seo_title ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $blogdetails['meta_keywords'] ?? '' }}">
    <meta name="description" content="{{ $blogdetails['meta_description'] ?? '' }}">
@endsection

@section('content')
    <main id="content" class="">
        <div class="bg-img-hero text-center mb-5 mb-lg-8"
            style="background-image: url({{ $blogdetails->banner_image ? asset('admin/images/blog/' . $blogdetails->banner_image) : asset('frontend/assets/img/banner.jpg') }});">
            <div class="container space-top-xl-3 py-6 py-xl-0">
                <div class="row justify-content-center py-xl-4">
                    <!-- Info -->
                    <div class="py-xl-10 py-5">
                        <h1 class="font-size-40 font-size-xs-30 text-white font-weight-bold mb-0">Blogs</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter justify-content-center mb-0">
                                <li class="breadcrumb-item font-size-14"> <a class="text-white"
                                        href="{{ route('home') }}">Home</a> </li>
                                <li class="breadcrumb-item custom-breadcrumb-item font-size-14 text-white active"
                                    aria-current="page"><a class="text-white" href="{{ route('blogs') }}">Blogs</a></li>
                                <li class="breadcrumb-item custom-breadcrumb-item font-size-14 text-white active"
                                    aria-current="page">{{ $blogdetails->title ?? '' }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Info -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cars-list">
                <div class="row">
                    <div class="col-lg-8 col-xl-9">
                        <img class="img-fluid rounded-xs w-100"
                            src="{{ asset('admin/images/blog/' . $blogdetails->image) }}"
                            alt="Pityful a rethoric question ran">

                        <h5 class="font-weight-bold font-size-21 text-gray-3 mt-3">
                            <a href="#">{{ $blogdetails->title ?? '' }}</a>
                        </h5>

                        <div class="mb-3">
                            <a class="mr-3 pr-1" href="#">
                                <span
                                    class="font-weight-normal text-gray-3">{{ date('M d, Y', strtotime($blogdetails->date)) ?? '' }}</span>
                            </a>
                        </div>

                        <p class="text-lh-lg text-gray-1 mb-5">{!! $blogdetails->description ?? '' !!}</p>
                    </div>

                    <div class="col-lg-4 col-xl-3">

                        <!-- List -->
                        <ul id="sidebarNav"
                            class="custom-dropdown list-unstyled border border-color-7 rounded pt-4 pb-1 mb-5">
                            <h5 class="font-weight-bold font-size-17 text-gray-6 mb-2 pb-1 px-4">More Blogs</h5>
                            @foreach ($moreblogs as $blog)
                                <li class="list-item">
                                    <a class="d-block dropdown-toggle dropdown-toggle-collapse"
                                        href="{{ route('blogs.show', $blog->slug) }}">
                                        <span class="font-weight-normal text-gray-1">{{ $blog->title ?? '' }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- End List -->
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
