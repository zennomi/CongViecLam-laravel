@extends('admin.layouts.app')
@section('title')
    {{ __('settings') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('settings') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    @php
    $auth = auth()->user();
    @endphp
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="tab-pane active" id="gen_settings">
                        <div class="text-center mb-4">
                            <img class="profile-user-img img-circle border-secondary m-auto p-3"
                                src="{{ $auth->image_url }}" alt="{{ __('profile_picture') }}">

                        </div>
                        <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST"
                            enctype="multipart/form-data" autocomplete="off">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <x-forms.label name="name" for="name" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input required name="name" value="{{ $auth->name }}" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="email" for="email" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input required name="email" value="{{ $auth->email }}" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="{{ __('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="image" for="change_image" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input name="image" autocomplete="image"
                                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                            type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">{{ __('choose_file') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="password" for="change-password-visibility" class="col-sm-3" :required="false" />
                                <div class="col-sm-9 mt-2">
                                    <input type="hidden" value="0" name="isPasswordChange">
                                    <div class="icheck-success d-inline">
                                        <input value="1" name="isPasswordChange" type="checkbox"
                                            {{ old('isPasswordChange') ? 'checked' : '' }}
                                            id="change-password-visibility">
                                        <label for="change-password-visibility">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="password_visibility" class="{{ old('isPasswordChange') ? 'd-block' : 'd-none' }}">
                                <div class="form-group row">
                                    <x-forms.label name="current_password" for="change-password-visibility"
                                        class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input name="current_password" type="password"
                                            value="{{ old('current_password') }}"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            placeholder="{{ __('current_password') }}">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="new_password" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('new_password') }}">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="confirm_password" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input name="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="{{ __('confirm_password') }}">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback"> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .profile-user-img {
            height: 150px !important;
            width: 150px !important;
            object-fit: cover !important;
        }
    </style>
@endsection

@section('script')
    <script>
        $('#change-password-visibility').on('change', function() {
            var value = $(this).prop('checked') == true ? 1 : 0;

            if (value == 1) {
                $('#password_visibility').addClass('d-block')
                $('#password_visibility').removeClass('d-none')
            } else {
                $('#password_visibility').addClass('d-none')
                $('#password_visibility').removeClass('d-block')
            }
        })
    </script>
@endsection
