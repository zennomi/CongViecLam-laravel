@extends('admin.settings.setting-layout')
@section('title')
    {{ __('color_settings') }}
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
                <li class="breadcrumb-item active">{{ __('color_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('color_settings') }}</h3>
        </div>
        <div class="row pt-3 pb-4 justify-content-center">
            <form id="color_picker_form" action="{{ route('settings.color.update') }}" method="post">
                @csrf
                @method('PUT')
                <input id="sidebar_color_id" type="hidden" name="sidebar_color"
                    value="{{ $setting->sidebar_color ? $setting->sidebar_color : '#343a40' }}">
                <input id="nav_color_id" type="hidden" name="nav_color"
                    value="{{ $setting->nav_color ? $setting->nav_color : '#f8f9fa' }}">
            </form>

            <div class="col-2">
                <div class="card">
                    <div class="card-header">{{ __('slider_color') }}</div>
                    <div class="card-body">
                        <div class="sidebar-color-picker"></div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <div class="card-header">{{ __('nav_color') }}</div>
                    <div class="card-body">
                        <div class="navbar-color-picker"></div>
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
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/pickr') }}/classic.min.css" />
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/pickr') }}/pickr.min.js"></script>
    <script>
        var sidebarColor = '{{ $setting->sidebar_color ? $setting->sidebar_color : '#343a40' }}';
        var navbarColor = '{{ $setting->nav_color ? $setting->nav_color : '#f8f9fa' }}';

        // Sidebar Color Change
        const sidebarPickr = Pickr.create({
            el: ".sidebar-color-picker",
            theme: "classic",
            default: sidebarColor,

            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    hex: true,
                    rgba: true,
                    cmyk: true,
                    input: true,
                    save: true,
                    clear: true,
                }
            }
        });
        sidebarPickr.on('change', (color, source, instance) => {
            $("#sidebar").css("backgroundColor", color.toRGBA().toString(0));
            $("#sidebar_color_id").val(color.toRGBA().toString(0));
        }).on('save', (color, instance) => {
            $("#sidebar").css("backgroundColor", color.toRGBA().toString(0));
            $("#sidebar_color_id").val(color.toRGBA().toString(0));
            sidebarPickr.hide();
        }).on('clear', instance => {
            sidebarPickr.hide();
        });

        // Navbar Color Change
        const NavbarPickr = Pickr.create({
            el: ".navbar-color-picker",
            theme: "classic",
            default: navbarColor,

            components: {
                preview: true,
                opacity: true,
                hue: true,

                interaction: {
                    hex: true,
                    rgba: true,
                    cmyk: true,
                    input: true,
                    save: true,
                    clear: true,
                }
            }
        });

        NavbarPickr.on('change', (color, source, instance) => {
            $("#nav").css("backgroundColor", color.toRGBA().toString(0));
            $("#nav_color_id").val(color.toRGBA().toString(0));
        }).on('save', (color, instance) => {
            $("#nav").css("backgroundColor", color.toRGBA().toString(0));
            $("#nav_color_id").val(color.toRGBA().toString(0));
            NavbarPickr.hide();
        }).on('clear', instance => {
            $("#nav").css("backgroundColor", navbarColor);
            NavbarPickr.hide();
        });
    </script>
@endsection
