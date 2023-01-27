<link rel="icon" type="image/png" sizes="32x32" href="{{ $setting->favicon_image_url }}">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('backend/css/combined.css') }}">


@yield('style')
{!! $setting->header_css !!}
{!! $setting->header_script !!}
<style>
    :root {
        --sidebar-bg-color: {{ $setting->sidebar_color }};
        --sidebar-txt-color: {{ $setting->sidebar_txt_color }};
        --top-nav-bg-color: {{ $setting->nav_color }};
        --top-nav-txt-color: {{ $setting->nav_txt_color }};
        --main-color: {{ $setting->main_color }};
        --accent-color: {{ $setting->accent_color }};
    }

</style>
