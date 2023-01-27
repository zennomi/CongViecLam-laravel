@extends('admin.settings.setting-layout')

@section('title')
    {{ __('system_settings') }}
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
                <li class="breadcrumb-item active">{{ __('system_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <form action="{{ route('settings.system.timezone.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col-6">
                        <div class="form-group">
                            <label for="timezone">
                                {{ __('system_timezone') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <select name="timezone" class="timezone-select form-control">
                                @foreach ($timeszones as $timezone)
                                    <option {{ config('app.timezone') == $timezone->value ? 'selected' : '' }}
                                        value="{{ $timezone->value }}">
                                        {{ $timezone->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('{{ __('are_you_sure') }}')"><i class="fas fa-sync"></i>
                                    &nbsp; {{ __('update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('settings.mode.comingsoon') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked data-toggle="toggle"
                                    name="comingsoon_mode" id="comingsoon_mode" data-bootstrap-switch value="1"
                                    @if ($setting->comingsoon_mode == 1) checked @endif>

                                <label class="form-check-label"
                                    for="commingsoon_mode">{{ __('comming_soon_mode') }}</label>
                            </div>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-success"
                                        onclick="return confirm('{{ __('are_you_sure') }}')"><i
                                            class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </form>
                <form action="{{ route('settings.mode.maintaince') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="maintenance_mode"
                                    id="maintenance_mode" value="1" @if ($setting->maintenance_mode == 1) checked @endif>
                                <label class="form-check-label"
                                    for="maintenance_mode">{{ __('maintenance_mode') }}</label>
                            </div>
                            <span class="help-text">{{ __('live_mode_enable_url') }}
                                <span class="badge badge-dark">
                                    {{ config('zakirsoft.maintenance_disable_url') }}
                                </span>
                            </span>
                        </div>
                        @if (userCan('setting.update'))
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('{{ __('are_you_sure') }}')"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                </form>
                <form action="{{ route('settings.search.indexing') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="search_engine_indexing"
                                    id="search_engine_indexing" value="1" @if ($setting->search_engine_indexing == 1) checked @endif>
                                <label class="form-check-label"
                                    for="search_engine_indexing">{{ __('search_engine_ndexing') }}</label>
                            </div>
                        </div>
                        @if (userCan('setting.update'))
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('{{ __('are_you_sure') }}')"><i
                                                class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                </form>
                <form action="{{ route('settings.google.analytics') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-2 col-form-label"
                            for="google_analytics_id">{{ __('google_analytics_id') }}</label>
                        <div class="col-sm-7 col-md-4">
                            <input value="{{ config('zakirsoft.google_analytics') }}" name="google_analytics_id"
                                type="text" class="form-control @error('google_analytics_id') is-invalid @enderror"
                                autocomplete="off">
                            @error('google_analytics_id')
                                <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="google_analytics"
                                    id="google_analytics" value="1" @if ($setting->google_analytics == 1) checked @endif>
                                <label class="form-check-label"
                                    for="google_analytics">{{ __('google_nalytics') }}</label>
                            </div>
                        </div>
                        @if (userCan('setting.update'))
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                </form>
                <form action="{{ route('settings.facebook.pixel') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-5 col-md-2 col-form-label"
                            for="facebook_pixel_id">{{ __('facebook_pixel_id') }}</label>
                        <div class="col-sm-7 col-md-4">
                            <input value="{{ config('zakirsoft.fb_pixel') }}" name="facebook_pixel_id" type="text"
                                class="form-control @error('facebook_pixel_id') is-invalid @enderror" autocomplete="off">
                            @error('facebook_pixel_id')
                                <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="facebook_pixel" id="facebook_pixel"
                                    value="1" @if ($setting->facebook_pixel == 1) checked @endif>
                                <label class="form-check-label" for="facebook_pixel">{{ __('facebook_pixels') }}</label>
                            </div>
                        </div>
                        @if (userCan('setting.update'))
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
