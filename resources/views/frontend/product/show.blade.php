@extends('layouts.frontend.master')

@section('seo')
    <title>{{ $productdetail->seo_title ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $productdetail->meta_keywords ?? 'Leideu' }}">
    <meta name="description" content="{{ $productdetail->meta_description ?? 'Leideu' }}">
@endsection

@section('content')
    <section class="category-navigation mt-3">
        <div class="container">
            <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    @if ($productdetail->categories->isNotEmpty())
                        @foreach ($productdetail->categories as $category)
                            @if ($category->parent)
                                <li class="breadcrumb-item"><a
                                        href="{{ route('product.category', $category->slug) }}">{{ $category->parent->name ?? '' }}</a>
                                </li>
                            @endif
                            <li class="breadcrumb-item"><a
                                    href="{{ route('product.category', $category->slug) }}">{{ $category->name ?? '' }}</a>
                            </li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $productdetail->name ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="product mt-2">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3 col-sm-12">
                    <div class="slider slider-for">
                        <div class="media-wrapper">
                            <img class="zoom" src="{{ asset('admin/images/product/' . $productdetail->featured_image) }}"
                                alt="{{ $productdetail->name ?? '' }}" />
                        </div>

                        @if ($productdetail->galleries->isNotEmpty())
                            @foreach ($productdetail->galleries as $g)
                                <div class="media-wrapper">
                                    <img class="zoom" src="{{ asset('admin/images/product/' . $g->image) }}"
                                        alt="gallery" />
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="slider-nav mt-3">
                        <div class="media-wrapper me-2">
                            <img src="{{ asset('admin/images/product/' . $productdetail->featured_image) }}"
                                alt="{{ $productdetail->name ?? '' }}" />
                        </div>

                        @if ($productdetail->galleries->isNotEmpty())
                            @foreach ($productdetail->galleries as $g)
                                <div class="media-wrapper me-2">
                                    <img class="" src="{{ asset('admin/images/product/' . $g->image) }}"
                                        alt="gallery" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-5 col-sm-12">
                    <div class="product-name text-grey-300 mb-3">
                        <h2>
                            {{ $productdetail->name ?? '' }}
                        </h2>
                    </div>

                    <div class="heading-2 product-price text-orange-100 fw-600 mb-3">
                        <h3>Rs. {{ number_format($productdetail->price ?? '') }}</h3>
                    </div>

                    @if ($productdetail->discount)
                        <div class="gap-32 text-grey-200 paragraph discount d-flex mb-3">
                            <div class="text-decoration-line-through">
                                <p>Rs. {{ $productdetail->mrp ?? '' }}</p>
                            </div>
                            <p>-{{ $productdetail->discount ?? '' }}%</p>
                        </div>
                    @endif

                    <div class="mb-3">
                        <h5 class="heading-4 text-grey-200 mb-3 quantity">Quantity</h5>
                        <div class="increment d-flex gap-64 align-items-center mb-4">
                            <input type="button" value="-" class="minus btn btn-primary" />
                            <input type="number" class="value form-control cartquantity text-center" min="1"
                                value="1" style="width: 55px" />
                            <input type="button" value="+" class="plus btn btn-primary" />
                        </div>

                        <div class="buy-now d-flex gap-32 paragraph mt-2">
                            <button class="btn btn-primary text-white addtocart" product-id="{{ $productdetail->id }}">
                                <i class="fa-solid fa-cart-shopping me-1"></i> Add to Cart
                            </button>
                            <button class="btn btn-sm btn-orange text-white addtocart"
                                product-id="{{ $productdetail->id }}" buy-now="yes"><i class="fa-solid fa-tag me-1"></i>
                                Buy
                                Now</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 pe-5">
                    <div class="delivery h-95 p-4">
                        <h1 class="heading2 text-grey-200 mb-4 sec-title-wrapper">
                            Delivery Information
                        </h1>
                        <div class="location d-flex gap-16">
                            <i class="fa-solid fa-location-dot text-grey-200"></i>
                            <div class="text-grey-200 ps-3">
                                <h5>{{ $settings['delivery_location'] ?? '' }}</h5>
                            </div>
                        </div>

                        <div class="duration d-flex gap-16 my-3">
                            <i class="fa-solid fa-truck text-grey-200"></i>
                            <div class="text-grey-200">
                                <h5>Standard Delivery</h5>
                                <p>{{ $settings['delivery_time'] ?? '' }}</p>
                            </div>

                            <div class="price text-grey-200 ps-4">
                                <h5>Rs. {{ getShippingCharge() }}</h5>
                            </div>
                        </div>

                        <h2 class="heading2 text-grey-200 mb-4 service">
                            Service
                        </h2>

                        <div class="returns d-flex text-grey-200 gap-8">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <div>
                                <h6>{{ $productdetail->easy_return ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="warrenty d-flex text-grey-200 gap-8 mt-1">
                            <i class="fa-solid fa-shield"></i>
                            <div>
                                <h6>Warrenty</h6>
                                <p>{{ $productdetail->warranty_duration ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="warrenty d-flex text-grey-200 gap-8 mt-1">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <div>
                                <h6>Service Center</h6>
                                <p>{{ $productdetail->service_center ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="specification">
        <div class="container">
            @include('frontend.includes.message')
            <nav class="ps-4">
                <ul class="nav nav-tabs mt-4 justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $errors->has('review') ? '' : 'active' }}" id="home-tab"
                            data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">
                            Product Details
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                            Specifications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $errors->has('review') ? 'active' : '' }}" id="home-review"
                            data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab"
                            aria-controls="review" aria-selected="false">
                            Review
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="tab-content" id="nav-tabContent" class="px-5 py-3">
                <div class="tab-pane fade {{ $errors->has('review') ? '' : 'show active' }}  px-5 py-3" id="home"
                    role="tabpanel" aria-labelledby="home-tab">
                    {!! $productdetail->description ?? '' !!}
                </div>
                <div class="tab-pane fade px-5 py-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    {!! $productdetail->specification ?? '' !!}
                </div>
                <div class="tab-pane fade py-3 row {{ $errors->has('review') ? 'show active' : '' }}" id="review"
                    role="tabpanel" aria-labelledby="review-tab">
                    <div class="col-md-7 my-0 mx-auto">
                        @auth
                            <div class="customer-review">
                                <form action="{{ route('review') }}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Your Rating</label>
                                        <div class="col-sm-10">
                                            <div class="star-rating rating d-flex gap-8">
                                                <input type="radio" id="5-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="4-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="3-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="2-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="1-star" name="rating" value="1" />
                                                <label for="1-star" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label text-gray-300">Your
                                            Review</label>
                                        <div class="col-sm-10">
                                            <textarea name="review" id="" class="form-control w-100 @error('review') is-invalid @enderror"
                                                cols="30" rows="10" placeholder="Write review here."></textarea>
                                            @error('review')
                                                <div class="invalid-feedback" style="display: block;">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" value="{{ $productdetail->id ?? '' }}">

                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2"></label>
                                        <div class="col-sm-10">
                                            <button class="btn btn-primary btn-sm text-white" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        @endauth
                        <section class="review  mt-3">
                            <div class="container">
                                <div class="customer-review">
                                    <h4 class="sec-title-wrapper">Reviews</h4>
                                    <div class="review-item p-3">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <div class="rating">
                                                    <div class="rate d-flex gap-2 align-items-baseline">
                                                        <h4>{{ $productdetail->rating ?? '' }}</h4>
                                                        <p>/5</p>
                                                    </div>

                                                    <div class="stars heading2">
                                                        @for ($i = 1; $i <= $productdetail->rating; $i++)
                                                            <i class="fa-solid fa-star text-yellow"></i>
                                                        @endfor
                                                        @for ($i = 1; $i <= 5 - $productdetail->rating; $i++)
                                                            <i class="fa-solid fa-star text-grey-100"></i>
                                                        @endfor
                                                    </div>

                                                    <div class="heading3 text-grey-200 mt-2">
                                                        <p>{{ $total_rating ?? 0 }} ratings</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="review-data">
                                                    <div class="stars d-flex align-items-baseline gap-1">
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <p>8</p>
                                                    </div>
                                                    <div class="stars d-flex align-items-baseline gap-1">
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <p>4</p>
                                                    </div>
                                                    <div class="stars d-flex align-items-baseline gap-1">
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <p>6</p>
                                                    </div>
                                                    <div class="stars d-flex align-items-baseline gap-1">
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <p>2</p>
                                                    </div>
                                                    <div class="stars d-flex align-items-baseline gap-1">
                                                        <i class="fa-solid fa-star text-yellow"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <i class="fa-solid fa-star text-grey-100"></i>
                                                        <p>0</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-comment mt-2 customer-review">
                                    <h4 class="sec-title-wrapper">Product Reviews</h4>
                                    @if ($reviews->isNotEmpty())
                                        @foreach ($reviews as $review)
                                            <div class="customer my-3">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-6">
                                                        <h6>
                                                            {{ $review->user->first_name ?? '' }}
                                                            {{ $review->user->last_name ?? '' }}
                                                        </h6>
                                                        @php $rating = $review->rating; @endphp
                                                        <div class="stars gap-1">
                                                            @for ($i = 1; $i <= $rating; $i++)
                                                                <i class="fa-solid fa-star text-yellow"></i>
                                                            @endfor
                                                            @for ($i = 1; $i <= 5 - $rating; $i++)
                                                                <i class="fa-solid fa-star text-grey-100"></i>
                                                            @endfor
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8 col-sm-6">
                                                        <div class="date d-flex justify-content-end gap-2">
                                                            <i class="fa fa-clock mt-1 text-primary"></i>
                                                            <p>{{ $review->created_at->diffForHumans() ?? '' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-grey paragraph my-2">
                                                    <i class="fa fa-quote-left text-primary" aria-hidden="true"></i>
                                                    {{ $review->comments ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @guest
                                            <p class="text-center">You must log in to post for a review.</p>
                                        @endguest
                                        <h6 class="text-center mt-2">There are no review yet !</h6>
                                    @endif

                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recommended">
        <div class="container">
            <div class="ps-3">
                <h2 class="sec-title-wrapper">Recommended</h2>
                <div class="row mt-3 mb-2">
                    @if ($recommended_products->isNotEmpty())
                        @foreach ($recommended_products as $product)
                            <div class="col-lg-2 col-md-4 col-sm-6 col-6  d-grid align-self-stretch">
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
                                        <div class="ribbon ribbon-top-right"><span>{{ $product->discount ?? '' }}%
                                                OFF</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            var url = $('.slick-current').closest('img');
        })
    </script>
@endsection
