@extends('auth.layouts.progress')
@section('content')
    <header class="n-header account-setup-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-sm-12 col-md-6">
                            <a href="{{ route('website.home') }}" class="brand-logo">
                                <img src="{{ $setting->dark_logo_url }}" alt="jobpilot_logo">
                            </a>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center justify-content-center">
                            <div class="progress-wrap">
                                <div class="progress-title d-flex align-items-center justify-content-between rt-mb-12">
                                    <p class="text-gray-500 f-size-14 m-0">
                                        {{ __('setup_progress') }}
                                    </p>
                                    <h4 class="text-primary-500 f-size-14 ft-wt-5 lh-1 m-0">
                                        <span class="test">
                                            @if (!auth()->user()->company->profile_completion)
                                                @if (request()->has('profile'))
                                                    25%
                                                @elseif(request()->has('social'))
                                                    50%
                                                @elseif(request()->has('contact'))
                                                    75%
                                                @elseif(request()->has('complete'))
                                                    100%
                                                @else
                                                    0%
                                                @endif
                                            @else
                                                100%
                                            @endif
                                        </span> {{ __('completed') }}
                                    </h4>
                                </div>
                                @php
                                    $progress = request()->has('profile') ? '25%' : (request()->has('social') ? '50%' : (request()->has('contact') ? '75%' : (request()->has('complete') ? '100%' : '0%')));
                                    if (auth()->user()->company->profile_completion) {
                                        $progress = '100%';
                                    }
                                @endphp

                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $progress }} !important;"></div>
                                </div>
                            </div>
                            <div class="rt-ml-22">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#1a0a0a"
                                        viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none"></rect>
                                        <polyline points="174 86 216 128 174 170" fill="none" stroke="#1a0a0a"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></polyline>
                                        <line x1="104" y1="128" x2="216" y2="128" fill="none"
                                            stroke="#1a0a0a" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="16"></line>
                                        <path d="M104,216H48a8,8,0,0,1-8-8V48a8,8,0,0,1,8-8h56" fill="none"
                                            stroke="#1a0a0a" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="16"></path>
                                    </svg>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="dashboard-wrapper account-setup">
        <div class="container">
            <div class="account-progress-wrap cadidate-dashboard-tabs pt-2">
                <div id="msform">
                    @if (!auth()->user()->company->profile_completion)
                        <ul class="nav nav-pills justify-content-center" id="progressbar">
                            <li
                                class="nav-link {{ request()->has('profile') || request()->has('social') || request()->has('contact') ? '' : 'active' }}">
                                <x-svg.user-icon />
                                {{ __('basic') }}
                            </li>
                            <li class="nav-link {{ request()->has('profile') ? 'active' : '' }}">
                                <x-svg.user-round-icon />
                                {{ __('profile') }}
                            </li>
                            <li class="nav-link {{ request()->has('social') ? 'active' : '' }}">
                                <x-svg.globe2-icon />
                                {{ __('social_media') }}
                            </li>
                            <li class="nav-link {{ request()->has('contact') ? 'active' : '' }}">
                                <x-svg.at-icon />
                                {{ __('contact') }}
                            </li>
                        </ul>
                    @endif
                    @if (!auth()->user()->company->profile_completion)
                        @if (!request()->hasAny('profile', 'social', 'contact', 'complete'))
                            <x-website.company.account-progress.personal :user="$user" />
                        @endif
                        @if (request()->has('profile'))
                            <x-website.company.account-progress.profile :user="$user" :countries="$countries"
                                :organization-types="$organization_types" :industry-types="$industry_types" :team-sizes="$team_sizes" />
                        @endif
                        @if (request()->has('social'))
                            <x-website.company.account-progress.social :socials="$socials" />
                        @endif
                        @if (request()->has('contact'))
                            <x-website.company.account-progress.contact :user="$user" />
                        @endif
                    @elseif(auth()->user()->company->profile_completion)
                        <x-website.company.account-progress.complete />
                    @else
                        @if (request()->has('complete'))
                            <x-website.company.account-progress.complete />
                        @endif
                    @endif
                </div>
            </div>

        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500">
            <x-website.footer-copyright />
        </div>
    </div>
@endsection

@section('css')
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
    <style>
        .mymap {
            border-radius: 12px;
        }
    </style>
@endsection

@section('script')
    <script>
        $(".datepicker").attr("autocomplete", "off");

        //init datepicker
        $('.datepicker').off('focus').datepicker({
            format: 'dd-mm-yyyy'
        }).on('click', function() {
            $(this).datepicker('show');
        });

        function UploadMode(param) {
            if (param === 'photo') {
                $('#photo-uploadMode').removeClass('d-none');
                $('#photo-oldMode').addClass('d-none');
            } else {
                $('#banner-uploadMode').removeClass('d-none');
                $('#banner-oldMode').addClass('d-none');
            }
        }
    </script>
    <script type="text/javascript">
        // feature field
        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="col-12 custom-select-padding">
                <div class="d-flex">
                    <div class="d-flex mborder">
                        <div class="position-relative">
                            <select
                                class="w-100-p border-0 rt-selectactive form-control" name="social_media[]">
                                <option value="" class="d-none" disabled selected>{{ __('select_one') }}</option>
                                <option value="facebook">{{ __('facebook') }}</option>
                                <option value="twitter">{{ __('twitter') }}</option>
                                <option value="instagram">{{ __('instagram') }}</option>
                                <option value="youtube">{{ __('youtube') }}</option>
                                <option value="linkedin">{{ __('linkedin') }}</option>
                                <option value="pinterest">{{ __('pinterest') }}</option>
                                <option value="reddit">{{ __('reddit') }}</option>
                                <option value="github">{{ __('github') }}</option>
                                <option value="other">{{ __('other') }}</option>
                            </select>
                        </div>
                        <div class="w-100">
                            <input class="border-0" type="url" name="url[]" id="" placeholder="{{ __('profile_link_url') }}...">
                        </div>
                    </div>
                    <div class="ms-2">
                        <button class="btn btn-primary2-50 cross-btn" type="button" id="remove_item">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#18191C" stroke-width="1.5" stroke-miterlimit="10"/>
                                <path d="M15 9L9 15" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 15L9 9" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `);
            $(".rt-selectactive").select2({ // minimumResultsForSearch: Infinity,
            });
        }
        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent().parent('div').remove();
        });
    </script>
    @include('map::set-googlemap')
    @include('map::set-mapbox')
@endsection
