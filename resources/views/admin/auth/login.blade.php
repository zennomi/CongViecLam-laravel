@extends('admin.layouts.auth')
@section('content')
    <p class="login-box-msg">{{ __('sign_in_to_start_your_session') }}</p>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="input-group mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="{{ __('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                placeholder="{{ __('password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <x-forms.label name="remember_me" :required="false" for="remember" />
            </div>

            <a href="{{ route('admin.password.request') }}">{{ __('i_forgot_my_password') }}</a>
        </div>
        @if (config('captcha.active'))
            <div class="input-group mt-3 text-center">
                {!! NoCaptcha::display() !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger text-sm">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                @endif
            </div>
        @endif
        <button type="submit" class="btn btn-primary btn-block mt-4">
            {{ __('sign_in') }}
            <i class="fas fa-arrow-right"></i>
        </button>
    </form>
@endsection

@section('backend_auth_script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
