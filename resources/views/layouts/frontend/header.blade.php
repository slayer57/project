@if ($settings['top_notification'])
    <div class="topbar text-center text-primary py-2">
        <p>{{ $settings['top_notification'] ?? '' }}</p>
    </div>
@endif

<div class="top-nav">
    <nav class="container">
        <div class="navbar gap-3 flex-row">
            <div class="d-flex gap-2 ">
                <button class="btn canbtn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars text-primary"></i>
                </button>
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('frontend/assets/images/logo.png') }}"
                            alt="logo" />
                    </a>
                </div>
            </div>
            <div class="search-bar flex-fill">
                <form class="w-100" action="{{ route('products') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control px-4 search-input"
                            placeholder="what do you want to find?" autocomplete="off" />
                        <button class="input-group-text btn btn-primary px-5 desk-search" type="submit">
                            Search
                        </button>
                        <button class="input-group-text btn btn-primary px-5 d-none mobile-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>

            <ul class="nav-credintials navbar nav gap-16">
                @if (auth()->check() && Auth::user()->user_type == 'User')
                    <div class="dropdown categories">
                        <button class="btn d-flex align-items-center p-0" type="button" id="myaccount"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <span class="text-primary">Welcome,
                            {{ (Auth::user()->first_name ?? '') . ' ' . (Auth::user()->last_name ?? '') }} <i class="fa fa-caret-down text-primary me-2"></i></span> -->

                            <i class="fa-solid fa-user text-primary me-2"></i>
                            <p class="username"> {{ Auth::user()->first_name ?? '' }}</p>
                            <i class="fa fa-caret-down text-primary"></i>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="myaccount">
                            <li class="p-1"><a class="dropdown-item" href="{{ route('mydashboard') }}">Dashboard</a>
                            </li>
                            <li class="p-1"><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li class="p-1"><a class="dropdown-item" href="{{ route('myorder') }}">Orders</a></li>
                            <li class="p-1"><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('userlogout-form').submit();">Logout</a>
                            </li>
                        </ul>
                    </div>

                    <form id="userlogout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">
                        <li class="d-flex align-items-center"><i class="fa-solid fa-user me-2"></i>
                            <p>Sign In</p>
                        </li>
                    </a>
                @endif
                <a href="{{ route('cart.index') }}">
                    <li class="d-flex align-items-center"><i class="fa-solid fa-cart-shopping me-2"></i>
                        <p>Cart</p>
                        <span class="badge bg-secondary position-absolute top-0 start-100 rounded-circle"
                            id="cart-total-items">
                            {{ Cart::getContent()->count() }}
                        </span>
                    </li>
                </a>
            </ul>

        </div>
        @php
            $p_category = getParentCategories();
        @endphp
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Leideu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="hero-list ">
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
                                                            <li class="nav-item sub">
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
            </div>
        </div>
    </nav>
</div>
<div class="category-nav bg-white">
    <div class="container">
        <div class="navigation d-flex justify-content-between align-items-center">
            <div class="main d-flex align-items-center gap-16">
                <div class="dropdown categories">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-list me-2 text-primary"></i>Categories
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @php $p_c = getParentCategories() @endphp
                        @if ($p_c->isNotEmpty())
                            @foreach ($p_c as $categ)
                                @php $child_categ = getChildCategories($categ->id) @endphp

                                <li>
                                    <a class="dropdown-item" href="{{ route('product.category', $categ->slug) }}">
                                        {{ $categ->name ?? '' }}
                                        @if ($child_categ->count() > 0)
                                            &raquo;
                                        @endif
                                    </a>
                                    @if ($child_categ->isNotEmpty())
                                        <ul class="dropdown-menu dropdown-submenu">
                                            @foreach ($child_categ as $child)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('product.category', $child->slug) }}">
                                                        {{ $child->name ?? '' }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
                <div class="dropdown d-flex gap-3">
                    <a href="{{ route('contact') }}" target="_blank" class="text-dark mr-3"><i
                            class="far fa-comments text-primary" aria-hidden="true"></i>
                        Feedback </a>
                </div>
            </div>
            <div class="more d-flex align-items-baseline gap-8">
                <a href=""> More <i class="fa-solid fa-angle-right"></i> </a>
            </div>
        </div>
    </div>
</div>
