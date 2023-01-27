@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('candidate-details');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($candidate->candidate ? $candidate->candidate->photo : $candidate->image) }}
@endsection
@section('title')
    {{ ucfirst($candidate->username) }} {{ __('details') }}
@endsection

@section('css')
@endsection
@section('main')
    <div class="breadcrumbs breadcrumbs-height">
        <div class="container">
            <div class="breadcrumb-menu">
                <h6 class="f-size-18 m-0">{{ $candidate->name }}</h6>
                <ul>
                    <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                    <li>/</li>
                    <li>{{ $candidate->name }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="single-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="pgae-bg bgprefix-cover page-bg-radius"
                        style="background-image: url({{ asset($candidate->candidate ? $candidate->candidate->photo : $candidate->image) }});">
                    </div>
                    <div
                        class="card jobcardStyle1 hover:bg-transparent hover-shadow:none body-24 hover:border-transparent border border-gray-50">
                        <div class="card-body">
                            <div class="rt-single-icon-box flex-column flex-lg-row">
                                <div class="icon-thumb rt-mb-lg-20">
                                    <img src="{{ asset($candidate->candidate ? $candidate->candidate->photo : $candidate->image) }}"
                                        alt="" draggable="false">
                                </div>
                                <div class="iconbox-content">
                                    <div class="post-info2">
                                        <div class="post-main-title2">
                                            <a href="{{ route('website.candidate.details', $candidate->username) }}">
                                                {{ $candidate->name }}
                                            </a>
                                            <span class="badge rounded-pill bg-danger-50 text-danger-500">
                                                @if ($candidate->candidate)
                                                    {{ $candidate->candidate->profession ? $candidate->candidate->profession->name : '' }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="iconbox-extra align-self-start align-self-lg-center rt-pt-lg-20 flex-md-row flex-column">
                                    @if (Auth()->user() ? auth()->user()->role == 'company' : '')
                                        <div class="iconbox-extra">
                                            @if ($candidate->candidate ? $candidate->candidate->bookmark_candidates_count : '')
                                                <form
                                                    action="{{ $candidate->candidate ? route('company.companybookmarkcandidate', $candidate->candidate->id) : '#' }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                                                fill="var(--primary-500)"
                                                                stroke="{{ $setting->frontend_primary_color }}"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <form
                                                    action="{{ $candidate->candidate ? route('company.companybookmarkcandidate', $candidate->candidate->id) : '#' }}"
                                                    method="POST">
                                                    @csrf
                                                    <button
                                                        class="hoverbg-primary-50 text-primary-500 plain-button icon-button">
                                                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M15 19L8 14L1 19V3C1 2.46957 1.21071 1.96086 1.58579 1.58579C1.96086 1.21071 2.46957 1 3 1H13C13.5304 1 14.0391 1.21071 14.4142 1.58579C14.7893 1.96086 15 2.46957 15 3V19Z"
                                                                stroke="{{ $setting->frontend_primary_color }}"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                    @if ($candidate->candidate && $candidate->candidate->cv && $candidate->candidate->cv_visibility)
                                        <div class="max-311">
                                            <a href="" class="btn btn-primary btn-lg d-block"
                                                download="{{ asset('frontend') }}/assets/images/all-img/single-candidate-1.jpg"
                                                href="{{ asset('frontend') }}/assets/images/all-img/single-candidate-1.jpg">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right">
                                                        <i class="ph-cloud-arrow-down f-size-24"></i>
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('download_cv') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Single job content Area-->
    <div class="single-job-content rt-pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 rt-mb-lg-30">
                    <div class="body-font-1 ft-wt-5 rt-mb-20">{{ __('biography') }}</div>
                    <div class="body-font-3 text-gray-500">
                        {!! $candidate->candidate ? $candidate->candidate->bio : '' !!}
                    </div>
                    <div class="share-job rt-pt-50">
                        <ul class="rt-list gap-8">
                            <li class="d-inline-block body-font-3">
                                {{ __('share_this_profile') }}:
                            </li>
                            <li class="d-inline-block ms-3">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}">
                                    <button class="btn btn-outline-plain hover-fb">
                                        <span class="f-size-18 text-primary-500">
                                            <x-svg.facebook-icon width="1em" height="1em" />
                                        </span>
                                        <span class="text-primary-500">{{ __('facebook') }}</span>
                                    </button>
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}">
                                    <button class="btn btn-outline-plain hover-tw">
                                        <span class="f-size-18 text-twitter">
                                            <x-svg.twitter-icon width="1em" height="1em" />
                                        </span>
                                        <span class="text-twitter">{{ __('twitter') }}</span>
                                    </button>
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'pinterest') }}">
                                    <button class="btn btn-outline-plain hover-pin">
                                        <span class="f-size-18 text-pinterest me-1">
                                            <x-svg.pinterest-icon />
                                        </span>
                                        <span class="text-pinterest">{{ __('pinterest') }}</span>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cadidate-details-sidebar">
                        <div class="sidebar-widget">
                            <div class="row">
                                @if ($candidate->candidate->birth_date)
                                    <div class="col-sm-4">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <x-svg.birth-date-icon />
                                            </div>
                                            <h3 class="sub-title">{{ __('date_of_birth') }}</h3>
                                            <h2 class="title">
                                                {{ formatTime($candidate->candidate->birth_date, 'd F, Y') }}
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                @if ($candidate->contactInfo->country->name)
                                    <div class="col-sm-4">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <x-svg.fold-icon />
                                            </div>
                                            <h3 class="sub-title">{{ __('nationality') }}</h3>
                                            <h2 class="title">{{ $candidate->contactInfo->country->name }}
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                @if ($candidate->candidate->marital_status)
                                    <div class="col-sm-4">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <x-svg.board-icon />
                                            </div>
                                            <h3 class="sub-title">{{ __('marital_status') }}</h3>
                                            <h2 class="title">
                                                {{ ucfirst($candidate->candidate->marital_status) }}
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                @if ($candidate->candidate->gender)
                                    <div class="col-sm-4">
                                        <div class="icon-box">
                                            <div class="icon-img">
                                                <x-svg.gender />
                                            </div>
                                            <h3 class="sub-title">{{ __('gender') }}</h3>
                                            <h2 class="title">
                                                {{ $candidate->candidate ? ucfirst($candidate->candidate->gender) : '' }}
                                            </h2>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-4">
                                    <div class="icon-box">
                                        <div class="icon-img">
                                            <i class="ph-suitcase-simple f-size-24 text-primary-500"></i>
                                        </div>
                                        <h3 class="sub-title">{{ __('experience') }}</h3>
                                        <h2 class="title">
                                            {{ $candidate->candidate->experience->name }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <div class="contact">
                                <h2 class="title">{{ __('contact_information') }}</h2>
                                @if ($candidate->website)
                                    <div class="contact-icon-box">
                                        <div class="icon-img">
                                            <x-svg.globe-icon />
                                        </div>

                                        <div class="info">
                                            <h3 class="subtitle">
                                                {{ __('website') }}
                                            </h3>
                                            <h2 class="title">{{ $candidate->website }}</h2>
                                        </div>
                                    </div>
                                @endif
                                <div class="devider"></div>
                                <div class="contact-icon-box">
                                    <div class="icon-img">
                                        <x-svg.location2-icon />
                                    </div>
                                    <div class="info">
                                        <h3 class="subtitle">{{ __('location') }}</h3>
                                        <h2 class="title">
                                            {{ $candidate->full_address }}
                                        </h2>
                                    </div>
                                </div>
                                <p class="address">{{ $candidate->contactInfo->address }}</p>
                                @if (($candidate->contactInfo && $candidate->contactInfo->phone) || $candidate->contactInfo->secondary_phone)
                                    <div class="devider"></div>
                                    <div class="contact-icon-box">
                                        <div class="icon-img">
                                            <x-svg.telephone-icon />
                                        </div>
                                        <div class="info">
                                            @if ($candidate->contactInfo->phone)
                                                <h3 class="subtitle">{{ __('phone') }}</h3>
                                                <h2 class="title">{{ $candidate->contactInfo->phone }}</h2>
                                            @endif
                                            @if ($candidate->contactInfo->secondary_phone)
                                                <h3 class="subtitle">{{ __('secondary_phone') }}</h3>
                                                <h2 class="title">
                                                    {{ $candidate->contactInfo->secondary_phone }}</h2>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                @if ($candidate->contactInfo->email)
                                    <div class="devider"></div>
                                    <div class="contact-icon-box">
                                        <div class="icon-img">
                                            <x-svg.envelope-icon height="32" width="32" />
                                        </div>
                                        <div class="info">
                                            <h3 class="subtitle">{{ __('email_address') }}</h3>
                                            <h2 class="title">{{ $candidate->contactInfo->email }}</h2>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if (($candidate->socialInfo && $candidate->socialInfo->facebook) || $candidate->socialInfo->twitter || $candidate->socialInfo->instagram || $candidate->socialInfo->youtube)
                            <div class="p-32 border border-1.5 border-primary-50 rt-rounded-12  max-536">
                                <div class="row g-0">
                                    <div class="col-xl-5 d-flex align-items-center">
                                        <div class="f-size-18 text-gray-600">
                                            {{ __('social_profile') }}:
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-12 rt-pt-lg-10 text-xxl-end text-start">
                                        <ul class="rt-list gap-8">
                                            @if ($candidate->socialInfo->facebook)
                                                <li class="d-inline-block">
                                                    <a href="{{ $candidate->socialInfo ? $candidate->socialInfo->facebook : '' }}"
                                                        target="__black"
                                                        class="icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                        <x-svg.facebook-icon fill="currentColor" />
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($candidate->socialInfo->twitter)
                                                <li class="d-inline-block">
                                                    <a href="{{ $candidate->socialInfo ? $candidate->socialInfo->twitter : '' }}"
                                                        class="icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                        <x-svg.twitter-icon />
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($candidate->socialInfo->instagram)
                                                <li class="d-inline-block">
                                                    <a href="{{ $candidate->socialInfo ? $candidate->socialInfo->instagram : '' }}"
                                                        class="icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                        <x-svg.instagram-icon />
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($candidate->socialInfo->linkedin)
                                                <li class="d-inline-block">
                                                    <a href="{{ $candidate->socialInfo ? $candidate->socialInfo->linkedin : '' }}"
                                                        class="icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                        <x-svg.linkedin-icon />
                                                    </a>
                                                </li>
                                            @endif
                                            @if ($candidate->socialInfo->youtube)
                                                <li class="d-inline-block">
                                                    <a href="{{ $candidate->socialInfo ? $candidate->socialInfo->youtube : '' }}"
                                                        class="icon-44 bg-gray-10 bg-primary-50 text-primary-500 hover:border-primary-500">
                                                        <x-svg.youtube-icon />
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rt-spacer-100 rt-spacer-md-50"></div>
@endsection
