@extends('admin.settings.setting-layout')

@section('title')
    {{ __('theme_setting') }}
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
                <li class="breadcrumb-item active">{{ __('theme_setting') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('frontend_color_setting') }}</h3>
        </div>
        <div class="row pt-3 pb-4">

            <form id="color_picker_form" action="{{ route('settings.themesetting.update') }}" method="post">
                @csrf
                @method('PUT')

                <input id="button_color_id" type="hidden" name="button_color"
                    value="{{ $setting->frontend_button_color ? $setting->frontend_button_color : '#0000ff' }}">

                <input id="button_hovor_color_id" type="hidden" name="button_hovor_color"
                    value="{{ $setting->frontend_link_color_hover ? $setting->frontend_link_color_hover : '#343a40' }}">
                <input id="button_link_id" type="hidden" name="button_link"
                    value="{{ $setting->frontend_button_link ? $setting->frontend_button_link : '#ffffff' }}">

                <input id="button_outline_id" type="hidden" name="button_outline"
                    value="{{ $setting->frontend_btn_outline ? $setting->frontend_btn_outline : '#e6f0ff' }}">

                <input id="button_text_color_id" type="hidden" name="button_text_color"
                    value="{{ $setting->frontend_button_color_text ? $setting->frontend_button_color_text : '#ffffff' }}">
                <input id="button_text_hover_color_id" type="hidden" name="button_text_hover_color"
                    value="{{ $setting->frontend_button_color_hover ? $setting->frontend_button_color_hover : '#ffffff' }}">

                <input id="text_color_id" type="hidden" name="text_color"
                    value="{{ $setting->frontend_color_text ? $setting->frontend_color_text : '#1B1A1A' }}">
                <input id="bg_color_id" type="hidden" name="bg_color"
                    value="{{ $setting->frontend_bg_color ? $setting->frontend_bg_color : '#ffffff' }}">

                <input id="icon_color_id" type="hidden" name="icon_color"
                    value="{{ $setting->frontend_icon_color ? $setting->frontend_icon_color : '#ffffff' }}">

                <input id="icon_color_hover_id" type="hidden" name="icon_color_hover"
                    value="{{ $setting->frontend_icon_color_hover ? $setting->frontend_icon_color_hover : '#343a40' }}">
                <input id="frontend_link_color_id" type="hidden" name="frontend_link_color"
                    value="{{ $setting->frontend_link_color ? $setting->frontend_link_color : '#000000' }}">
            </form>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('bg_color') }}</div>
                    <div class="card-body">
                        <div class="bg_color_picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('text_color') }}</div>
                    <div class="card-body">
                        <div class="text_color_picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_color') }}</div>
                    <div class="card-body">
                        <div class="button_color_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_link') }}</div>
                    <div class="card-body">
                        <div class="button_link_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_outline') }}</div>
                    <div class="card-body">
                        <div class="button_outline_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_hover_color') }}</div>
                    <div class="card-body">
                        <div class="button_color_hover_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_text_color') }}</div>
                    <div class="card-body">
                        <div class="button_text_color_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('button_text_hover_color') }}</div>
                    <div class="card-body">
                        <div class="button_text_hover_color_picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('frontend_icon_color') }}</div>
                    <div class="card-body">
                        <div class="frontend_icon_color_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">{{ __('frontend_icon_color_hover') }}</div>
                    <div class="card-body">
                        <div class="frontend_icon_color_hover_picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('frontend_link_color') }}</div>
                    <div class="card-body">
                        <div class="frontend_link_color_picker"></div>
                    </div>
                </div>
            </div>

        </div>
        @if (userCan('setting.update'))
            <div class="card-footer text-center">
                <button onclick="$('#color_picker_form').submit()" type="submit"
                    class="btn btn-primary w-250">{{ __('update') }}</button>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('backend_color_setting') }}</h3>
        </div>
        <div class="row pt-3 pb-4">

            <form id="backend_picker_form" action="{{ route('settings.backendthemesetting.update') }}" method="post">
                @csrf
                @method('PUT')


                <input id="sidebar_color_id" type="hidden" name="sidebar_color"
                    value="{{ $setting->sidebar_color ? $setting->sidebar_color : '#343a40' }}">

                <input id="navbar_color_id" type="hidden" name="navbar_color"
                    value="{{ $setting->nav_color ? $setting->nav_color : '#343a40' }}">

                <input id="backend_text_color_id" type="hidden" name="backendtextcolor"
                    value="{{ $setting->backend_color_text ? $setting->backend_color_text : '#343a40' }}">

            </form>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('sidebar_color') }}</div>
                    <div class="card-body">
                        <div class="sidebar_color_picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('navbar_color') }}</div>
                    <div class="card-body">
                        <div class="navbar_color_picker"></div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="card">
                    <div class="card-header">{{ __('text_color') }}</div>
                    <div class="card-body">
                        <div class="backend_text_color_picker"></div>
                    </div>
                </div>
            </div>

        </div>
        @if (userCan('setting.update'))
            <div class="card-footer text-center">
                <button onclick="$('#backend_picker_form').submit()" type="submit"
                    class="btn btn-primary w-250">{{ __('update') }}</button>
            </div>
        @endif
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/pickr') }}/classic.min.css" />
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/pickr') }}/pickr.min.js"></script>
    @include('admin/settings/pages/theam_color')
    @include('admin/settings/pages/backendtheam_color')
@endsection
