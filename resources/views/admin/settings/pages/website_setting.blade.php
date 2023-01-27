@extends('admin.settings.setting-layout')

@section('title')
    {{ __('cms') }} {{ __('settings') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('cms') }} {{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('cms') }} {{ __('settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    @php
        $tab_part = session('tab_part');
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'home' ? 'active' : '' }}" data-toggle="tab"
                                href="#home">{{ __('home') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'about' ? 'active' : '' }}" data-toggle="tab"
                                href="#about">{{ __('about') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'contact' ? 'active' : '' }}" data-toggle="tab"
                                href="#contact">{{ __('contact') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'auth' ? 'active' : '' }}" data-toggle="tab"
                                href="#authpage">{{ __('log_in') }} & {{ __('registration') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'error' ? 'active' : '' }}" data-toggle="tab"
                                href="#errorpage">{{ __('error_pages') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'terms' ? 'active' : '' }}" data-toggle="tab"
                                href="#termsandcondition">{{ __('terms_condition') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'privacy' ? 'active' : '' }}" data-toggle="tab"
                                href="#privary_policy">{{ __('privacy_policy') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'coming_soon' ? 'active' : '' }}" data-toggle="tab"
                                href="#comingsoon">{{ __('comingsoon') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'maintenance' ? 'active' : '' }}" data-toggle="tab"
                                href="#maintenance_mode">{{ __('maintenance_mode') }}</a>
                        </li>
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link {{ $tab_part == 'others' ? 'active' : '' }}" data-toggle="tab"
                                href="#others">{{ __('others') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                    <div class="tab-content no-padding">
                        {{-- home --}}
                        <div class="tab-pane {{ $tab_part == 'home' ? 'show active' : '' }}" id="home">
                            <form class="form-horizontal" action="{{ route('settings.home.update', $cms_setting->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>{{ __('banner_image') }}
                                                </label>
                                                <input name="home_page_banner_image"
                                                    data-allowed-file-extensions="jpg png svg jpge" data-min-height="240"
                                                    data-min-width="350" type="file" class="form-control dropify"
                                                    data-default-file="{{ asset($cms_setting->home_page_banner_image) }}">
                                                <x-forms.error name="home_page_banner_image" />

                                            </div>
                                        </div>
                                        @if (userCan('setting.update'))
                                            <div class="row mt-3 mx-auto justify-content-center">
                                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                                    {{ __('update') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- about --}}
                        <div class="tab-pane {{ $tab_part == 'about' ? 'show active' : '' }}" id="about">
                            <form class="form-horizontal" action="{{ route('settings.aboutupdate') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-header">{{ __('about_brand_logo') }}</div>
                                    <div class="card-body">
                                        <div class="row row-cols-md-3">
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo1" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo1) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo2" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo2) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo3" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo3) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo4" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo4) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_brand_logo5" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_brand_logo5) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">{{ __('about_banner_image') }}</div>
                                    <div class="card-body">
                                        <div class="row row-cols-md-3">
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_banner_img" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_banner_img) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_banner_img1" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_banner_img1) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_banner_img2" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_banner_img2) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="card-body">
                                                    <input name="about_banner_img3" data-min-height="240"
                                                        data-min-width="350" type="file" class="form-control dropify"
                                                        data-default-file="{{ asset($cms_setting->about_banner_img3) }}"
                                                        data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">{{ __('our_mission') }}</div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 col-form-label">{{ __('mission_image') }}</label>
                                            <div class="col-sm-12">
                                                <input name="mission_image" type="file"
                                                    class="form-control dropify @error('mission_image') is-invalid @enderror"
                                                    data-default-file="{{ asset($cms_setting->mission_image) }}"
                                                    data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                                                <x-forms.error name="mission_image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (userCan('setting.update'))
                                    <div class="row mt-3 mx-auto justify-content-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>

                        {{-- contact --}}
                        <div class="tab-pane {{ $tab_part == 'contact' ? 'show active' : '' }}" id="contact">
                            <form class="form-horizontal"
                                action="{{ route('settings.contact.update', $cms_setting->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-header">{{ __('contact') }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group w-100-p">
                                                    <label>{{ __('location') }}:</label>
                                                    {!! $cms_setting->contact_map !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>{{ __('map_address') }}
                                                        <x-forms.required />
                                                    </label>
                                                    <textarea class="form-control p-2 {{ error('contact_map') }}" rows="5" name="contact_map">{{ old('contact_map', $cms_setting->contact_map) }}</textarea>
                                                    <x-forms.error name="contact_map" />
                                                </div>
                                            </div>
                                        </div>
                                        @if (userCan('setting.update'))
                                            <div class="row mt-3 mx-auto justify-content-center">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-sync"></i>
                                                    {{ __('update') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{-- login and registation content --}}
                        <div class="tab-pane {{ $tab_part == 'auth' ? 'show active' : '' }}" id="authpage">
                            <form class="form-horizontal" action="{{ route('settings.auth.update', $cms_setting->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-header">{{ __('login_register_page') }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>{{ __('login_image') }}</label>
                                                <input name="login_page_image" type="file"
                                                    class="form-control dropify"
                                                    data-default-file="{{ asset($cms_setting->login_page_image) }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label>{{ __('register_image') }}</label>
                                                <input name="register_page_image" type="file"
                                                    class="form-control dropify"
                                                    data-default-file="{{ asset($cms_setting->register_page_image) }}">
                                            </div>
                                            @if (userCan('setting.update'))
                                                <div class="row mt-3 mx-auto justify-content-center">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-sync"></i>
                                                        {{ __('update') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        {{-- Error page --}}
                        <div class="tab-pane {{ $tab_part == 'error' ? 'show active' : '' }}" id="errorpage">
                            <div class="row">
                                {{-- 403 --}}
                                <div class="col-sm-12 col-md-6">
                                    <form class="form-horizontal"
                                        action="{{ route('settings.errorpage.update', $cms_setting->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="type" value="403">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">403 {{ __('page') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>{{ __('error_image') }}:</label>
                                                        <input name="page403_image" type="file"
                                                            class="form-control dropify"
                                                            data-default-file="{{ asset($cms_setting->page403_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (userCan('setting.update'))
                                                <div class="row my-3 mx-auto justify-content-center">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-sync"></i>
                                                        {{ __('update') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                {{-- 404 --}}
                                <div class="col-sm-12 col-md-6">
                                    <form class="form-horizontal"
                                        action="{{ route('settings.errorpage.update', $cms_setting->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="type" value="404">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">404 {{ __('page') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>{{ __('error_image') }}:</label>
                                                        <input name="page404_image" type="file"
                                                            class="form-control dropify"
                                                            data-default-file="{{ asset($cms_setting->page404_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (userCan('setting.update'))
                                                <div class="row my-3 mx-auto justify-content-center">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-sync"></i>
                                                        {{ __('update') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                {{-- 500 --}}
                                <div class="col-sm-12 col-md-6">
                                    <form class="form-horizontal"
                                        action="{{ route('settings.errorpage.update', $cms_setting->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="type" value="500">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">500 {{ __('page') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>{{ __('error_image') }}:</label>
                                                        <input name="page500_image" type="file"
                                                            class="form-control dropify"
                                                            data-default-file="{{ asset($cms_setting->page500_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (userCan('setting.update'))
                                                <div class="row my-3 mx-auto justify-content-center">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-sync"></i>
                                                        {{ __('update') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                {{-- 503 --}}
                                <div class="col-sm-12 col-md-6">
                                    <form class="form-horizontal"
                                        action="{{ route('settings.errorpage.update', $cms_setting->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" name="type" value="503">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">503 {{ __('page') }}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>{{ __('error_image') }}:</label>
                                                        <input name="page503_image" type="file"
                                                            class="form-control dropify"
                                                            data-default-file="{{ asset($cms_setting->page503_image) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            @if (userCan('setting.update'))
                                                <div class="row my-3 mx-auto justify-content-center">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-sync"></i>
                                                        {{ __('update') }}
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- terms and condition --}}
                        <div class="tab-pane {{ $tab_part == 'terms' ? 'show active' : '' }}" id="termsandcondition">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ __('terms_conditons_page_content') }}</h2>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <form id="terms-form" action="{{ route('admin.privacy.terms.update') }}"
                                                method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="type" value="terms">
                                                <div class="form-group">
                                                    <div
                                                        class="row d-flex justify-content-between items-align-center mb-2">
                                                        <div class="col-4">
                                                            <label for="translation_code" class="pt-3">
                                                                {{ __('select_language') }}
                                                            </label>
                                                            @php
                                                                $current_language = currentLanguage() ? currentLanguage() : $defaultLanguage;
                                                            @endphp

                                                            <select id="translation_code" name="translation_code"
                                                                class="select2bs4 w-100 @error('translation_code') is-invalid @enderror">
                                                                @foreach ($languages as $key => $language)
                                                                    <option
                                                                        {{ session()->get('terms_condition_page') == $language->code ? 'selected' : '' }}
                                                                        value="{{ $language->code }}">
                                                                        {{ $language->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('translation_code')
                                                                <span class="invalid-feedback"
                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <textarea id="editor2" class="form-control {{ $errors->has('terms_page') ? 'is-invalid' : '' }}" rows="5"
                                                        name="terms_page">{{ old('terms_page', $terms_page == null ? $cms_setting->terms_page : $terms_page) }}</textarea>
                                                    @error('terms_page')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                @if (userCan('setting.update'))
                                                    <div class="row mt-3 mx-auto justify-content-center">
                                                        <button type="submit" class="btn btn-success"><i
                                                                class="fas fa-sync"></i>
                                                            {{ __('update') }}
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <div class="card-body border table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('translation_available_in') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($terms_condition_page_list as $list)
                                                            <tr>
                                                                <td>{{ $list->language ? $list->language->name : '' }}
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('settings.session.update.tems-privacy') }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <input type="hidden" name="exist_check"
                                                                            value="{{ $list->translation_code }}">
                                                                        <input type="hidden" name="session"
                                                                            value="terms">
                                                                        <input type="hidden" name="type"
                                                                            value="terms-page">
                                                                        <button class="btn bg-info">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                    </form>
                                                                    @if ($list->language->code !== 'en')
                                                                        <form
                                                                            action="{{ route('settings.cms.content.destroy') }}"
                                                                            method="POST" class="d-inline">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <input type="hidden" name="content_id"
                                                                                value="{{ $list->id }}">
                                                                            <button
                                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                                class="btn bg-danger"><i
                                                                                    class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="2" class="text-center">
                                                                    {{ __('no_data_found') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- privcy page --}}
                        <div class="tab-pane {{ $tab_part == 'privacy' ? 'show active' : '' }}" id="privary_policy">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">{{ __('terms_conditons_page_content') }}</h2>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <form action="{{ route('admin.privacy.terms.update') }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <input type="hidden" name="type" value="privary">
                                                <div class="form-group">
                                                    <div
                                                        class="row d-flex justify-content-between items-align-center mb-2">
                                                        <div class="col-4">
                                                            <label for="privary_policy_page_content" class="pt-3">
                                                                {{ __('select_language') }}
                                                            </label>
                                                            @php
                                                                $current_language = currentLanguage() ? currentLanguage() : $defaultLanguage;
                                                            @endphp
                                                            <select id="privary_policy_page_content"
                                                                name="translation_code"
                                                                class="select2bs4 w-100 @error('translation_code') is-invalid @enderror">
                                                                @foreach ($languages as $key => $language)
                                                                    <option
                                                                        {{ session()->get('privacy_page') == $language->code ? 'selected' : '' }}
                                                                        value="{{ $language->code }}">
                                                                        {{ $language->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('translation_code')
                                                                <span class="invalid-feedback"
                                                                    role="alert"><strong>{{ $message }}</strong></span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <textarea id="editor3" class="form-control {{ $errors->has('privary_page') ? 'is-invalid' : '' }}" rows="5"
                                                        name="privary_page">{{ old('privary_page', $privacy_page == null ? $cms_setting->privary_page : $privacy_page) }}</textarea>
                                                    @error('privary_page')
                                                        <span class="invalid-feedback"
                                                            role="alert"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </div>
                                                @if (userCan('setting.update'))
                                                    <div class="row mt-3 mx-auto justify-content-center">
                                                        <button type="submit" class="btn btn-success"><i
                                                                class="fas fa-sync"></i>
                                                            {{ __('update') }}
                                                        </button>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <div class="card-body border table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ __('translation_available_in') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($privacy_page_list as $listt)
                                                            <tr>
                                                                <td>{{ $listt->language ? $listt->language->name : '' }}
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('settings.session.update.tems-privacy') }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <input type="hidden" name="exist_check"
                                                                            value="{{ $listt->translation_code }}">
                                                                        <input type="hidden" name="session"
                                                                            value="privacy">
                                                                        <input type="hidden" name="type"
                                                                            value="privacy-page">
                                                                        <button class="btn bg-info">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                    </form>
                                                                    @if ($listt->language->code !== 'en')
                                                                        <form
                                                                            action="{{ route('settings.cms.content.destroy') }}"
                                                                            method="POST" class="d-inline">
                                                                            @method('DELETE')
                                                                            @csrf
                                                                            <input type="hidden" name="content_id"
                                                                                value="{{ $listt->id }}">
                                                                            <button
                                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                                class="btn bg-danger"><i
                                                                                    class="fas fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="2" class="text-center">
                                                                    {{ __('no_data_found') }}
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- coming soon --}}
                        <div class="tab-pane {{ $tab_part == 'coming_soon' ? 'show active' : '' }}" id="comingsoon">
                            <form class="form-horizontal"
                                action="{{ route('settings.comingsoon.update', $cms_setting->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="card">
                                    <div class="card-header">{{ __('comingsoon_page') }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>{{ __('comingsoon_image') }}:</label>
                                                <input name="comingsoon_image" type="file"
                                                    class="form-control dropify"
                                                    data-default-file="{{ asset($cms_setting->comingsoon_image) }}">
                                            </div>
                                        </div>
                                        @if (userCan('setting.update'))
                                            <div class="row mt-3 mx-auto justify-content-center">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-sync"></i>
                                                    {{ __('update') }}
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                        {{-- maintenance_mode --}}
                        <div class="tab-pane {{ $tab_part == 'maintenance' ? 'show active' : '' }}"
                            id="maintenance_mode">
                            <div class="card">
                                <div class="card-body">
                                    <form class="form-horizontal"
                                        action="{{ route('settings.maintenance.mode.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form">
                                            <label>{{ __('maintenance_image') }}<small
                                                    class="text-danger">*</small></label>
                                            <input name="maintenance_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms_setting->maintenance_image) }}">
                                        </div>
                                        <div class="row mt-3 mx-auto d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                                {{ __('update') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- others --}}
                        <div class="tab-pane {{ $tab_part == 'others' ? 'show active' : '' }}" id="others">
                            <form class="form-horizontal" action="{{ route('settings.others.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" class="form-control" name="othersid"
                                    placeholder="Enter Phone No...!!" value="{{ $cms_setting->id }}">
                                <div class="card">
                                    <div class="card-header">{{ __('candidate') }}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>{{ __('candidate_image') }}<small
                                                        class="text-danger">*</small></label>
                                                <input name="candidate_image" type="file" class="form-control dropify"
                                                    data-default-file="{{ asset($cms_setting->candidate_image) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">{{ __('employers') }}</div>
                                    <div class="card-body">
                                        <div class="col-sm-4">
                                            <label class="form-label">{{ __('employers_image') }}<small
                                                    class="text-danger">*</small></label>
                                            <input name="employers_image" type="file" class="form-control dropify"
                                                data-default-file="{{ asset($cms_setting->employers_image) }}">
                                        </div>
                                    </div>
                                </div>
                                @if (userCan('setting.update'))
                                    <div class="row mt-3 mx-auto justify-content-center">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
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
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        ClassicEditor.create(document.querySelector('#editor2'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#editor3'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '500px';
            })
            .catch(error => {
                console.error(error);
            });
        var tab = localStorage.getItem("setting-tab");
        if (tab) {
            $('#' + tab).addClass('active');
        }
        $('#termsandcondition').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('settings.session.update.tems-privacy') }}',
                data: {
                    'session': 'terms',
                },
                success: function(data) {
                    // location.reload();
                }
            });
        })
        $('#privary_policy').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route('settings.session.update.tems-privacy') }}',
                data: {
                    'session': 'privacy',
                },
                success: function(data) {
                    // location.reload();
                }
            });
        })
        $('select[id^="translation_code"]').on('change', function() {
            var code = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('settings.session.update.tems-privacy') }}',
                data: {
                    'exist_check': code,
                    'type': 'terms-page',
                },
                success: function(data) {
                    location.reload();
                }
            });
        })
        $('select[id^="privary_policy_page_content"]').on('change', function() {
            var code = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('settings.session.update.tems-privacy') }}',
                data: {
                    'exist_check': code,
                    'type': 'privacy-page',
                },
                success: function(data) {
                    location.reload();
                }
            });
        })
    </script>
@endsection
