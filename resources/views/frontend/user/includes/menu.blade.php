<div class="col-md-2">
    <div class="card card-body shadow-lg">
        <h5 class="mb-4 sec-title-wrapper">My Accounts</h5>
        <nav class="nav flex-column">
            <li class="nav-item me-3 me-lg-0 {{ Request::segment(2) == 'dashboard' ? 'menu-profile-active' : '' }}">
                <a class="nav-link p-3" href="{{ route('mydashboard') }}">
                    <i class="fa fa-tachometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-item me-3 me-lg-0 {{ Request::segment(2) == 'profile' ? 'menu-profile-active' : '' }}">
                <a class="nav-link p-3" href="{{ route('profile.edit') }}">
                    <i class="fa fa-user"></i> Profile Details
                </a>
            </li>
            <li class="nav-item me-3 me-lg-0 {{ Request::segment(2) == 'orders' ? 'menu-profile-active' : '' }}">
                <a class="nav-link p-3 " href="{{ route('myorder') }}">
                    <i class="fas fa-shopping-cart"></i> Orders History
                </a>
            </li>
            <li class="nav-item me-3 me-lg-0 {{ Request::segment(2) == 'billing' ? 'menu-profile-active' : '' }}">
                <a class="nav-link p-3" href="{{ route('billing.details') }}">
                    <i class="fa fa-home"></i> Billing Address
                </a>
            </li>
            <li class="nav-item me-3 me-lg-0">
                <a class="nav-link p-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('userlogout-form').submit();">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>

        </nav>
    </div>
</div>
