<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>{{ __('job_promote') }}</title>
    @include('website.partials.links')
</head>

<body class="">
    <header class="site-header rt-fixed-top account-setup-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <a href="{{ route('website.home') }}" class="brand-logo"><img
                                    src="{{ $setting->dark_logo_url }}" alt="jobpilot_logo"></a>
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
                    <div class="account-successfull-data">
                        <form id="form" action="{{ route('company.job.promote', $jobCreated->id) }}"
                            method="POST">
                            @csrf
                            <h4>{{ __('promote_job') }}: {{ $jobCreated->title }}</h4>
                            <p>
                                 {!! Str::limit($jobCreated->description, 147) !!}
                            </p>
                            <div class="d-flex flex-column flex-md-row m-40 justify-content-between m-0 rt-mb-32">
                                <div class="form-check promote-form from-radio-custom">
                                    <x-svg.featured-icon />
                                    <div class="d-flex align-items-center ms-4 mt-4">
                                        <input {{ $jobCreated->featured ? 'checked' : '' }} value="featured"
                                            class="form-check-input" type="radio" name="badge"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label f-size-14 pointer" for="flexRadioDefault1">
                                            {{ __('featured') }} ({{ __('on_the_top') }})
                                        </label>
                                    </div>
                                </div>
                                <div class="form-check promote-form from-radio-custom">
                                    <x-svg.highlight-icon />
                                    <div class="d-flex align-items-center ms-5">
                                        <input {{ $jobCreated->highlight ? 'checked' : '' }} value="highlight"
                                            class="form-check-input" type="radio" name="badge"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label f-size-14 pointer" for="flexRadioDefault2">
                                            {{ __('highlight') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex m-40 justify-content-between m-0 bottom">
                                <a href="{{ route('company.myjob') }}">
                                    <button id="submitButton" type="button" class="btn mer-0 p-0 rt-mb-15">
                                        <span class="button-content-wrapper ">
                                            <span class="button-text">
                                                {{ __('skip_now') }}
                                            </span>
                                        </span>
                                    </button>
                                </a>

                                <button id="submitButton" type="submit" class="btn mer-0 btn-primary rt-mb-15">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <x-svg.rightarrow-icon />
                                        </span>
                                        <span class="button-text">
                                            {{ __('promote_job') }}
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

    @include('website.partials.scripts')
    <script>
        $('.form-check').on('click', function() {
            $('input:radio', this).prop('checked', true);
        });
    </script>
</body>

</html>
