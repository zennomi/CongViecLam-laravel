@extends('admin.settings.setting-layout')
@section('title')
    {{ __('upgrade_system') }}
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
                <li class="breadcrumb-item active">{{ __('upgrade_system') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('upgrade_system') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-lg-4 col-xxl-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="h6">Update your system</h3>
                            <span>Current verion: {{ config('zakirsoft.app_version') }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-5">
                            <ul class="mb-0">
                                <li class="">Download latest version from codecanyon.</li>
                                <li class="">Extract downloaded zip. You will find app.zip file in those extraced
                                    files.</li>
                                <li class="">Upload that zip file here and click update now.</li>
                            </ul>
                        </div>
                        <form action="{{ route('settings.upgrade.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gutters-5">
                                <div class="col-md">
                                    <input type="file" name="zip_file">
                                </div>
                                <div class="col-md-auto">
                                    <button type="submit" class="btn btn-primary btn-block">Update Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
