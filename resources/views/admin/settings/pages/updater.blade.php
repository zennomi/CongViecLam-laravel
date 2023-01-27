@extends('admin.settings.setting-layout')
@section('title')
    {{ __('theme_updater') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0"> {{ __('theme_updater') }} </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('theme_updater') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('website_theme_style') }}</h3>
        </div>
        <div class="card-body">

        </div>
    </div>
@endsection
