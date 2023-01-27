@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('about');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <!-- About banner area  start -->
    <div class="rt-about">
        <div class="container">
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
            <div class="rt-spacer-100 rt-spacer-md-20"></div>
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="mx-646">
                        <span
                            class="body-font-3 ft-wt-5 text-primary-500 rt-mb-15 d-inline-block">{{ __('who_we_are') }}</span>
                        <h2 class="rt-mb-40 {{ $setting->nav_color ? '' : $setting->nav_color }}">
                            {{ __('we_are_highly_skilled_and_professionals_team') }}</h2>
                        <p class="body-font-2 text-gray-500 rt-mb-0">
                            {{ __('praesent_non_sem_facilisis_hendrerit_nisi_vitae_volutpat_quam_Aliquam_metus_mauris_semper') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 rt-pt-md-30">
                    <div class="about-counter">
                        <div class="card jobcardStyle1 counterbox2 rt-mb-40">
                            <div class="card-body">
                                <div class="rt-single-icon-box">
                                    <div class="icon-thumb rt-mr-24">
                                        <div class="icon-72">
                                            <i class="ph-suitcase-simple"></i>
                                        </div>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="f-size-24 ft-wt-5 rt-mb-12"><span class="counter">{{ $livejobs }}
                                        </div>
                                        <span class="text-gray-900 f-size-16"> {{ __('live_job') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card jobcardStyle1 counterbox2 rt-mb-40">
                            <div class="card-body">
                                <div class="rt-single-icon-box">
                                    <div class="icon-thumb rt-mr-24">
                                        <div class="icon-72">
                                            <i class="ph-buildings"></i>
                                        </div>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="f-size-24 ft-wt-5 rt-mb-12"><span
                                                class="counter">{{ $companies }}</span></div>
                                        <span class="text-gray-900 f-size-16">{{ __('companies') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card jobcardStyle1 counterbox2">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="icon-thumb rt-mr-24">
                                            <div class="icon-72">
                                                <i class="ph-users"></i>
                                            </div>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-24 ft-wt-5 rt-mb-12"><span
                                                    class="counter">{{ $candidates }}</span></div>
                                            <span class="text-gray-900 f-size-16">{{ __('candidates') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
            <div class="rt-spacer-100 rt-spacer-md-0"></div>
        </div>
    </div>
    <!-- Brands area  start -->
    <div class="brands-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="brand-active">
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo) }}" alt="">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo1) }}" alt="">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo2) }}" alt="">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo3) }}" alt="">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo4) }}" alt="">
                            </a>
                        </div>
                        <div class="single-brand">
                            <a href="#">
                                <img src="{{ asset($cms_setting->about_brand_logo5) }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-75 rt-spacer-md-30"></div>
        <!-- About feature image area  start -->
        <div class="about-feature-img">
            <div class="container">
                <div class="row grid">
                    <div class="col-lg-4 col-sm-6 grid-item">
                        <div class="about-bg-img height-636 bgprefix-cover w-100 rt-rounded-8 rt-mb-24"
                            style="background-image: url({{ asset($cms_setting->about_banner_img) }})"></div>
                    </div>
                    <div class="col-lg-4 col-sm-6 grid-item">
                        <div class="img-middle">
                            <div class="about-bg-img height-312 bgprefix-cover w-100 rt-rounded-8 rt-mb-24"
                                style="background-image: url({{ asset($cms_setting->about_banner_img1) }});"></div>
                            <div class="about-bg-img height-312 bgprefix-cover w-100 rt-rounded-8 rt-mb-24"
                                style="background-image: url({{ asset($cms_setting->about_banner_img2) }});"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 grid-item">
                        <div class="about-bg-img height-636 bgprefix-cover w-100 rt-rounded-8 rt-mb-24"
                            style="background-image: url({{ asset($cms_setting->about_banner_img3) }})"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-10"></div>

        <!-- Misson  area  start -->
        <div class="mission">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span
                            class="body-font-3 ft-wt-5 text-primary-500 rt-mb-15 d-inline-block">{{ __('our_mission') }}</span>
                        <h3 class="rt-mb-32">{{ __('we_are_highly_skilled_and_professionals_team') }}</h3>
                        <p class="body-font-2 text-gray-500 rt-mb-0">
                            {{ __('praesent_non_sem_facilisis_hendrerit_nisi_vitae_volutpat_quam_Aliquam_metus_mauris_semper_metus') }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <img src="{{ $cms_setting->mission_image }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-0"></div>

        <!-- Testomonial area  start -->
        @if ($testimonials->count())
            <div class="testimonials-area2 position-parent  rt-pt-100 rt-pt-md-50">
                <div class="t-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="t-title">{{ __('what_our_people_says') }}</h4>
                            <div class="testimonal2-active">
                                @foreach ($testimonials as $testimonial)
                                    <div class="single-item">
                                        <div class="testimonal-item">
                                            <div class="left-img">
                                                <div class="img-box">
                                                    <img src="{{ asset($testimonial->image) }}" alt=""
                                                        draggable="false">
                                                </div>
                                            </div>
                                            <div class="right-content">
                                                <div class="rt-mb-24">
                                                    @for ($i = 0; $i < $testimonial->stars; $i++)
                                                        <svg width="28" height="28" viewBox="0 0 28 28"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M12.9241 4.51321C13.3643 3.62141 14.636 3.62141 15.0762 4.51321L17.3262 9.07149C17.5009 9.42531 17.8383 9.67066 18.2287 9.72773L23.2623 10.4635C24.2462 10.6073 24.6383 11.8167 23.926 12.5105L20.2856 16.0562C20.0026 16.3319 19.8734 16.7292 19.9402 17.1187L20.7991 22.1264C20.9672 23.1068 19.9382 23.8543 19.0578 23.3913L14.5587 21.0253C14.209 20.8414 13.7913 20.8414 13.4416 21.0253L8.94252 23.3913C8.06217 23.8543 7.03311 23.1068 7.20125 22.1264L8.06013 17.1187C8.12693 16.7292 7.99773 16.3319 7.71468 16.0562L4.07431 12.5105C3.362 11.8167 3.75414 10.6073 4.73804 10.4635L9.7716 9.72773C10.162 9.67066 10.4995 9.42531 10.6741 9.07149L12.9241 4.51321Z"
                                                                fill="#FFAA00" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <div class="text-gray-700 body-font-2 rt-mb-24">
                                                    {{ $testimonial->description }}
                                                </div>
                                                <div class="rt-single-icon-box ">
                                                    <div class="iconbox-content">
                                                        <div class="body-font-1 ft-wt-5">{{ $testimonial->name }}</div>
                                                        <div class="body-font-3 text-gray-500">
                                                            {{ $testimonial->position }}
                                                        </div>
                                                    </div>
                                                    <div class="iconbox-extra">
                                                        <svg width="56" height="56" viewBox="0 0 56 56"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M25.6667 39.6667C25.6667 42.142 24.6833 44.516 22.933 46.2663C21.1827 48.0167 18.8087 49 16.3333 49C13.858 49 11.484 48.0167 9.73367 46.2663C7.98333 44.516 7 42.142 7 39.6667C7 34.51 16.3333 7 16.3333 7H21L16.3333 30.3333C18.8087 30.3333 21.1827 31.3167 22.933 33.067C24.6833 34.8173 25.6667 37.1913 25.6667 39.6667ZM49 39.6667C49 42.142 48.0167 44.516 46.2663 46.2663C44.516 48.0167 42.142 49 39.6667 49C37.1913 49 34.8173 48.0167 33.067 46.2663C31.3167 44.516 30.3333 42.142 30.3333 39.6667C30.3333 34.51 39.6667 7 39.6667 7H44.3333L39.6667 30.3333C42.142 30.3333 44.516 31.3167 46.2663 33.067C48.0167 34.8173 49 37.1913 49 39.6667Z"
                                                                fill="#DADDE6" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="carosle-button">
                                <button class="btn btn-primary-50 slickprev3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 12H5" stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 5L5 12L12 19" stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button class="btn btn-primary-50 slicknext3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12H19" stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M12 5L19 12L12 19" stroke="{{ $setting->frontend_primary_color }}"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Call to action Start -->
        <div class="cta-area rt-pt-100 rt-mb-100 rt-mb-md-30 rt-pt-md-50">
            @include('website.partials.call-to-action')
        </div>

        {{-- Subscribe Newsletter --}}
        <x-website.subscribe-newsletter />
    @endsection

    @section('css')
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick-theme.css">
        <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
    @endsection

    @section('script')
        <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
        <script>
            if ($(".testimonal2-active").length > 0) {
                $(".testimonal2-active").slick({
                    slidesToShow: 1,
                    infinite: true,
                    slidesToScroll: 1,
                    dots: true,
                    fade: true,
                    prevArrow: $(".slickprev3"),
                    nextArrow: $(".slicknext3")
                });
            }
        </script>
    @endsection
