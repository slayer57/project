<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand d-flex justify-content-center demo ml-2">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ $settings['site_main_logo'] ? asset('admin/images/setting/' . $settings['site_main_logo']) : asset('admin/images/logo.png') }}"
                alt="" height="120" class="">
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 mt-0">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- CMS -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">CMS</span></li>
        <!-- Cards -->

        <li class="menu-item {{ Request::segment(2) == 'categories' ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Basic">Categories</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'products' ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                <div data-i18n="Basic">Products</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'orders' ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart"></i>
                <div data-i18n="Basic">Orders</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'users' ? 'active' : '' }}">
            <a href="{{ route('admin.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Basic">Users</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'coupons' ? 'active' : '' }}">
            <a href="{{ route('admin.coupons.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-coupon"></i>
                <div data-i18n="Basic">Coupons</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'testimonials' ? 'active' : '' }}">
            <a href="{{ route('admin.testimonials.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Basic">Testimonials</div>
            </a>
        </li>

        <li class="menu-item {{ Request::segment(2) == 'blogs' ? 'active' : '' }}">
            <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Basic">Blogs</div>
            </a>
        </li>


        <li class="menu-item {{ Request::segment(2) == 'inquirypersons' ? 'active' : '' }}">
            <a href="{{ route('admin.inquirypersons.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Basic">Inquiry Persons</div>
            </a>
        </li>

        <!-- General Settings  -->
        <li class="menu-item @if (Request::segment(2) == 'pages' ||
                Request::segment(2) == 'settings' ||
                Request::segment(2) == 'socialmedias' ||
                Request::segment(2) == 'sliders') {{ 'active open' }} @endif">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="General Setting">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admin.pages.index') }}"
                        class="menu-link {{ Request::segment(2) == 'pages' ? 'active' : '' }}">
                        <div data-i18n="Accordion">Pages</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.sliders.index') }}"
                        class="menu-link {{ Request::segment(2) == 'sliders' ? 'active' : '' }}">
                        <div data-i18n="Accordion">Sliders</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.socialmedias.index') }}"
                        class="menu-link {{ Request::segment(2) == 'socialmedias' ? 'active' : '' }}">
                        <div data-i18n="Accordion">Social Medias</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.settings.index') }}"
                        class="menu-link {{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                        <div data-i18n="Accordion">Global Settings</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
