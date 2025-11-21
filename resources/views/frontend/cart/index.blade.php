@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4 sec-title-wrapper">
            <h3>Your Cart</h3>
        </div>
    </div>
    <div id="cart-view"></div>

    <div class="container">
        <div class="row my-5">
            <div class="d-flex justify-content-between mb-4 sec-title-wrapper">
                <h3>Popular Product</h3>
            </div>
            <div class="row">
                @if ($related_products->isNotEmpty())
                    @foreach ($related_products as $product)
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
                                        <a href="#" class="btn btn-primary addtocart flex-fill"
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
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            loadCart();
        })

        function loadCart() {
            $.ajax({
                url: "{{ route('cartItems.view') }}",
                type: "GET",
                success: function(data) {
                    $('#cart-view').html(data);
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });
        }

        function loadCartTotalQuantity() {
            $.ajax({
                url: "{{ route('carttotalquantity') }}",
                type: "GET",
                success: function(data) {
                    $('#cart-total-items').html(data);
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });
        }
    </script>

    <script>
        $(document).on('click', '.empty-cart', function(e) {
            e.preventDefault();
            swal({
                    title: `Are you sure?`,
                    text: "you want to empty your cart?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })

                .then((willDelete) => {
                    if (willDelete) {
                        $(this).closest("form").submit();
                    }
                });
        })

        $(document).on('click', '.cart-item', function(e) {
            e.preventDefault();
            var cartitemid = $(this).attr('cart-item-id');

            $.ajax({
                url: "{{ url('view-items/cart/remove') }}" + "/" + cartitemid,
                type: "GET",
                success: function(data) {
                    loadCart();
                    loadCartTotalQuantity();
                    toastr.success("Item remove from cart");
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });

        });

        $(document).on('click', '.btn-increase', function(e) {
            var id = $(this).attr('itemquantity');

            $.ajax({
                url: "{{ url('view-items/cart/increase') }}" + "/" + id,
                type: "GET",
                success: function(data) {
                    loadCart();
                    loadCartTotalQuantity();
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });
        })

        $(document).on('click', '.btn-decrease', function(e) {
            var id = $(this).attr('itemquantity');

            $.ajax({
                url: "{{ url('view-items/cart/decrease') }}" + "/" + id,
                type: "GET",
                success: function(data) {
                    loadCart();
                    loadCartTotalQuantity();
                },
                error: function(data) {
                    alert("Some Problems Occured!");
                },
            });
        })
    </script>
@endsection
