@extends('auth.layouts.auth')

@section('meta')
    @php
    $data = metaData('login');
    @endphp
@endsection

@section('description')
    {{ $data->description }}
@endsection

@section('title')
    {{ __('login') }}
@endsection

@section('og:image')
    {{ asset($data->image) }}
@endsection

@section('content')
    <div class="row mt-5">
        <div class="full-height col-12 order-1 order-lg-0">
            <div class="container">
                <div class="row full-height align-items-center">
                    <div class="col-xl-5 col-lg-6 col-md-12">
                        <div class="auth-box2">
                            <form action="{{ route('login') }}" method="POST" class="rt-form" id="login_form">
                                @csrf
                                <h4 class="rt-mb-20">{{ __('log_in') }}</h4>
                                <span class="d-block body-font-3 text-gray-600 rt-mb-32">
                                    {{ __('dont_have_account') }}
                                    <span>
                                        <a href="{{ route('register') }}">{{ __('create_account') }}
                                        </a>
                                    </span>
                                </span>
                                <div class="fromGroup rt-mb-15">
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="{{ __('email_address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="rt-mb-15">
                                    <div class="d-flex fromGroup">
                                        <input name="password" id="password" value=""
                                            class="form-control @error('password') is-invalid @enderror" type="password"
                                            placeholder="{{ __('password') }}">
                                        <div onclick="passToText('password','eyeIcon')" id="eyeIcon" class="has-badge">
                                            <i class="ph-eye @error('password') m-3 @enderror"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex flex-wrap rt-mb-30">
                                    <div class="flex-grow-1">
                                        <div class="form-check from-chekbox-custom">
                                            <input name="remember" id="remember" class="form-check-input" type="checkbox"
                                                value="1">
                                            <label class="form-check-label pointer text-gray-700 f-size-14" for="remember">
                                                {{ __('keep_me_logged') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex-grow-0">
                                        <span class="body-font-4">
                                            <a href="{{ route('password.request') }}" class="text-primary-500">
                                                {{ __('forget_password') }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <button id="submitButton" type="submit" class="btn btn-primary d-block rt-mb-15">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <x-svg.rightarrow-icon />
                                        </span>
                                        <span class="button-text">
                                            {{ __('log_in') }}
                                        </span>
                                    </span>
                                </button>
                            </form>
                            <div class="">
                                <div class="row">
                                    @php
                                        $google = config('zakirsoft.google_active') && config('zakirsoft.google_id') && config('zakirsoft.google_secret');
                                        $facebook = config('zakirsoft.facebook_active') && config('zakirsoft.facebook_id') && config('zakirsoft.facebook_secret');
                                        $twitter = config('zakirsoft.twitter_active') && config('zakirsoft.twitter_id') && config('zakirsoft.twitter_secret');
                                        $linkedin = config('zakirsoft.linkedin_active') && config('zakirsoft.linkedin_id') && config('zakirsoft.linkedin_secret');
                                        $github = config('zakirsoft.github_active') && config('zakirsoft.github_id') && config('zakirsoft.github_secret');
                                    @endphp

                                    @if ($google)
                                        <div class="justify-content-center col-sm-6 col-md-6 mb-1">
                                            <a href="{{ route('social.login', 'google') }}"
                                                class="btn btn-outline-plain d-block custom-padding me-3 rt-mb-xs-10 ">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-left">
                                                        <x-svg.google-icon />
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('login_with_google') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($facebook)
                                        <div class="justify-content-center col-sm-6 col-md-6 mb-1">
                                            <a href="{{ route('social.login', 'facebook') }}"
                                                class="btn btn-outline-plain d-block custom-padding me-3 rt-mb-xs-10 ">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-left">
                                                        <x-svg.facebook-icon />
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('login_with_facebook') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($twitter)
                                        <div class="justify-content-center col-sm-6 col-md-6 mb-1">
                                            <a href="{{ route('social.login', 'twitter') }}"
                                                class="btn btn-outline-plain d-block custom-padding me-3 rt-mb-xs-10 ">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-left">
                                                        <x-svg.twitter-icon fill="#007ad9" />
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('login_with_twitter') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($linkedin)
                                        <div class="justify-content-center col-sm-6 col-md-6 mb-1">
                                            <a href="{{ route('social.login', 'linkedin') }}"
                                                class="btn btn-outline-plain d-block custom-padding me-3 rt-mb-xs-10 ">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-left">
                                                        <x-svg.linkedin-icon />
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('login_with_linkedin') }}
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                    @if ($github)
                                        <div class="justify-content-center col-sm-6 col-md-6 mb-1">
                                            <a href="{{ route('social.login', 'github') }}"
                                                class="btn btn-outline-plain d-block custom-padding me-3 rt-mb-xs-10 ">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-left">
                                                        <x-svg.github-icon />
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('login_with_github') }}
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
        <div class="auth-right-sidebar order-lg-1 order-0">
            <div class="sidebar-bg" style="background-image: url({{ asset($cms_setting->login_page_image) }})">
                <div class="sidebar-content">
                    <h4 class="text-gray-10 rt-mb-50">{{ openJobs() }} {{ __('open_jobs_waiting_for_you') }}</h4>
                    <div class="d-flex">
                        <div class="flex-grow-1 rt-mb-24">
                            <div class="card jobcardStyle1 counterbox4">
                                <div class="card-body">
                                    <div class="rt-single-icon-box icon-center2">
                                        <div class="icon-thumb">
                                            <div class="icon-64">
                                                <x-svg.livejob-icon />
                                            </div>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-20 ft-wt-5"><span
                                                    class="counter">{{ livejob() }}</span></div>
                                            <span class=" f-size-14">{{ __('live_job') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1  rt-mb-24">
                            <div class="card jobcardStyle1 counterbox4">
                                <div class="card-body">
                                    <div class="rt-single-icon-box icon-center2">
                                        <div class="icon-thumb">
                                            <div class="icon-64">
                                                <x-svg.thumb-icon />

                                            </div>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-20 ft-wt-5"><span
                                                    class="counter">{{ companies() }}</span></div>
                                            <span class=" f-size-14">{{ __('companies') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-1 rt-mb-24">
                            <div class="card jobcardStyle1 counterbox4">
                                <div class="card-body">
                                    <div class="rt-single-icon-box icon-center2">
                                        <div class="icon-thumb">
                                            <div class="icon-64">
                                                <x-svg.newjobs-icon />
                                            </div>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-20 ft-wt-5"><span
                                                    class="counter">{{ newjob() }}</span></div>
                                            <span class=" f-size-14">{{ __('new_jobs') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            Validate();
            $('#email, #password').keyup(Validate);
        });

        function Validate() {
            if (
                $('#email').val().length > 0 &&
                $('#password').val().length > 0) {
                $('#submitButton').prop('disabled', false);
            } else {
                $('#submitButton').prop('disabled', true);
            }
        }

        function passToText(id, icon) {
            var input = $('#' + id);
            var eyeIcon = $('#' + icon);
            if (input.is('input[type="password"]')) {
                eyeIcon.html('<i class="ph-eye-slash @error('password') m-3 @enderror"></i>');
                input.attr('type', 'text');
            } else {
                eyeIcon.html('<i class="ph-eye @error('password') m-3 @enderror"></i>');
                input.attr('type', 'password');
            }
        }

        function loginCredentials(type) {
            if (type == 'candidate') {
                $('#email').val('candidate@mail.com')
                $('#password').val('password')
            } else {
                $('#email').val('company@mail.com')
                $('#password').val('password')
            }

            $('#login_form').submit();
        }
    </script>
@endsection
