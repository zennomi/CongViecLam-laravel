@extends('admin.layouts.app')
@section('title')
    {{ __('profile') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('profile') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('profile') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="text-center">
                            <img id="image" class="profile-user-img img-fluid img-circle border-secondary m-auto p-3" src="{{ auth()->user()->image_url }}" alt="{{ __('user_profile_picture') }}">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">
                            @foreach (auth()->user()->getRoleNames() as $role)
                                (<span>{{ ucwords($role) }}</span>)
                            @endforeach
                        </p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>{{ __('email_address') }}</b>
                                <a class="float-right">{{ auth()->user()->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('registered_at') }}</b>
                                <a class="float-right">{{ auth()->user()->created_at->diffForHumans() .' ' .'( ' .auth()->user()->created_at->format('M d, Y') .' )' }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>{{ __('updated_at') }}</b>
                                <a class="float-right">{{ auth()->user()->updated_at->diffForHumans() .' ' .'( ' .auth()->user()->created_at->format('M d, Y') .' )' }}</a>
                            </li>
                        </ul>
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <a href="{{ route('profile.setting') }}" class="btn btn-primary btn-block mb-3"><b>{{ __('settings') }} </b>
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .profile-user-img {
            height: 150px !important;
            width: 150px !important;
            object-fit: cover !important;
        }
    </style>
@endsection
