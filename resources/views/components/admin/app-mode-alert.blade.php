@if (config('app.mode') != 'live')
    <div class="alert alert-warning top-fixed" role="alert">
        @if (config('app.mode') == 'maintenance')
            <strong>{{ __('warning') }}!</strong> {{ __('maintenance_mode_is_on_change_from') }} <a
                href="{{ route('settings.system', ['#mode_settings']) }}">
                {{ __('website_settings') }}</a>
        @elseif (config('app.mode') == 'comingsoon')
            <strong>{{ __('warning') }}!</strong> {{ __('coming_soon_mode_is_on_change_from') }} <a
                href="{{ route('settings.system', ['#mode_settings']) }}">
                {{ __('website_settings') }}</a>
        @endif
    </div>
@endif
