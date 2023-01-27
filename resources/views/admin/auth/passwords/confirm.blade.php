@extends('admin.layouts.auth')
@section('content')
    <h3 class="mb-3">
        {{ __('confirm_password') }}
    </h3>
    {{ __('please_confirm_your_password_before_continuing') }}

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="form-group row">
            <x-forms.label name="password" for="password" class="col-md-4 text-md-right" />
            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('confirm_password') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('forgot_your_password') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
