@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="category-content mt-4">
        <div class="container">
            <form action="" method="GET">
                <div class="row gap-2">
                    <div class="col-md-3 col-sm-12">
                        <div class="stick card card-body shadow-lg p-4">
                            <h2 class="sec-title-wrapper mb-3 text-grey-300 fw-600">Filters</h2>
                            <h3 class="heading4 mb-3 text-grey-200">Price</h3>
                            <div class="price-range">
                                <div action="" class="form_control d-flex gap-8 price-range-text align-items-center">
                                    <input type="number" class="range form-control min-range"
                                        value="{{ request('min_price') ?? 0 }}" step="500" min="0" max="500000"
                                        id="fromInput" name="min_price" />
                                    <p>to</p>
                                    <input type="number" class="range form-control max-range"
                                        value="{{ request('max_price') ?? 500000 }}" step="500" min="0"
                                        max="500000" id="toInput" name="max_price" />
                                </div>

                                <div class="sliders_control">
                                    <input id="fromSlider" type="range" value="{{ request('min_price') ?? 0 }}"
                                        min="0" max="500000" step="500" />
                                    <input id="toSlider" type="range" value="{{ request('max_price') ?? 500000 }}"
                                        min="0" max="500000" step="500" />
                                </div>
                                <button class="btn btn-primary br-0 paragraph px-4 py-2 text-white mt-3">
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 row card card-body shadow-lg">
                        <div class="container">
                            <div class="row mb-3 mx-1 sort">
                                <div class="col-md-4">
                                    <h2 class="my-2 sec-title-wrapper text-grey-300 fw-600">"Search by
                                        {{ request('search') ?? '' }}"
                                    </h2>
                                </div>
                                <div class="col-md-8 d-flex justify-content-end  gap-2 align-items-center ">
                                    <label for="sort">Sort By: </label>
                                    <div class="col-md-4">
                                        <select name="sort" id="sort" class="form-select"
                                            onchange="this.form.submit()">
                                            <option {{ request('sort') == 'asc' ? 'selected' : '' }} value="asc">Low to
                                                High
                                                Price
                                            </option>
                                            <option {{ request('sort') == 'desc' ? 'selected' : '' }} value="desc">High to
                                                Low
                                                Price
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="paginate" class="form-select" onchange="this.form.submit()">
                                            <option {{ request('paginate') == 2 ? 'selected' : '' }} value="2">Show 2
                                            </option>
                                            <option {{ request('paginate') == 4 ? 'selected' : '' }} value="4">Show 4
                                            </option>
                                            <option
                                                @if (request('paginate')) {{ request('paginate') == 6 ? 'selected' : '' }} @else selected @endif
                                                value="6">Show 6
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" value="{{ request('search') ?? '' }}" name="search">
                            </div>
                            <div class="row">
                                @if ($products->isNotEmpty())
                                    @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 d-grid align-self-stretch mt-2">
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

                                                    <a href="{{ route('product.show', $product->slug) }}"
                                                        class="stretched-link"></a>
                                                </div>

                                                @if ($product->discount)
                                                    <div class="ribbon ribbon-top-right">
                                                        <span>{{ $product->discount ?? '' }}%
                                                            OFF</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    {{ $products->appends($params)->links() }}
                                @else
                                    <p>No product found!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
@endsection
