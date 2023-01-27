<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ __('reset_password') }} - {{ config('app.name') }}</title>

    {{-- Style --}}
    @include('website.partials.links')
</head>

<body class="" dir="{{ langDirection() }}">

    <header class="site-header rt-fixed-top auth-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container container-full-xxl">
                    <a href="/" class="brand-logo"><img src="{{ $setting->dark_logo_url }}" alt=""></a>
                </div><!-- /.container -->
            </div><!-- /.navbar -->
        </div><!-- /.main-header -->
    </header>

    <div class="row">
        <div class="auth-page2 order-1 order-lg-0">
            <div class="rt-spacer-100  rt-spacer-lg-50 rt-spacer-xs-50"></div>
            <div class="rt-spacer-100 rt-spacer-lg-50 rt-spacer-xs-0"></div>
            <div class="rt-spacer-50 rt-spacer-lg-0 rt-spacer-xs-0"></div>
            <div class="container">
                <div class="row ">
                    <div class="col-xl-5 col-lg-8 col-md-9">
                        <div class="auth-box2">
                            <form method="POST" action="{{ route('password.update') }}" class="rt-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4 class="rt-mb-20">{{ __('reset_password') }}</h4>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="d-none fromGroup rt-mb-15">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}"
                                        placeholder="{{ __('email_address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="rt-mb-15">
                                    <div class="d-flex fromGroup">
                                        <input name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" type="password"
                                            placeholder="{{ __('password') }}">
                                        <div onclick="passToText('password','eyeIcon')" id="eyeIcon"
                                            class="has-badge">
                                            <i class="ph-eye @error('password') m-3 @enderror"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger"
                                            role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="rt-mb-15">
                                    <div class="d-flex fromGroup">
                                        <input name="password_confirmation" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            type="password" placeholder="{{ __('confirm_password') }}">
                                        <div onclick="passToText('password_confirmation','eyeIcon2')" id="eyeIcon2"
                                            class="has-badge">
                                            <i class="ph-eye @error('password_confirmation') m-3 @enderror"></i>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-danger"
                                            role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <button id="submitButton" type="submit" class="btn btn-primary d-block rt-mb-15">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 12H19" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 5L19 12L12 19" stroke="white" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                        <span class="button-text">
                                            {{ __('reset_password') }}
                                        </span>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
        </div>

        <div class="auth-right-sidebar col-12 order-0 order-lg-1 rt-mb-lg-30">
            <div class="auth-right-sidebar order-lg-1 order-0">
                <div class="sidebar-bg"
                    style="background-image: url({{ asset($cms_setting->login_page_image) }})">
                    <div class="sidebar-content">
                        <h4 class="text-gray-10 rt-mb-50">11 {{ __('open_jobs_waiting_for_you') }}</h4>
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
    </div>
    <!-- scripts -->
    @include('website.partials.scripts')
    <script>
        $(document).ready(function() {
            validate();
            $('#password, #password_confirmation').keyup(validate);
        });

        function validate() {
            if (
                $('#password').val().length > 0 && $('#password_confirmation').val().length > 0) {
                $('#submitButton').attr('disabled', false);
            } else {
                $('#submitButton').attr('disabled', true);
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
    </script>
</body>

</html>
