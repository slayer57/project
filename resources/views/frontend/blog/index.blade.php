@extends('layouts.frontend.master')

@section('seo')
    <title>{{ $settings['blogs_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['blogs_seo_keywords'] ?? '' }}">
    <meta name="description" content="{{ $settings['blogs_seo_description'] ?? '' }}">
@endsection

@section('content')
    <main id="content" class="">
        <div class="bg-img-hero text-center mb-5 mb-lg-8"
            style="background-image: url({{ $settings['blog_page_banner'] ? asset('admin/images/setting/' . $settings['blog_page_banner']) : asset('frontend/assets/img/banner.jpg') }});">
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
                                    aria-current="page">Blogs</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Info -->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cars-list">
                <div class="row mb-5">
                    @if ($blogs->isNotEmpty())
                        @foreach ($blogs as $blog)
                            <div class="col-md-6 col-lg-4 mb-2">
                                <div class="mb-4 mb-lg-0 text-md-center text-lg-left">
                                    <a class="d-block mb-3" href="#">
                                        <img class="img-fluid rounded-xs w-100"
                                            src="{{ asset('admin/images/blog/' . $blog->image) }}"
                                            alt="{{ $blog->title ?? '' }}">
                                    </a>
                                    <h6 class="font-size-17 pt-xl-1 font-weight-bold font-weight-bold mb-1">
                                        <a href="{{ route('blogs.show', $blog->slug) }}">{{ $blog->title ?? '' }}</a>
                                    </h6>
                                    <a class="text-gray-1" href="{{ route('blogs.show', $blog->slug) }}">
                                        <span>{{ $blog->date ? date('M d Y', strtotime($blog->date)) : '' }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 col-xl-12 mb-12 mb-md-12 pb-1">
                            <p class="text-center">No Blog Found</p>
                        </div>
                    @endif
                </div>
                <p>{{ $blogs->links() }}</p>
            </div>
        </div>
    </main>
@endsection
