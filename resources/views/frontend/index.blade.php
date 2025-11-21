@extends('layouts.frontend.master')

@section('seo')
    <title>{{ $settings['homepage_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['homepage_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['homepage_seo_description'] ?? 'Leideu' }}">
@endsection

@section('content')
    <section class="hero">
        <div class="container bg-white p-0 ps-3">
            <div class="row">
                <div class="hero-list col-md-2 col-xl-2 mb-3 p-0 hidden">
                    <h6 class="px-3 py-2 border-bottom bg-primary text-white border-1 fw-700">
                        Phone Brands
                    </h6>
                    <div>
                        <ul class="menu px-3">
                            @if ($p_category->isNotEmpty())
                                @foreach ($p_category as $category)
                                    <li>
                                        @php $child_categories = getChildCategories($category->id) @endphp
                                        <a href="{{ route('product.category', $category->slug) }}"
                                            class="d-flex justify-content-between">{{ $category->name ?? '' }}
                                            @if ($child_categories->count() > 0)
                                                <i class="fa-solid fa-angle-right"></i>
                                            @endif
                                        </a>
                                        @if ($child_categories->isNotEmpty())
                                            <div class="megadrop">
                                                <div class="w-100">
                                                    <ul class="navbar-nav">
                                                        @foreach ($child_categories as $cate)
                                                            <li class="nav-item">
                                                                <a href="{{ route('product.category', $cate->slug) }}"
                                                                    class="nav-link d-flex justify-content-between">{{ $cate->name ?? '' }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-md-10 col-xl-10">
                    <div class="hero-banner">
                        <div class="slider single-item">

                            @if ($sliders->isNotEmpty())
                                @foreach ($sliders as $slider)
                                    <div class="media-wrapper position-relative">
                                        <a href="javascript:void(0)" class="stretched-link"></a>
                                        <img src="{{ asset('admin/images/slider/' . $slider->image) }}"
                                            alt="{{ $slider->title ?? slider_image }}" />
                                    </div>
                                @endforeach
                            @else
                                <div class="media-wrapper position-relative">
                                    <a href="javascript:void(0)" class="stretched-link"></a>
                                    <img src="{{ asset('frontend/assets/images/hero-banner.png') }}" alt="slider_image" />
                                </div>

                                <div class="media-wrapper position-relative">
                                    <a href="javascript:void(0)" class="stretched-link"></a>
                                    <img src="{{ asset('frontend/assets/images/hero-banner.png') }}" alt="slider_image" />
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="backgroundimg">
            <img src="{{ $settings['top_notification_banner'] ? asset('admin/images/setting/' . $settings['top_notification_banner']) : asset('frontend/assets/images/banner.jpg') }}"
    alt="banner_image" />
    </div> --}}
    </section>

    <section class="new-arrivals">
        <div class="container">
            <div class="d-flex justify-content-between mb-4 sec-title-wrapper">
                <h3>New Arrivals</h3>
                <a href="{{ route('products') }}" class="btn btn-primary">View All</a>
            </div>
            <div class="row">
                @if ($new_arrivals_products->isNotEmpty())
                    @foreach ($new_arrivals_products as $product)
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6  d-grid align-self-stretch">
                            <div class="card-product position-relative shadow">
                                <div class="position-relative">
                                    <div class="media-wrapper position-relative">
                                        <img src="{{ asset('admin/images/product/' . $product->featured_image) }}"
                                            alt="{{ $product->name ?? '' }}" />
                                    </div>

                                    <div class="content">
                                        <p class="pname clamp-2 text-grey-300 fw-600 mt-2">
                                            {{-- {{ $product->name ?? '' }} --}}
                                            {{ strlen($product->name) > 25 ? substr($product->name, 0, 25) . '...' : $product->name }}
                                        </p>
                                        <div class="my-2">
                                            <p class="text-secondary price">
                                                Rs {{ number_format($product->price ?? '') }}
                                                @if ($product->discount)
                                                    <del
                                                        class="text-grey-200">{{ number_format($product->mrp ?? '') }}</del>
                                                @endif
                                            </p>
                                        </div>

                                        @php $rating = $product->rating; @endphp
                                        <div class="rating d-flex gap-8">
                                            @for ($i = 1; $i <= $rating; $i++)
                                                <i class="fa-solid fa-star text-yellow"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 5 - $rating; $i++)
                                                <i class="fa-solid fa-star text-grey-100"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <!-- <div class="buy d-flex flex-column w-100 gap-3 mt-3">
                                            <a href="#" class="btn btn-primary py-2 flex-fill addtocart" product-id="{{ $product->id }}" buy-now="yes">
                                                <i class="fa-solid fa-tag me-1"></i>Buy Now
                                            </a>


                                            <a href="#" class="btn btn-primary py-2 addtocart flex-fill" product-id="{{ $product->id }}">
                                                <i class="fa-solid fa-cart-shopping me-1"></i>Add To Cart
                                            </a>
                                        </div> -->

                                    <a href="{{ route('product.show', $product->slug) }}" class="stretched-link"></a>
                                </div>

                                @if ($product->discount)
                                    <div class="ribbon ribbon-top-right"><span>{{ $product->discount ?? '' }}% OFF</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="category-shop">
        <div class="container bg-grey-500">
            <div class="d-flex justify-content-between mb-4 sec-title-wrapper">
                <h3>Shop by Category</h3>
                <a href="#" class="btn btn-primary">View All</a>
            </div>
        </div>
        <div class="container">
            @if ($p_category->isNotEmpty())
                @foreach ($p_category as $category)
                    <div class="card-category d-flex gap-16 align-items-center position-relative">
                        <div class="media-wrapper">
                            <img src="{{ $category->image ? asset('admin/images/category/' . $category->image) : 'https://images.pexels.com/photos/13150616/pexels-photo-13150616.jpeg?auto=compress&cs=tinysrgb&w=1600&lazy=load' }}"
                                alt="{{ $category->name ?? '' }}" />
                        </div>
                        <p>{{ $category->name ?? '' }}</p>
                        <a href="{{ route('product.category', $category->slug) }}" class="stretched-link"></a>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

    <section class="popular mt-5">
        <div class="container">
            <div class="d-flex justify-content-between mb-4 sec-title-wrapper">
                <h3>Popular</h3>
                <a href="{{ route('products') }}" class="btn btn-primary">View All</a>
            </div>

            <div class="row">
                @if ($popular_products->isNotEmpty())
                    @foreach ($popular_products as $product)
                        <div class="col-lg-2 col-md-4 col-sm-6 col-6 d-grid align-self-stretch">
                            <div class="card-product position-relative shadow">
                                <div class="position-relative">
                                    <div class="media-wrapper position-relative">
                                        <img src="{{ asset('admin/images/product/' . $product->featured_image) }}"
                                            alt="{{ $product->name ?? '' }}" />
                                    </div>

                                    <div class="content">
                                        <p class="clamp-2 text-grey-300 fw-600 mt-2">
                                            {{-- {{ $product->name ?? '' }} --}}
                                            {{ strlen($product->name) > 25 ? substr($product->name, 0, 25) . '...' : $product->name }}

                                        </p>
                                        <div class="my-2">
                                            <p class="text-secondary price">
                                                Rs {{ number_format($product->price ?? '') }}
                                                @if ($product->discount)
                                                    <del
                                                        class="text-grey-200">{{ number_format($product->mrp ?? '') }}</del>
                                                @endif
                                            </p>
                                        </div>

                                        @php $rating = $product->rating; @endphp

                                        <div class="rating d-flex gap-8">
                                            @for ($i = 1; $i <= $rating; $i++)
                                                <i class="fa-solid fa-star text-yellow"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 5 - $rating; $i++)
                                                <i class="fa-solid fa-star text-grey-100"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- <div class="buy d-flex w-100 gap-3 mt-3">
                                        <a href="#" class="btn btn-primary flex-fill addtocart"
                                            product-id="{{ $product->id }}" buy-now="yes">
                        <i class="fa-solid fa-tag me-1"></i>Buy Now
                        </a>

                        <a href="#" class="btn btn-primary addtocart flex-fill" product-id="{{ $product->id }}">
                            <i class="fa-solid fa-cart-shopping me-1"></i>Add To Cart
                        </a>
                    </div> --}}

                                    <a href="{{ route('product.show', $product->slug) }}" class="stretched-link"></a>
                                </div>

                                @if ($product->discount)
                                    <div class="ribbon ribbon-top-right"><span>{{ $product->discount ?? '' }}% OFF</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
