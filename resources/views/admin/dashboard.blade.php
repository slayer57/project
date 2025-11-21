@extends('layouts.admin.master')
@section('title', 'Dashboard')

@section('content')
    <style>
        .icon-style {
            font-size: 40px;
        }
    </style>
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Hello Admin!</h5>
                            <p class="mb-4">
                                Welcome to <span class="fw-bold">Leideu</span> admin panel.
                            </p>

                            {{-- <a href="{{ route('admin.inquiry.index') }}" class="btn btn-sm btn-outline-primary">View
                                Inquiries</a> --}}
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="140" alt="View Badge User"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-category icon-style"></i>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Categories</span>
                            <h3 class="card-title mb-2">{{ $categories ?? 0 }}</h3>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-purchase-tag-alt icon-style"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Products</span>
                            <h3 class="card-title mb-2">{{ $products ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-cart icon-style icon-style"></i>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Orders</span>
                            <h3 class="card-title mb-2">{{ $orders ?? 0 }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-cube-alt icon-style"></i>
                                </div>

                            </div>
                            <span class="fw-semibold d-block mb-1">Blogs</span>
                            <h3 class="card-title mb-2">{{ $blogs ?? 0 }}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
