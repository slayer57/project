@extends('layouts.admin.master')
@section('title', 'Website Settings')

@section('content')
    @include('admin.includes.message')
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="card-body p-0">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card card-primary shadow br-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3 col-sm-2 nav flex-column gap-2 nav-pills" id="v-pills-tab"
                                        role="tablist" aria-orientation="vertical">
                                        <button class="nav-link text-start active" id="v-pills-global-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-global" type="button"
                                            role="tab" aria-controls="v-pills-global"
                                            aria-selected="true">Global</button>
                                        <button class="nav-link text-start" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="false">Homepage</button>

                                        <button class="nav-link text-start" id="v-pills-banners-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-banners" type="button" role="tab"
                                            aria-controls="v-pills-banners" aria-selected="false">Banners</button>

                                        <button class="nav-link text-start" id="v-pills-contacts-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-contacts" type="button" role="tab"
                                            aria-controls="v-pills-contacts" aria-selected="false">Contact</button>

                                        <button class="nav-link text-start" id="v-pills-seo-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-seo" type="button" role="tab"
                                            aria-controls="v-pills-seo" aria-selected="false">Seo</button>

                                        <button class="nav-link text-start" id="v-pills-shippingcharge-tab"
                                            data-bs-toggle="pill" data-bs-target="#v-pills-shippingcharge" type="button"
                                            role="tab" aria-controls="v-pills-shippingcharge"
                                            aria-selected="false">Shipping Charge</button>

                                        <button class="nav-link text-start" id="v-pills-script-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-script" type="button" role="tab"
                                            aria-controls="v-pills-script" aria-selected="false">Script</button>
                                    </div>
                                    <div class="col-9 col-sm-10 tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-global" role="tabpanel"
                                            aria-labelledby="v-pills-global-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_logo">Site Main Logo <span>(150
                                                                x 45 px)</span></label>
                                                        <div class="custom-file">
                                                            <input type="file" name="site_main_logo" class="mainlogo"
                                                                id="site_logo"
                                                                data-default-file="{{ $settings['site_main_logo'] != null ? asset('admin/images/setting') . '/' . $settings['site_main_logo'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Site Footer Logo <span>(150
                                                                x 45 px)</span></label>
                                                        <div class="custom-file">
                                                            <input type="file" name="site_footer_logo" class="mainlogo"
                                                                id="sitefooter_logo"
                                                                data-default-file="{{ $settings['site_footer_logo'] != null ? asset('admin/images/setting') . '/' . $settings['site_footer_logo'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_information">Site Information</label>
                                                        <textarea name="site_information" rows="4" class="form-control br-8" placeholder="Enter Site Information">{{ $settings['site_information'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_copyright">Site Copyright</label>
                                                        <textarea name="site_copyright" rows="4" class="form-control br-8" placeholder="Enter Site Copyright">{{ $settings['site_copyright'] ?? '' }}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_location_url">Location Url</label>
                                                        <input type="text" name="site_location_url"
                                                            value="{{ $settings['site_location_url'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Location Url">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="about_page_description">About Page Description</label>
                                                        <textarea name="about_page_description" rows="4" class="form-control br-8" placeholder="Enter About">{{ $settings['about_page_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="banner_image">Fav Icon <span>(16
                                                                x 16 px)</span></label>
                                                        <div class="custom-file">
                                                            <input type="file" name="fav_icon" class="fav_icon"
                                                                id="fav_icon"
                                                                data-default-file="{{ $settings['fav_icon'] != null ? asset('admin/images/setting') . '/' . $settings['fav_icon'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_title">Homepage Seo Title</label>
                                                        <input type="text" name="homepage_seo_title"
                                                            value="{{ $settings['homepage_seo_title'] ?? '' }}"
                                                            class="form-control br-8"
                                                            placeholder="Enter homepage Seo Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_description">Homepage Seo
                                                            Keywords</label>
                                                        <input type="text" name="homepage_seo_keywords"
                                                            value="{{ $settings['homepage_seo_keywords'] ?? '' }}"
                                                            class="form-control br-8"
                                                            placeholder="Enter Homepage Seo Keywords">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_description">Homepage Seo
                                                            Description</label>
                                                        <textarea name="homepage_seo_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['homepage_seo_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="top_notification">Top
                                                            Notification</label>
                                                        <textarea name="top_notification" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['top_notification'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="top_notification_banner">Top Notification
                                                            Banner <span>(1903
                                                                x 670 px)</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="top_notification_banner"
                                                                class="top_notification_banner"
                                                                id="top_notification_banner"
                                                                data-default-file="{{ $settings['top_notification_banner'] != null ? asset('admin/images/setting') . '/' . $settings['top_notification_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-banners" role="tabpanel"
                                            aria-labelledby="v-pills-banners-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_logo">About Page</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="about_page_banner"
                                                                class="about_page_banner" id="aboutpagebanner"
                                                                data-default-file="{{ $settings['about_page_banner'] != null ? asset('admin/images/setting') . '/' . $settings['about_page_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Teams Page</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="team_page_banner"
                                                                class="team_page_banner" id="teampagebanner"
                                                                data-default-file="{{ $settings['team_page_banner'] != null ? asset('admin/images/setting') . '/' . $settings['team_page_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Blogs Page</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="blog_page_banner"
                                                                class="blog_page_banner" id="blogpagebanner"
                                                                data-default-file="{{ $settings['blog_page_banner'] != null ? asset('admin/images/setting') . '/' . $settings['blog_page_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="single_page_banner">Departure Page</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="single_page_banner"
                                                                class="single_page_banner" id="singlepagebanner"
                                                                data-default-file="{{ $settings['single_page_banner'] != null ? asset('admin/images/setting') . '/' . $settings['single_page_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Packages Page</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="package_page_banner"
                                                                class="package_page_banner" id="packagepagebanner"
                                                                data-default-file="{{ $settings['package_page_banner'] != null ? asset('admin/images/setting') . '/' . $settings['package_page_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="footer_logo">Feature Banner</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="feature_banner"
                                                                class="feature_banner" id="feature_banner"
                                                                data-default-file="{{ $settings['feature_banner'] != null ? asset('admin/images/setting') . '/' . $settings['feature_banner'] : null }}"
                                                                data-show-remove="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-contacts" role="tabpanel"
                                            aria-labelledby="v-pills-contacts-tab">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="delivery_time">Site Map</label>
                                                        <textarea name="site_map" rows="4" class="form-control br-8" placeholder="Enter Map Details">{{ $settings['site_map'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_phone">Site Contact Number</label>
                                                        <input type="tel" name="site_contact"
                                                            value="{{ $settings['site_contact'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Contact Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_email">Site Email</label>
                                                        <input type="email" name="site_email"
                                                            value="{{ $settings['site_email'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="site_location">Site Location</label>
                                                        <input type="text" name="site_location"
                                                            value="{{ $settings['site_location'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Location">
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_title">Contact Section
                                                            Description</label>
                                                        <textarea name="contact_section_description" rows="4" class="form-control br-8"
                                                            placeholder="Enter Something ...">{{ $settings['contact_section_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_title">Contact Seo Title</label>
                                                        <input type="text" name="contact_seo_title"
                                                            value="{{ $settings['contact_seo_title'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Seo Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_description">Contact Seo
                                                            Keywords</label>
                                                        <input type="text" name="contact_seo_keywords"
                                                            value="{{ $settings['homepage_seo_keywords'] ?? '' }}"
                                                            class="form-control br-8" placeholder="Enter Seo Keywords">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="homepage_seo_keywords">Contact Seo
                                                            Description</label>
                                                        <textarea name="contact_seo_description" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['contact_seo_description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-seo" role="tabpanel"
                                            aria-labelledby="v-pills-seo-tab">

                                            <fieldset class="border p-3">
                                                <legend class="float-none w-auto legend-title">Products :</legend>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="products_seo_title">Products Seo Title</label>
                                                            <input type="text" name="products_seo_title"
                                                                value="{{ $settings['products_seo_title'] ?? '' }}"
                                                                class="form-control br-8" placeholder="Enter Seo Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="homepage_seo_description">Products Seo
                                                                Keywords</label>
                                                            <input type="text" name="products_seo_keywords"
                                                                value="{{ $settings['products_seo_keywords'] ?? '' }}"
                                                                class="form-control br-8"
                                                                placeholder="Enter Seo Keywords">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label for="homepage_seo_keywords">Products Seo
                                                                Description</label>
                                                            <textarea name="products_seo_description" rows="4" class="form-control br-8"
                                                                placeholder="Enter Something ...">{{ $settings['products_seo_description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset class="border p-3">
                                                <legend class="float-none w-auto legend-title">Categories :</legend>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="categories_seo_title">Categories Seo Title</label>
                                                            <input type="text" name="categories_seo_title"
                                                                value="{{ $settings['categories_seo_title'] ?? '' }}"
                                                                class="form-control br-8" placeholder="Enter Seo Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="categories_seo_keywords">Categories Seo
                                                                Keywords</label>
                                                            <input type="text" name="categories_seo_keywords"
                                                                value="{{ $settings['categories_seo_keywords'] ?? '' }}"
                                                                class="form-control br-8"
                                                                placeholder="Enter Seo Keywords">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label for="categories_seo_description">Categories Seo
                                                                Description</label>
                                                            <textarea name="categories_seo_description" rows="4" class="form-control br-8"
                                                                placeholder="Enter Something ...">{{ $settings['categories_seo_description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset class="border p-3">
                                                <legend class="float-none w-auto legend-title">Blogs :</legend>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="homepage_seo_title">Blogs Seo Title</label>
                                                            <input type="text" name="blogs_seo_title"
                                                                value="{{ $settings['blogs_seo_title'] ?? '' }}"
                                                                class="form-control br-8" placeholder="Enter Seo Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label for="homepage_seo_description">Blogs Seo
                                                                Keywords</label>
                                                            <input type="text" name="blogs_seo_keywords"
                                                                value="{{ $settings['blogs_seo_keywords'] ?? '' }}"
                                                                class="form-control br-8"
                                                                placeholder="Enter Seo Keywords">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label for="homepage_seo_keywords">Blogs Seo
                                                                Description</label>
                                                            <textarea name="blogs_seo_description" rows="4" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['blogs_seo_description'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                        </div>

                                        <div class="tab-pane fade" id="v-pills-shippingcharge" role="tabpanel"
                                            aria-labelledby="v-pills-shippingcharge-tab">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="site_top_bar">Shipping Charge</label>
                                                        <input type="number" min="1" class="form-control"
                                                            name="shipping_charge"
                                                            value="{{ $settings['shipping_charge'] ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="delivery_location">Location</label>
                                                        <textarea name="delivery_location" rows="8" class="form-control br-8" placeholder="Enter Something ...">{{ $settings['delivery_location'] ?? '' }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="site_top_bar">Standard Delivery Time</label>
                                                        <input type="text" class="form-control" name="delivery_time"
                                                            value="{{ $settings['delivery_time'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-script" role="tabpanel"
                                            aria-labelledby="v-pills-script-tab">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="header_script">Header Script</label>
                                                    <textarea name="header_script" rows="8" class="form-control br-8 ckeditor" placeholder="Enter Something ...">{{ $settings['header_script'] ?? '' }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="footer_script">Footer Script</label>
                                                    <textarea name="footer_script" rows="8" class="form-control br-8 ckeditorspecification"
                                                        placeholder="Enter Something ...">{{ $settings['footer_script'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-lg btn-primary"><i
                                                class="fa-solid fa-rotate"></i> Update Setting</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $('.mainlogo').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.footerlogo').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.banner_image').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.fav_icon').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


        $('.top_notification_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });



        $('.team_page_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


        $('.blog_page_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


        $('.single_page_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


        $('.package_page_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });


        $('.about_page_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        $('.feature_banner').dropify({
            messages: {
                'default': '',
                'replace': '',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endsection
