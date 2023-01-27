@extends('admin.settings.setting-layout')

@section('title')
    {{ __('website_settings') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('website_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('basic_setting') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('settings.general.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="site_name"> {{ __('app_name') }} </label>
                                    <input value="{{ config('app.name') }}" name="name" type="text"
                                        class="form-control " placeholder="{{ __('app_name') }}" id="site_name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="site_email"> {{ __('email') }} </label>
                                    <input value="{{ $setting->email }}" name="email" type="text"
                                        class="form-control " placeholder="{{ __('email') }}" id="site_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <x-forms.label name="dark_logo">
                                    <x-info-tip message="Recommended: 150x50"/>
                                </x-forms.label>
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->dark_logo_url }}" name="dark_logo"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                                    @error('dark_logo')
                                        <span class="invalid-feedback d-block" role="alert">{{ __($message) }}</span>
                                    @enderror
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <x-forms.label name="light_logo">
                                    <x-info-tip message="Recommended: 150x50"/>
                                </x-forms.label>
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->light_logo_url }}" name="light_logo"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                                    @error('light_logo_url')
                                        <span class="invalid-feedback d-block" role="alert">{{ __($message) }}</span>
                                    @enderror
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <x-forms.label name="favicon">
                                    <x-info-tip message="Recommended: 32x32"/>
                                </x-forms.label>
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->favicon_image_url }}" name="favicon_image"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]' accept="image/png, image/jpg,image/svg image/jpeg"
                                    data-max-file-size="1M">
                                    @error('favicon_image')
                                        <span class="invalid-feedback d-block" role="alert">{{ __($message) }}</span>
                                    @enderror
                            </div>
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>
                                        {{ __('update') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Google recaptcha Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title line-height-36">
                            {{ __('recaptcha_configuration') }}
                            (<small><a href="https://support.google.com/recaptcha"
                                target="_blank">{{ __('get_help') }}</a></small>)
                        </h3>
                    </div>
                </div>
                <form class="form-horizontal" action="{{ route('settings.recaptcha.update') }}" method="POST"
                    id="recaptch_form">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <x-forms.label name="nocaptcha_secret" class="col-sm-5" />
                            <div class="col-sm-7">
                                <input value="{{ old('nocaptcha_key', config('captcha.sitekey')) }}"
                                    name="nocaptcha_key" type="text"
                                    class="form-control @error('nocaptcha_key') is-invalid @enderror"
                                    autocomplete="off">
                                @error('nocaptcha_key')
                                    <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-forms.label name="nocaptcha_sitekey" class="col-sm-5" />
                            <div class="col-sm-7">
                                <input value="{{ old('nocaptcha_secret', config('captcha.secret')) }}"
                                    name="nocaptcha_secret" type="text"
                                    class="form-control @error('nocaptcha_secret') is-invalid @enderror"
                                    autocomplete="off">
                                @error('nocaptcha_secret')
                                    <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-forms.label name="status" class="col-sm-5" />
                            <div class="col-sm-7">
                                <input {{ config('captcha.active') ? 'checked' : '' }} type="checkbox"
                                name="status" data-bootstrap-switch value="1" data-on-text="{{ __('on') }}"
                                data-off-color="default" data-on-color="success" data-off-text="{{ __('off') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-7 offset-sm-5">
                                <div class="input-group text-center">
                                    {!! NoCaptcha::display() !!}
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger text-sm">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (userCan('setting.update'))
                            <div class="form-group row">
                                <div class="offset-sm-5 col-sm-7">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app_configuration') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.system.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                               <div class="form-group">
                                    <x-forms.label name="time_zone" />
                                    <select name="timezone"
                                        class="@error('timezone') is-invalid @enderror timezone-select form-control">
                                        @foreach ($timezones as $timezone)
                                            <option {{ config('app.timezone') == $timezone->value ? 'selected' : '' }}
                                                value="{{ $timezone->value }}">
                                                {{ $timezone->value }}
                                            </option>
                                        @endforeach
                                        @error('timezone')
                                            <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </select>
                               </div>
                               <div class="form-group">
                                    <x-forms.label name="set_default_language" />
                                    <select class="form-control @error('code') is-invalid @enderror" name="code"
                                        id="default_language">
                                        @foreach ($languages as $language)
                                            <option
                                                {{ $language->code == config('zakirsoft.default_language') ? 'selected' : '' }}
                                                value="{{ $language->code }}">
                                                {{ $language->name }}({{ $language->code }})
                                            </option>
                                        @endforeach
                                        @error('code')
                                            <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </select>
                               </div>
                                <div class="form-group">
                                    <x-forms.label name="set_default_currency" for="inlineFormCustomSelect" />
                                    <select name="currency" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option value="" disabled selected>{{ __('Currency') }}
                                        </option>
                                        @foreach ($currencies as $key => $currency)
                                            <option {{ config('zakirsoft.currency') == $currency->code ? 'selected' : '' }}
                                                value="{{ $currency->id }}">
                                                {{ $currency->name }} ( {{ $currency->code }} )
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 mt-2">
                                <div class="form-group">
                                    <x-forms.label name="app_debug" />
                                    <div>
                                        <input type="hidden" name="app_debug" value="0" />
                                        <input type="checkbox" id="app_debug" {{ config('app.debug') ? 'checked' : '' }}
                                            name="app_debug" data-bootstrap-switch data-on-color="success"
                                            data-on-text="{{ __('on') }}" data-off-color="default"
                                            data-off-text="{{ __('off') }}" data-size="small" value="1">
                                        <x-forms.error name="app_debug" />
                                    </div>
                                </div>
                               <div class="form-group">
                                    <x-forms.label name="website_language_switcher" :required="true" />
                                    <div>
                                        <input type="hidden" name="language_changing" value="0" />
                                        <input type="checkbox" id="language_changing"
                                            {{ $setting->language_changing ? 'checked' : '' }} name="language_changing"
                                            data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                            data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                            value="1">
                                        <x-forms.error name="language_changing" />
                                    </div>
                               </div>
                               <div class="form-group">
                                    <x-forms.label name="employer_account_auto_activation" :required="true" />
                                    <div>
                                        <input type="hidden" name="employer_auto_activation" value="0" />
                                        <input type="checkbox" id="employer_auto_activation"
                                            {{ $setting->employer_auto_activation ? 'checked' : '' }} name="employer_auto_activation"
                                            data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                            data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                            value="1">
                                        <x-forms.error name="employer_auto_activation" />
                                    </div>
                               </div>
                               <div class="form-group">
                                    <x-forms.label name="email_verification" :required="true" />
                                    <div>
                                        <input type="hidden" name="email_verification" value="0" />
                                        <input type="checkbox" id="email_verification"
                                            {{ $setting->email_verification ? 'checked' : '' }} name="email_verification"
                                            data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                            data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                            value="1">
                                        <x-forms.error name="email_verification" />
                                    </div>
                               </div>
                            </div>
                        </div>
                        <div class="w-full mt-4 mb-2 ml-2 d-flex justify-content-center items-center">
                            <button type="submit" class="btn btn-success" id="setting_button">
                                <span><i class="fas fa-sync"></i> {{ __('update') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <form id="" class="form-horizontal" action="{{ route('module.map.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{ __('location_configuration') }}
                        </h3>
                    </div>
                    <!-- ============== for text =============== -->
                    <div id="text-card" class="card-body">
                        <div class="form-group row">
                            <x-forms.label name="map_type" class="col-sm-4" />
                            <div class="col-sm-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input onclick="changeMapType()" type="radio" id="mapp-box" name="map_type" class="custom-control-input" value="map-box" {{ setting('default_map') == 'map-box' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="mapp-box">{{ __('map-box') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                    <input onclick="changeMapType()" type="radio" id="google-mapp" name="map_type" class="custom-control-input" value="google-map" {{ setting('default_map') == 'google-map' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="google-mapp">
                                        {{ __('google-map') }}
                                    </label>
                                    </div>
                                @error('map_type')
                                    <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>

                        <div id="mapbox_key" class="{{ setting('default_map') == 'map-box' ? '' : 'd-none' }} form-group row">
                            <x-forms.label name="your_map_box_key"  class="col-sm-4" />
                            <div class="col-sm-8">
                                <input value="{{ $setting->map_box_key }}" name="map_box_key" type="text"
                                    class="form-control @error('map_box_key') is-invalid @enderror" autocomplete="off"
                                    placeholder="{{ __('your_map_box_key') }}">
                                @error('map_box_key')
                                    <span class="text-left invalid-feedback"
                                        role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div id="googlemap_key" class="{{ setting('default_map') == 'google-map' ? '' : 'd-none' }} form-group row">
                            <x-forms.label name="your_google_map_key" class="col-sm-4" />
                            <div class="col-sm-8">
                                <input value="{{ $setting->google_map_key }}" name="google_map_key" type="text"
                                    class="form-control @error('google_map_key') is-invalid @enderror" autocomplete="off"
                                    placeholder="{{ __('your_google_map_key') }}">
                                @error('google_map_key')
                                    <span class="text-left invalid-feedback"
                                        role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-forms.label name="app_country_type" :required="true" class="col-sm-4"/>
                            <div class="col-sm-8">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input onclick="changeCountryType()" type="radio" id="single-country-base" name="app_country_type" class="custom-control-input" value="single_base" {{ setting('app_country_type') == 'single_base' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="single-country-base">{{ __('single_base') }}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                    <input onclick="changeCountryType()" type="radio" id="multiple-country-base" name="app_country_type" class="custom-control-input" value="multiple_base" {{ setting('app_country_type') == 'multiple_base' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="multiple-country-base">
                                        {{ __('multiple_base') }}
                                    </label>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-forms.label name="select_country" :required="true" class="col-sm-4"/>

                            <div class="{{ setting('app_country_type') == 'single_base' ? '' : 'd-none' }} col-sm-8"
                                id="app_countries">
                                <select name="app_country" class="custom-select mr-sm-2" id="">
                                    @foreach ($countries as $country)
                                        <option {{ setting('app_country') == $country->id ? 'selected' : '' }}
                                            value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-8 {{ setting('app_country_type') == 'multiple_base' ? '' : 'd-none' }}"
                            id="app_countries_multiple">
                                @php
                                    $active_countries = $countries
                                        ->where('status', 1)
                                        ->pluck('id')
                                        ->toArray();
                                @endphp
                                <select name="multiple_country[]" class="custom-select mr-sm-2 select2bs4" id=""
                                    multiple>
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($countries as $country)
                                        <option {{ in_array($country->id, $active_countries) ? 'selected' : '' }}
                                            value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row pb-3 mt-5">
                            <div class="offset-sm-4 col-sm-8">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                    {{ __('update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend/plugins/dropify/css/dropify.min.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('.dropify').dropify();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));

        });
    </script>
    <script>
        function changeCountryType(value){
            var value = $("[name='app_country_type']:checked").val();

            if (value == 'single_base') {
                $('#app_countries').removeClass('d-none');
                $('#app_countries_multiple').addClass('d-none');
            } else {
                $('#app_countries').addClass('d-none');
                $('#app_countries_multiple').removeClass('d-none');
            }
        }
        function changeMapType(value){
            var value = $("[name='map_type']:checked").val();

            if (value == 'google-map') {
                $('#googlemap_key').removeClass('d-none');
                $('#mapbox_key').addClass('d-none');
            } else {
                $('#mapbox_key').removeClass('d-none');
                $('#googlemap_key').addClass('d-none');
            }
        }

        $('.select2bs4').select2({
            theme: 'bootstrap4',
            multiple: true,
            placeholder: 'Select Your Country'
        })
    </script>

    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@endsection
