@extends('website.layouts.app')

@section('title')
    {{ __('post_job') }}
@endsection

@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                {{-- Sidebar --}}
                <x-website.company.sidebar />
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard-right-header rt-mb-32">
                            <span class="sidebar-open-nav">
                                <i class="ph-list"></i>
                            </span>
                        </div>
                        <form action="{{ route('company.job.store') }}" method="POST" class="rt-from">
                            @csrf
                            <div class="post-job-item rt-mb-15">
                                <div class="rt-mb-20">
                                    <x-forms.label name="job_title" :required="true" />
                                    <input value="{{ old('title') }}" name="title"
                                        class="form-control @error('title') is-invalid @enderror" type="text"
                                        placeholder="{{ __('job_title') }}" id="m">
                                    @error('title')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 rt-mb-20 col-md-6">
                                        <x-forms.label name="job_category" :required="true" />
                                        <select
                                            class="w-100-p select2-taggable form-control @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            @foreach ($jobCategories as $category)
                                                <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 rt-mb-20 col-md-6">
                                        <x-forms.label name="job_role" :required="true" />
                                        <select
                                            class="w-100-p select2-taggable form-control @error('role_id') is-invalid @enderror"
                                            name="role_id">
                                            @foreach ($roles as $role)
                                                <option {{ old('role_id') == $role->id ? 'selected' : '' }}
                                                    value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="post-job-item rt-mb-15">
                                <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">
                                    {{ __('location') }} <span class="text-danger">*</span>
                                    <small class="h6">
                                        ({{ __('click_to_add_a_pointer') }})
                                    </small>
                                </h4>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 rt-mb-24">
                                        <x-website.map.map-warning />
                                        @php
                                            $map = setting('default_map');
                                        @endphp
                                        <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}" id='map-box'>
                                        </div>
                                        <div id="google-map-div" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                            <input id="searchInput" class="mapClass" type="text"
                                                placeholder="Enter a location">
                                            <div class="map mymap" id="google-map"></div>
                                        </div>
                                        @error('location')
                                            <span class="ml-3 text-md text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="post-job-item rt-mb-15">
                                <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">{{ __('salary') }}</h4>
                                <div class="row">
                                    <div class="rt-mb-20 col-md-4">
                                        <x-forms.label name="min_salary" :required="true" />
                                        <div class="position-relative">
                                            <input step="0.01" value="{{ old('min_salary', '50.00') }}"
                                                class="form-control @error('min_salary') is-invalid @enderror"
                                                name="min_salary" type="number" placeholder="{{ __('min_salary') }}"
                                                id="m">
                                            <div class="usd">{{ $currency_symbol }}</div>
                                            @error('min_salary')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="rt-mb-20 col-md-4">
                                        <x-forms.label name="max_salary" :required="true" />
                                        <div class="position-relative">
                                            <input step="0.01" value="{{ old('max_salary', '100.00') }}"
                                                class="form-control @error('max_salary') is-invalid @enderror"
                                                name="max_salary" type="number" placeholder="{{ __('max_salary') }}"
                                                id="m">
                                            <div class="usd">{{ $currency_symbol }}</div>
                                            @error('max_salary')
                                                <span class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 rt-mb-20 col-md-6">
                                        <x-forms.label name="{{ __('salary_type') }}" :required="true" />
                                        <select
                                            class="rt-selectactive form-control @error('salary_type') is-invalid @enderror w-100-p"
                                            name="salary_type">
                                            @foreach ($salary_types as $type)
                                                <option {{ old('salary_type') == $type->id ? 'selected' : '' }}
                                                    value="{{ $type->id }}">
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('salary_type')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="post-job-item rt-mb-15">
                                <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">{{ __('advance_information') }}</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="education" :required="true" />
                                        <select
                                            class="select2-taggable form-control @error('education') is-invalid @enderror w-100-p"
                                            name="education">
                                            @foreach ($educations as $education)
                                                <option {{ old('education') == $education->id ? 'selected' : '' }}
                                                    value="{{ $education->id }}">
                                                    {{ $education->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('education')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="experience" :required="true" />
                                        <select
                                            class="select2-taggable form-control @error('experience') is-invalid @enderror w-100-p"
                                            name="experience">
                                            @foreach ($experiences as $experience)
                                                <option {{ old('experience') == $experience->id ? 'selected' : '' }}
                                                    value="{{ $experience->id }}">
                                                    {{ $experience->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('experience')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="job_type" :required="true" />
                                        <select
                                            class="rt-selectactive form-control @error('job_type') is-invalid @enderror w-100-p"
                                            name="job_type">
                                            @foreach ($job_types as $job_type)
                                                <option {{ old('job_type') == $job_type->id ? 'selected' : '' }}
                                                    value="{{ $job_type->id }}">
                                                    {{ $job_type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('job_type')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="vacancies" :required="true" />
                                        <input value="{{ old('vacancies') }}" name="vacancies" type="text"
                                            placeholder="{{ __('vacancies') }}"
                                            class="form-control @error('vacancies') is-invalid @enderror" id="vacancies">
                                        @error('vacancies')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="deadline_expired" :required="true" />
                                        <div class="fromGroup">
                                            <div class="form-control-icon date datepicker">
                                                <input value="{{ old('deadline') }}" name="deadline"
                                                    class="form-control @error('deadline') is-invalid @enderror"
                                                    type="text" value="{{ old('deadline') ? old('deadline') : '' }}"
                                                    id="date" placeholder="d/m/y">
                                                <span class="input-group-addon has-badge">
                                                    <span @error('deadline') rt-mr-12 @enderror>
                                                        <x-svg.calendar-icon />
                                                    </span>
                                                </span>
                                                @error('deadline')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 rt-mb-20">
                                        <x-forms.label name="job_level" :required="true" />
                                        <select name="is_remote"
                                            class="rt-selectactive form-control @error('job_type') is-invalid @enderror w-100-p">
                                            <option {{ old('is_remote') == 1 ? 'selected' : '' }} value="1">
                                                {{ __('remote') }}
                                            </option>
                                            <option {{ old('is_remote') == 0 ? 'selected' : '' }} value="0">
                                                {{ __('physical') }}
                                            </option>
                                        </select>
                                        @error('is_remote')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row applied-job-on">
                                    <h2>{{ __('apply_job_on') }}:</h2>
                                    <!-- apply_on -->
                                    <div id="applied_on_app"
                                        class="radio-check col-lg-4 d-flex {{ old('apply_on') === 'app' ? 'checked' : '' }}"
                                        onclick="RadioChecked('app')">
                                        <input type="radio" {{ old('apply_on') === 'app' ? 'checked' : '' }} checked
                                            name="apply_on" value="app" id="app-app">
                                        <label for="app-app">
                                            <h4 class="d-inline-block">{{ __('onn') }} {{ config('app.name') }}</h4>
                                            <p>{{ __('candidate_will_apply_job_using') }} {{ config('app.name') }} &
                                                {{ __('all_application_will_show_on_your_dashboard') }}.</p>
                                        </label>
                                    </div>
                                    <div id="applied_on_custom_url"
                                        class="radio-check col-lg-4 d-flex {{ old('apply_on') === 'custom_url' ? 'checked' : '' }}"
                                        onclick="RadioChecked('custom_url')">
                                        <input type="radio" {{ old('apply_on') === 'custom_url' ? 'checked' : '' }}
                                            name="apply_on" value="custom_url" id="app-custom_url">
                                        <label for="app-custom_url">
                                            <h4 class="d-inline-block">{{ __('external_platform') }}</h4>
                                            <p>{{ __('candidate_apply_job_on_your_website_all_application_on_your_own_website') }}.
                                            </p>
                                        </label>
                                    </div>
                                    <div id="applied_on_email"
                                        class="radio-check col-lg-4 d-flex {{ old('apply_on') === 'email' ? 'checked' : '' }}"
                                        onclick="RadioChecked('email')">
                                        <input type="radio" {{ old('apply_on') === 'email' ? 'checked' : '' }}
                                            name="apply_on" value="email" id="app-email">
                                        <label for="app-email">
                                            <h4 class="d-inline-block">{{ __('on_your_email') }}</h4>
                                            <p>{{ __('candidate_apply_job_on_your_email_address_and_all_application_in_your_email') }}.
                                            </p>
                                        </label>
                                    </div>
                                    <!-- apply_on end-->
                                    <div class="col-12 d-none" id="apply_on_custom_url">
                                        <x-forms.label name="website_url" :required="true" />
                                        <div class="fromGroup has-icon2">
                                            <div class="form-control-icon">
                                                <input value="{{ old('apply_url') }}" name="apply_url"
                                                    class="form-control @error('apply_url') is-invalid @enderror"
                                                    type="url" placeholder="{{ __('website') }}">
                                                <div class="icon-badge-2 @error('apply_url') mt-n-11 @enderror">
                                                    <x-svg.link-icon />
                                                </div>
                                                @error('apply_url')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="apply_on_email">
                                        <x-forms.label name="email_address" :required="true" />
                                        <div class="fromGroup has-icon2">
                                            <div class="form-control-icon">
                                                <input value="{{ old('apply_email') }}" name="apply_email"
                                                    class="form-control @error('apply_email') is-invalid @enderror"
                                                    type="email" placeholder="{{ __('email_address') }}">
                                                <div class="icon-badge-2 @error('apply_email') mt-n-11 @enderror">
                                                    <x-svg.envelope-icon />
                                                </div>
                                                @error('apply_email')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="post-job-item rt-mb-32">
                                <h4 class="f-size-18 ft-wt-5 rt-mb-20 lh-1">{{ __('description') }} &
                                    {{ __('responsibility') }}</h4>
                                <div class="col-md-12">
                                    <x-forms.label name="description" :required="true" />
                                    <textarea id="default" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="post-job-item rt-mb-15">
                                <button type="submit" class="btn btn-primary rt-mr-10">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right">
                                            <i class="ph-arrow-right"></i>
                                        </span>
                                        <span class="button-text">
                                            {{ __('post_job') }}
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .mymap {
            border-radius: 12px;
        }

        .mt-n-11 {
            margin-top: -11px;
        }
    </style>
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
@endsection

@section('frontend_scripts')
    <script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('frontend') }}/assets/js/ckeditor.min.js"></script>

    <script>
        //init datepicker
        $("#date").attr("autocomplete", "off");
        //init datepicker
        $('.datepicker').off('focus').datepicker({
            format: 'dd-mm-yyyy'
        }).on('click',
            function() {
                $(this).datepicker('show');
            }
        );
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#default'))
            .catch(error => {
                console.error(error);
            });
    </script>
    @include('map::set-googlemap')
    @include('map::set-mapbox')

    <script>
        function RadioChecked(param) {
            var value = param;
            if (value === 'email') {
                $('#applied_on_email').addClass('checked');
                $('#apply_on_custom_url').addClass('d-none');
                $('#apply_on_email').removeClass('d-none');
                $('#applied_on_app').removeClass('checked');
                $('#applied_on_custom_url').removeClass('checked');
            }
            if (value === 'custom_url') {
                $('#applied_on_custom_url').addClass('checked');
                $('#apply_on_email').addClass('d-none');
                $('#apply_on_custom_url').removeClass('d-none');
                $('#applied_on_app').removeClass('checked');
                $('#applied_on_email').removeClass('checked');
            }
            if (value === 'app') {
                $('#applied_on_app').addClass('checked');
                $('#applied_on_email').removeClass('checked');
                $('#applied_on_custom_url').removeClass('checked');
                $('#apply_on_email').addClass('d-none');
                $('#apply_on_custom_url').addClass('d-none');
            }
        }
        $('.radio-check').on('click', function() {
            $('input:radio', this).prop('checked', true);
        });

        if ($('#app-app').is(':checked')) {
            $('#applied_on_app').addClass('checked');
        }
        if ($('#app-custom_url').is(':checked')) {
            $('#apply_on_custom_url').removeClass('d-none');
        }
        if ($('#app-email').is(':checked')) {
            $('#apply_on_email').removeClass('d-none');
        }

        var apply_url = "{!! $errors->first('apply_url') !!}";
        var apply_url1 = "{!! old('apply_email') !!}";
        var apply_email = "{!! $errors->first('apply_email') !!}";
        var apply_email1 = "{!! old('apply_email') !!}";

        if (apply_url) {
            $('#apply_on_custom_url').removeClass('d-none');
        }
        if (apply_url1) {
            $('#apply_on_custom_url').removeClass('d-none');
        }
        if (apply_email) {
            $('#apply_on_email').removeClass('d-none');
        }
        if (apply_email1) {
            $('#apply_on_email').removeClass('d-none');
        }
    </script>
@endsection
