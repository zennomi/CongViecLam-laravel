<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - {{ config('app.name') }}</title>

    @include('website.partials.links')
    @yield('css')
</head>

<body class="">
    <header class="site-header rt-fixed-top auth-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container">
                    <a href="javascript:void(0)" class="brand-logo"><img src="{{ $setting->dark_logo_url }}"
                            alt=""></a>
                </div><!-- /.container -->
            </div><!-- /.navbar -->
        </div><!-- /.main-header -->
    </header>

    <section class="comming-soon comming-soon-height position-parent">
        <div class="container">
            <div class="row comming-soon-height align-items-center">
                <div class="col-lg-5 rt-mb-24 order-1 order-lg-0">
                    <h2 class="rt-mb-24">{{ __('our_website_is_under_construction') }}</h2>
                    <div class="body-font-2 text-gray-500">
                        <p>{{ __('we_are_working_hard_to_make_our_website_ready_for_you_we_will_be_back_soon') }}</p>
                    </div>
                </div>
                <div class="col-lg-7 rt-mb-24  text-end order-0 order-lg-1">
                    <img src="{{ asset($cms_setting->maintenance_image) }}" alt="">
                </div>
            </div>
        </div>
        <div class="fixed-footer-comming-soon fixed-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 ">
                        <span class="body-font-3 text-gray-900 rt-mb-15 d-block">{{ __('follow_us') }}</span>
                        <ul class="rt-list social-icons">
                            <li>
                                <a href="#">
                                    <x-svg.facebook-icon width="18px" height="18px" fill="#0066FF" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <x-svg.twitter-icon width="18px" height="18px" fill="#0066FF" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <x-svg.instagram2-icon />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <x-svg.youtube2-icon />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 rt-pt-lg-20 text-md-end body-font-4 text-gray-500 align-self-end">
                        <x-website.footer-copyright />
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="rt-mobile-menu-overlay"></div><!-- /.rt-mobile-menu-overlay -->

    <!-- scripts -->
    @include('website.partials.scripts')
    @yield('script')
</body>

</html>

