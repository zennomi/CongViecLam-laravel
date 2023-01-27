@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('home');
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
    <section class="banner-section">
        <div class="rt-single-banner5">
            <div class="container position-parent">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="banner-content5">
                            <div class="mx-727" data-aos="fadeindown" data-aos-duration="1000">
                                <h1 class="text-gray-900 rt-mb-24">
                                    {{ __('find_job_that_suits_your_interest_skills') }}
                                </h1>
                                <div class="f-size-18 text-gray-600 rt-mb-30">
                                    {{ __('find_the_perfect_jobs_employment_career_opportunities') }}
                                </div>
                            </div>
                            <form action="{{ route('website.job') }}" method="GET" id="job_search_form">
                                <div class="jobsearchBox d-flex flex-column flex-md-row bg-gray-10 input-transparent rt-mb-24"
                                    data-aos="fadeinup" data-aos-duration="400" data-aos-delay="50">
                                    <div class="flex-grow-1 fromGroup has-icon">
                                        <input id="search" name="keyword" type="text"
                                            placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                                            autocomplete="off">
                                        <div class="icon-badge">
                                            <x-svg.search-icon />
                                        </div>
                                        <span id="autocomplete_job_results"></span>
                                    </div>
                                    <input type="hidden" name="lat" id="lat" value="">
                                    <input type="hidden" name="long" id="long" value="">
                                    @php
                                        $oldLocation = request('location');
                                        $map = setting('default_map');
                                    @endphp
                                    @if ($map == 'map-box')
                                        <div class="flex-grow-1 fromGroup has-icon">
                                            <input type="hidden" name="location" id="insertlocation" value="">
                                            <span id="geocoder"></span>
                                            <div class="icon-badge">
                                                <x-svg.location-icon stroke="{{ $setting->frontend_primary_color }}"
                                                    width="24" height="24" />
                                            </div>
                                        </div>
                                    @endif
                                    @if ($map == 'google-map')
                                        <div class="flex-grow-1 fromGroup has-icon banner-select no-border">
                                            <input type="text" id="searchInput" placeholder="Enter a location..."
                                                name="location" value="{{ $oldLocation }}" />
                                            <div id="google-map" class="d-none"></div>
                                            <div class="icon-badge">
                                                <x-svg.location-icon stroke="{{ $setting->frontend_primary_color }}"
                                                    width="24" height="24" />
                                            </div>
                                        </div>
                                    @endif
                                    <div class="flex-grow-0">
                                        <button type="submit"
                                            class="btn btn-primary d-block d-md-inline-block ">{{ __('find_job') }}</button>
                                    </div>
                                </div>
                            </form>
                            @if ($top_categories->count())
                                <div class="f-size-14 banner-quciks-links " data-aos="" data-aos-duration="1000"
                                    data-aos-delay="500">
                                    <span class="text-gray-400">{{ __('suggestion') }}: </span>
                                    @foreach ($top_categories as $item)
                                        <a href="{{ route('website.job', ['category' => $item->name]) }}">
                                            {{ $item->name }} {{ !$loop->last ? ',' : '' }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-6 d-flex align-items-center">
                        <div class="banner-mockup d-none d-xl-block w-100 text-right">
                            <div class="addimg-1 position-parent video-btn-center">
                                @if ($cms_setting->home_page_banner_image)
                                    <img src="{{ asset($cms_setting->home_page_banner_image) }}" alt=""
                                        draggable="false">
                                @else
                                    <x-banner-image />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Counter Start -->
    <div class="counter-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6 mx-auto rt-mb-30">
                    <div class="card jobcardStyle1 counterbox bg-gray-20 hover:bg-gray-10">
                        <div class="card-body">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb">
                                    <div class="icon-72">
                                        <i class="ph-suitcase-simple"></i>
                                    </div>
                                </div>
                                <div class="iconbox-content">
                                    <div class="f-size-24 ft-wt-5"><span class="counter">{{ $livejobs }}</span>
                                    </div>
                                    <span class="text-gray-500 f-size-16">{{ __('live_job') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 mx-auto rt-mb-30">
                    <div class="card jobcardStyle1 counterbox bg-gray-20 hover:bg-gray-10">
                        <div class="card-body">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb">
                                    <div class="icon-72">
                                        <i class="ph-buildings"></i>
                                    </div>
                                </div>
                                <div class="iconbox-content">
                                    <div class="f-size-24 ft-wt-5"><span class="counter">{{ $companies }}</span>
                                    </div>
                                    <span class="text-gray-500 f-size-16">{{ __('companies') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 mx-auto rt-mb-30">
                    <div class="card jobcardStyle1 counterbox bg-gray-20 hover:bg-gray-10">
                        <div class="card-body">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb">
                                    <div class="icon-72">
                                        <i class="ph-users"></i>
                                    </div>
                                </div>
                                <div class="iconbox-content">
                                    <div class="f-size-24 ft-wt-5"><span class="counter">{{ $candidates }}</span>
                                    </div>
                                    <span class="text-gray-500 f-size-16">{{ __('candidates') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6 mx-auto rt-mb-30">
                    <div class="card jobcardStyle1 counterbox bg-gray-20 hover:bg-gray-10">
                        <div class="card-body">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb">
                                    <div class="icon-72">
                                        <i class="ph-suitcase-simple"></i>
                                    </div>
                                </div>
                                <div class="iconbox-content">
                                    <div class="f-size-24 ft-wt-5"><span class="counter">{{ $newjobs }}</span>
                                    </div>
                                    <span class="text-gray-500 f-size-16">{{ __('new_jobs') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="most-popular-area rt-pt-100 rt-pt-md-50">
        <div class="container">
            <h4>{{ __('most_popular_vacancies') }}</h4>
            <div class="rt-spacer-40 rt-spacer-md-20"></div>
            <div class="row">
                @foreach ($popular_roles as $role)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="most-popular-wrap">
                            <div class="most-popular-item">
                                <h3><a
                                        href="{{ route('website.job', ['job_role' => $role->name]) }}">{{ $role->name }}</a>
                                </h3>
                                <p>{{ $role->open_position_count }} {{ __('open_positions') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rt-spacer-90 rt-spacer-md-50"></div>
    </div>

    <!-- catagory  Start -->
    <section class="catagory-area rt-pt-100 rt-pt-md-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-wrap">
                        <div class="flex-grow-1">
                            <h4>{{ __('popular_category') }}</h4>
                        </div>
                        <div class="flex-grow-0 rt-pt-md-10">
                            <a href="{{ route('website.job') }}" class="btn btn-outline-primary">
                                <span class="button-content-wrapper ">
                                    <span class="button-icon align-icon-right">
                                        <i class="ph-arrow-right"></i>
                                    </span>
                                    <span class="button-text">
                                        {{ __('view_all_jobs') }}
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rt-spacer-40 rt-spacer-md-20"></div>
            <div class="row">
                @foreach ($popular_categories as $category)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <a href="{{ route('website.job', ['category' => $category->name]) }}">
                            <div class="popular-category-item">
                                <div class="popular-category-icon">
                                    <i class="{{ $category->icon }}"></i>
                                </div>
                                <div class="popular-category-data">
                                    <h4>{{ $category->name }}</h4>
                                    <p>{{ $category->open_jobs_count }} {{ __('open_position') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
    </section>

    <!-- Working Process  Start -->
    <div class="working-process bg-gray-20 ">
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center text-h4 ft-wt-5">
                    <span class="text-primary-500 has-title-shape">{{ config('app.name') }}
                        <img src="{{ asset('frontend') }}/assets/images/all-img/title-shape.png" alt="">
                    </span>
                    <label for="">{{ __('working_process') }}</label>
                </div>
            </div>
            <div class="rt-spacer-50"></div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 rt-mb-24 position-parent">
                    <div class="has-arrow">
                        <img src="{{ asset('frontend') }}/assets/images/all-img/arrow-1.png" alt=""
                            draggable="false">
                    </div>
                    <div class="rt-single-icon-box working-progress icon-center">
                        <div class="icon-thumb rt-mb-24">
                            <div class="icon-72">
                                <i class="ph-user-plus"></i>
                            </div>
                        </div>
                        <div class="iconbox-content">
                            <div class="body-font-2 rt-mb-12">{{ __('create_account') }}</div>
                            <div class="body-font-4 text-gray-400">
                                {{ __('create_account_description') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 rt-mb-24 col-sm-6 position-parent">
                    <div class="has-arrow middle">
                        <img src="{{ asset('frontend') }}/assets/images/all-img/arrow-2.png" alt=""
                            draggable="false">
                    </div>
                    <div class="rt-single-icon-box working-progress icon-center">
                        <div class="icon-thumb rt-mb-24">
                            <div class="icon-72">
                                <i class="ph-cloud-arrow-up"></i>
                            </div>
                        </div>
                        <div class="iconbox-content">
                            <div class="body-font-2 rt-mb-12">{{ __('upload_cv_resume') }}</div>
                            <div class="body-font-4 text-gray-400">
                                {{ __('upload_cv_resume_description') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 rt-mb-24 col-sm-6 position-parent">
                    <div class="has-arrow">
                        <img src="{{ asset('frontend') }}/assets/images/all-img/arrow-1.png" alt=""
                            draggable="false">
                    </div>
                    <div class="rt-single-icon-box working-progress icon-center">
                        <div class="icon-thumb rt-mb-24">
                            <div class="icon-72">
                                <i class="ph-magnifying-glass-plus"></i>
                            </div>
                        </div>
                        <div class="iconbox-content">
                            <div class="body-font-2 rt-mb-12">{{ __('find_suitable_job') }}</div>
                            <div class="body-font-4 text-gray-400">
                                {{ __('find_suitable_job_description') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 rt-mb-24 col-sm-6">
                    <div class="rt-single-icon-box working-progress icon-center">
                        <div class="icon-thumb rt-mb-24">
                            <div class="icon-72">
                                <i class="ph-circle-wavy-check"></i>
                            </div>
                        </div>
                        <div class="iconbox-content">
                            <div class="body-font-2 rt-mb-12">{{ __('apply_job') }}</div>
                            <div class="body-font-4 text-gray-400">
                                {{ __('apply_job_description') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
    </div>

    <!-- feature Job Start -->
    @if ($featured_jobs && count($featured_jobs))
        <section class="featurejob-area rt-pt-40 rt-pt-md-20">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="flex-grow-1">
                                <h4>{{ __('featured_job') }}</h4>
                            </div>
                            <a href="{{ route('website.job') }}" class="flex-grow-0 rt-pt-md-10">
                                <button class="btn btn-outline-primary">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <i class="ph-arrow-right"></i>
                                        </span>
                                        <span>
                                            {{ __('view_all') }}
                                        </span>
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="rt-spacer-40 "></div>
                <div class="row">
                    <div class="col-12">
                        <ul class="rt-list">
                            @foreach ($featured_jobs as $job)
                                <x-website.job.job-list :job="$job" />
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- feature Job Start -->
    @if ($top_companies->count() > 0)
        <section class="featurejob-area rt-pt-100 rt-pt-md-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="flex-grow-1">
                                <h4>{{ __('top') }} <span
                                        class="text-primary-500 has-title-shape">{{ __('companies') }}
                                        <img src="{{ asset('frontend') }}/assets/images/all-img/title-shape.png"
                                            alt="">
                                    </span></h4>
                            </div>
                            <a href="{{ route('website.company') }}" class="flex-grow-0 rt-pt-md-10">
                                <button class="btn btn-outline-primary">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <i class="ph-arrow-right"></i>
                                        </span>
                                        <span>
                                            {{ __('view_all') }}
                                        </span>
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="rt-spacer-40 "></div>
                <div class="row">
                    @foreach ($top_companies as $company)
                        <div class="col-xl-4 col-md-6 fade-in-bottom  condition_class rt-mb-24">
                            <div class="card jobcardStyle1">
                                <div class="card-body">
                                    <div class="rt-single-icon-box">
                                        <div class="icon-thumb company-logo">
                                            <img src="{{ $company->logo_url }}" alt="" draggable="false">
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="body-font-1 rt-mb-12"><a
                                                    href="{{ route('website.employe.details', $company->user->username) }}"
                                                    class="text-gr2q  ay-900 hover:text-primary-500">{{ $company->user->name }}</a>
                                            </div>
                                            @isset($company->country)
                                                <span class="loacton text-gray-400 ">
                                                    <i class="ph-map-pin"></i>
                                                    {{ $company->country }}
                                                </span>
                                            @endisset
                                            <span class="loacton text-gray-400 ">
                                                <i class="ph-suitcase-simple"></i>
                                                {{ $company->user->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="post-info d-flex">
                                        <div class="flex-grow-1">
                                            <a href="{{ route('website.employe.details', [$company->user->username, '#open_position']) }}"
                                                type="button" class="btn btn-primary2-50 d-block">
                                                <div class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right">
                                                        <i class="ph-arrow-right"></i>
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('open_position') }}
                                                    </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonail Start -->
    @if ($testimonials->count())
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
        <section class="testimoinals-area bg-gray-20">
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h4>{{ __('clients_testimonial') }}</h4>
                    </div>
                </div>
                <div class="rt-spacer-40 rt-spacer-md-20"></div>
                <div class="row">
                    <div class="col-12 position-parent">
                        <div class="slick-btn-gorup">
                            <button class="btn btn-light slickprev2 p-12">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 12H5" stroke="{{ $setting->frontend_primary_color }}"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 5L5 12L12 19" stroke="{{ $setting->frontend_primary_color }}"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button class="btn btn-light slicknext2 p-12">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="{{ $setting->frontend_primary_color }}"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12 5L19 12L12 19" stroke="{{ $setting->frontend_primary_color }}"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="testimonail_active slick-bullet deafult_style_dot">
                            @foreach ($testimonials as $testimonial)
                                <div class="single-item">
                                    <div class="testimonals-box">
                                        <div class="rt-mb-12">
                                            @for ($i = 0; $i < $testimonial->stars; $i++)
                                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.9241 4.51321C13.3643 3.62141 14.636 3.62141 15.0762 4.51321L17.3262 9.07149C17.5009 9.42531 17.8383 9.67066 18.2287 9.72773L23.2623 10.4635C24.2462 10.6073 24.6383 11.8167 23.926 12.5105L20.2856 16.0562C20.0026 16.3319 19.8734 16.7292 19.9402 17.1187L20.7991 22.1264C20.9672 23.1068 19.9382 23.8543 19.0578 23.3913L14.5587 21.0253C14.209 20.8414 13.7913 20.8414 13.4416 21.0253L8.94252 23.3913C8.06217 23.8543 7.03311 23.1068 7.20125 22.1264L8.06013 17.1187C8.12693 16.7292 7.99773 16.3319 7.71468 16.0562L4.07431 12.5105C3.362 11.8167 3.75414 10.6073 4.73804 10.4635L9.7716 9.72773C10.162 9.67066 10.4995 9.42531 10.6741 9.07149L12.9241 4.51321Z"
                                                        fill="#FFAA00" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <div class="text-gray-600 body-font-3">
                                            {{ $testimonial->description }}
                                        </div>

                                        <div class="rt-single-icon-box">
                                            <div class="icon-thumb rt-mr-12">
                                                <div class="userimage">
                                                    <img src="{{ asset($testimonial->image) }}" alt=""
                                                        draggable="false">
                                                </div>
                                            </div>
                                            <div class="iconbox-content">
                                                <div class="body-font-3">{{ $testimonial->name }}</div>
                                                <div class="body-font-4 text-gray-400">{{ $testimonial->position }}
                                                </div>
                                            </div>
                                            <div class="iconbox-extra">
                                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16 28C16 30.1217 15.1571 32.1566 13.6569 33.6569C12.1566 35.1571 10.1217 36 8 36C5.87827 36 3.84344 35.1571 2.34315 33.6569C0.842854 32.1566 0 30.1217 0 28C0 23.58 8 0 8 0H12L8 20C10.1217 20 12.1566 20.8429 13.6569 22.3431C15.1571 23.8434 16 25.8783 16 28ZM36 28C36 30.1217 35.1571 32.1566 33.6569 33.6569C32.1566 35.1571 30.1217 36 28 36C25.8783 36 23.8434 35.1571 22.3431 33.6569C20.8429 32.1566 20 30.1217 20 28C20 23.58 28 0 28 0H32L28 20C30.1217 20 32.1566 20.8429 33.6569 22.3431C35.1571 23.8434 36 25.8783 36 28Z"
                                                        fill="#DADDE6" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
        </section>
    @endif

    <!-- Call to action Start -->
    @guest
        <section class="cta-area rt-pt-100 rt-mb-80 rt-pt-md-50 rt-mb-md-40">
            @include('website.partials.call-to-action')
        </section>
    @endguest

    {{-- Apply job Modal --}}
    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-transparent">
                    <h5 class="modal-title" id="cvModalLabel">{{ __('apply_job') }}: <span id="apply_job_title">Job
                            Title</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('website.job.apply') }}" method="POST">
                    @csrf
                    <div class="modal-body mt-3">
                        <input type="hidden" id="apply_job_id" name="id">
                        <div class="from-group">
                            <x-forms.label name="choose_resume" :required="true" />
                            <select class="rt-selectactive form-control w-100-p" name="resume_id">
                                <option value="">{{ __('select_one') }}</option>
                                @foreach ($resumes as $resume)
                                    <option {{ old('resume_id') == $resume->id ? 'selected' : '' }}
                                        value="{{ $resume->id }}">{{ $resume->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <x-forms.label name="cover_letter" :required="true" />
                            <textarea id="default" class="form-control @error('cover_letter') is-invalid @enderror" name="cover_letter"
                                rows="7"></textarea>
                            @error('cover_letter')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="bg-priamry-50 btn btn-outline-primary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('cancel') }}</button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <span class="button-content-wrapper ">
                                <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                                <span class="button-text">
                                    {{ __('apply_now') }}
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/aos.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/style.css') }}">
    <style>
        span.select2-container--default .select2-selection--single {
            border: none !important;
        }

        span.select2-selection.select2-selection--single {
            outline: none;
        }

        .marginleft {
            margin-left: 10px !important;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('frontend') }}/assets/js/aos.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
    <script>
        AOS.init({
            disable: "mobile",
            easing: 'ease-in-out-sine',
            once: true
        }); //toggle password

        function applyJobb(id, name) {
            $('#cvModal').modal('show');
            $('#apply_job_id').val(id);
            $('#apply_job_title').text(name);
        }

        if ($(".testimonail_active").length > 0) {
            var _$$slick;

            $(".testimonail_active").slick((_$$slick = {
                    slidesToShow: 3,
                    infinite: true,
                    slidesToScroll: 2,
                    dots: true,
                    prevArrow: $(".slickprev2"),
                    nextArrow: $(".slicknext2")
                }, _defineProperty(_$$slick, "prevArrow", '<button class="slide-arrow prev-arrow"></button>'),
                _defineProperty(_$$slick, "nextArrow", '<button class="slide-arrow next-arrow"></button>'),
                _defineProperty(_$$slick, "responsive", [{
                    breakpoint: 1199,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 320,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }, {
                    breakpoint: 210,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]), _$$slick));
        }
    </script>

    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>

    <script>
        mapboxgl.accessToken = "{{ $setting->map_box_key }}";
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            types: 'country,region,place,postcode,locality,neighborhood'
        });
        geocoder.addTo('#geocoder');
        // Add geocoder result to container.
        geocoder.on('result', (e) => {
            var full_address = e.result.place_name;
            var words = full_address.split(",");
            var country = words.pop();
            var place = words.pop();
            const text = place + ',' + country;
            $('#insertlocation').val(text);
            $('#lat').val(e.result.center[1]);
            $('#long').val(e.result.center[0]);
        });
        // Clear results container when search is cleared.
        geocoder.on('clear', () => {
            results.innerText = '';
        });
    </script>
    <script>
        $('.mapboxgl-ctrl-geocoder--icon').hide();
        $('.mapboxgl-ctrl-geocoder--input').attr("placeholder", "Location");
        var oldLocation = "{!! $oldLocation !!}";
        if (oldLocation) {
            $('.mapboxgl-ctrl-geocoder--input').val(oldLocation);
        }
    </script>
    <!-- ============== gooogle map ========== -->
    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";
            var oldlat = {{ Session::has('location') ? Session::get('location')['lat'] : setting('default_lat') }};
            var oldlng = {{ Session::has('location') ? Session::get('location')['lng'] : setting('default_long') }};
            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 7,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });
            // Search
            var input = document.getElementById('searchInput');
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });
            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                const total = place.address_components.length;
                let amount = '';
                if (total > 1) {
                    amount = total - 2;
                }
                const result = place.address_components.slice(amount);
                let country = '';
                let region = '';
                for (let index = 0; index < result.length; index++) {
                    const element = result[index];
                    if (element.types[0] == 'country') {
                        country = element.long_name;
                    }
                    if (element.types[0] == 'administrative_area_level_1') {
                        const str = element.long_name;
                        const first = str.split(',').shift()
                        region = first;
                    }
                }
                const text = region + ',' + country;
                $('#insertlocation').val(text);
                $('#lat').val(place.geometry.location.lat());
                $('#long').val(place.geometry.location.lng());
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
            });
        }
        window.initMap = initMap;
    </script>
    <script>
        @php
            $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
            $link2 = $setting->google_map_key;
            $Link3 = '&callback=initMap&libraries=places,geometry';
            $scr = $link1 . $link2 . $Link3;
        @endphp;
    </script>
    <script src="{{ $scr }}" async defer></script>

    <script src="{{ asset('frontend') }}/assets/js/axios.min.js"></script>
    <script>
        var current_user_location_set = localStorage.getItem('current_location');
        if (!current_user_location_set) {
            axios.post(
                    '/set/current/location'
                )
                .then((res) => {
                    // console.log(res.data);
                })
                .catch((e) => {});
            localStorage.setItem('current_location', true);
        }

        var path = "{{ route('website.job.autocomplete') }}";

        $('#search').keyup(function(e) {
            var keyword = $(this).val();

            if (keyword != '') {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: keyword
                    },
                    success: function(data) {
                        $('#autocomplete_job_results').fadeIn();
                        $('#autocomplete_job_results').html(data);
                    }
                });
            } else {
                $('#autocomplete_job_results').fadeOut();
            }
        });
    </script>
@endsection
