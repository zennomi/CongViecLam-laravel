@extends('admin.settings.setting-layout')

@section('title')
    {{ __('layout_settings') }}
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
                <li class="breadcrumb-item active">{{ __('layout_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('layout_settings') }} </h3>
        </div>
        <div class="row pt-3 pb-4">
            <form action="{{ route('settings.layout.update') }}" method="post" id="layout_form">
                @csrf
                @method('PUT')
                <input type="hidden" name="default_layout" id="layout_mode">
            </form>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('left_navigation_layout') }}</h5>
                    </div>
                    <img height="200px" width="600px" src="{{ asset('backend/image/setting/left-nav.png') }}"
                        class="card-img-top img-fluid" alt="top nav">
                    @if (userCan('setting.update'))
                        <div class="card-body">
                            @if ($setting->default_layout)
                                <a href="javascript:void(0)" onclick="layoutChange(0)"
                                    class="btn btn-danger">{{ __('inactivate') }}</a>
                            @else
                                <a href="javascript:void(0)" onclick="layoutChange(1)"
                                    class="btn btn-primary">{{ __('activate') }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('top_navigation_layout') }}</h5>
                    </div>
                    <img height="200px" width="600px" src="{{ asset('backend/image/setting/top-nav.png') }}"
                        class="card-img-top img-fluid" alt="top nav">
                    @if (userCan('setting.update'))
                        <div class="card-body">
                            @if ($setting->default_layout)
                                <a href="javascript:void(0)" onclick="layoutChange(0)"
                                    class="btn btn-primary">{{ __('activate') }}</a>
                            @else
                                <a href="javascript:void(0)" onclick="layoutChange(1)"
                                    class="btn btn-danger">{{ __('inactivate') }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function layoutChange(value) {
            $('#layout_mode').val(value)
            $('#layout_form').submit()
        }
    </script>
@endsection
