<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    @yield('seo')

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ $settings['fav_icon'] ? asset('admin/images/setting/' . $settings['fav_icon']) : asset('admin/images/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick-theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slickpro.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}" />

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- toastr ends-->

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "100224166288449");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v16.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W6YV654GWQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-W6YV654GWQ');
    </script>


    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var
                f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.in
            sertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NMC7WFZ');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="bg-grey-500">
    <header>
        @include('layouts.frontend.header')
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-primary py-5 text-white mt-5 px-5">
        @include('layouts.frontend.footer')
    </footer>

    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/zoomsl.min.js') }}"></script>

    {{--  autocomplete search --}}
    <script src="{{ asset('frontend/assets/js/typeahead.min.js') }}"></script>
    @yield('scripts')

    <script>
        $(function() {
            $(".zoom").imagezoomsl();
        })

        var route = "{{ url('autocomplete-search') }}";
        $('.search-input').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>

    <script>
        $('.addtocart').click(function(e) {
            e.preventDefault();

            var quantity = $('.cartquantity').val();
            var productid = $(this).attr('product-id');
            var buynow = $(this).attr('buy-now');

            $.ajax({
                url: "{{ route('cart.store') }}",
                type: "POST",
                data: {
                    product_id: productid,
                    buynow: buynow,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('.cartquantity').val(1);
                    if (data == 'checkout') {
                        toastr.success("Product added to your cart");
                        var url = "{{ route('checkout') }}";
                        location.href = url;
                    } else {
                        toastr.success("Product added to your cart");
                        $('#cart-total-items').html(data);
                        loadCart();
                    }
                },
                error: function(data) {
                    toastr.error("Some problem Occured");
                },
            });
        });
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NMC7WFZ" height="0" width="0"
            style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
