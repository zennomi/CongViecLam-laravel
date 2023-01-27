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
    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="logo">
                    <div class="col-md-10 offset-md-1">
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <label class="col-sm-3 col-form-label">{{ __('site_logo') }}</label>
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->dark_logo) }}" name="dark_logo">
                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-3 col-form-label">{{ __('white_logo') }}</label>
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->light_logo) }}" name="light_logo">

                                </div>
                                <div class="col-sm-4">
                                    <label class="col-sm-6 col-form-label">{{ __('site_favicon') }}</label>
                                    <input type="file" class="form-control dropify"
                                        data-default-file="{{ asset($setting->favicon_image) }}" name="favicon_image">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="loader_image">
                                        {{ __('loader_image') }}
                                    </label>
                                    <div class="row">
                                        <input type="file" class="form-control dropify"
                                            data-default-file="{{ asset($setting->loader_image) }}" name="loader_image"
                                            data-allowed-file-extensions="jpg png jpeg gif"
                                            accept="image/png, image/jpg, image/jpeg, image/gif">
                                    </div>
                                </div>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                            {{ __('update') }}</button>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('style')
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
@endsection


@section('script')
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>

    <script>
        $('.dropify').dropify();
    </script>
@endsection
