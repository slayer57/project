<div class="container">
    <div class="row">
        <div class="col-md-2 mb-5">
            <h6 class="mb-3">Customer Care</h6>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Help center</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">How to buy</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Return and refund</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2 mb-5">
            <h6 class="mb-3">Categories</h6>
            <ul class="navbar-nav">
                @php $parent_c = getFooterParentCategories() @endphp
                @foreach ($parent_c as $item)
                    <li class="nav-item">
                        <a href="{{ route('product.category', $item->slug) }}"
                            class="nav-link">{{ $item->name ?? '' }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-2 mb-5">
            <h6 class="mb-3">Company</h6>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item">
                    <a href="{{ route('page.show', 'terms-and-conditions') }}" class="nav-link">Terms and Conditions</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('page.show', 'privacy-policy') }}" class="nav-link">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                </li>
            </ul>
        </div>
        <div class="col-md-6 footer-detail">
            <h6>
                <img src="{{ $settings['site_footer_logo'] ? asset('admin/images/setting/' . $settings['site_footer_logo']) : asset('frontend/assets/images/Mask group.png') }}"
                    alt="logo" />
            </h6>

            <p>
                {{ $settings['site_information'] ?? '' }}
            </p>
            <div class="contact-info">

                <ul class="nav gap-4">
                    <li>{{ $settings['site_contact'] ?? '' }}</li>
                    <li>{{ $settings['site_email'] ?? '' }}</li>
                    <li>{{ $settings['site_location'] ?? '' }}</li>
                </ul>
                <ul class="nav gap-4 mt-3 footer-brand">
                    @foreach ($socialmedias as $media)
                        <li>
                            <a href="{{ $media->link ?? '' }}"><i class="fa-brands {{ $media->icon ?? '' }}"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
