<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ config('app.name') }}</title>

    @include('website.partials.links')
    @yield('css')
    <style>
        .ck-editor__editable_inline {
            min-height: 250px;
        }
    </style>
</head>

<body class="">
    <header class="site-header rt-fixed-top account-setup-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <a href="{{ route('website.home') }}" class="brand-logo"><img
                                    src="{{ asset('frontend') }}/assets/images/logo/logo.png" alt="jobpilot_logo"></a>
                        </div>
                        <div class="col-md-6 d-md-flex align-items-center justify-content-end">
                            <div class="progress-wrap">
                                <div class="progress-title d-flex align-items-center justify-content-between rt-mb-12">
                                    <p class="text-gray-500 f-size-14 m-0">{{ __('setup_progress') }}</p>
                                    <h4 class="text-primary-500 f-size-14 ft-wt-5 lh-1 m-0">
                                        <span class="test">
                                            100%
                                        </span> Completed
                                    </h4>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar w-100-p"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.container -->
            </div><!-- /.navbar -->
        </div><!-- /.main-header -->
    </header>


    <div class="dashboard-wrapper account-setup">
        <div class="container">
            <fieldset>
                <div class="account-successfull-wrap">
                    <div class="account-successfull-icon">
                        <x-svg.check-double-icon />
                    </div>
                    <div class="account-successfull-data">
                        <h4>🎉 {{ __('congratulations_you_profile_is_complete') }}</h4>
                        <p>{{ __('now_you_can_start_using_your_account_you_can_post_job_purchase_plan_for_upcoming_job_and_many_more_enjoy') }}!
                        </p>
                    </div>
                    <a href="{{ route('company.dashboard') }}" class="btn bg-gray-50 rt-mr-8">
                        {{ __('view_dashboard') }}
                    </a>
                    <a href="{{ route('company.job.create') }}" class="btn btn-primary">
                        <span class="button-content-wrapper ">
                            <span class="button-icon align-icon-right">
                                <i class="ph-arrow-right"></i>
                            </span>
                            <span class="button-text">
                                {{ __('post_job') }}
                            </span>
                        </span>
                    </a>
                </div>
            </fieldset>
        </div>
    </div>

    <div class="rt-mobile-menu-overlay"></div><!-- /.rt-mobile-menu-overlay -->

    <!-- scripts -->
    @include('website.partials.scripts')
    @yield('script')
</body>

</html>
