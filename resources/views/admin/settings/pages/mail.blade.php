@extends('admin.settings.setting-layout')

@section('title')
    {{ __('mail_settings') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('mail_settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('mail_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="alert alert-warning mb-3">
        <h5>Your Application might show an error, if you don't have setup SMTP</h5>
        <hr class="my-2">
        <p class="mb-0"> Setup SMTP to send all applications emails, such as <strong>Forget Password</strong>, <strong>User Verification</strong>, <strong>Invoice</strong>  & many more. <a href="https://www.gmass.co/smtp-test" target="_blank"> Test your SMTP credentials here </a></p>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('mail_settings') }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('settings.email.update') }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_driver" for="driver" />
                            <input disabled type="text" class="form-control @error('driver') is-invalid @enderror"
                                id="driver" value="smtp" name="driver">
                            @error('driver')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_host" />
                            <input type="text" class="form-control @error('mail_host') is-invalid @enderror" id="mail_host"
                                value="{{ config('mail.mailers.smtp.host') }}" name="mail_host">
                            @error('mail_host')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_port" />
                            <input type="number" class="form-control @error('mail_port') is-invalid @enderror"
                                id="mail_port" value="{{ config('mail.mailers.smtp.port') }}" name="mail_port">
                            @error('mail_port')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_username" />
                            <input type="text" class="form-control @error('mail_username') is-invalid @enderror"
                                id="mail_username" placeholder="{{ __('mail_username') }}" name="mail_username"
                                value="{{ config('mail.mailers.smtp.username') }}">
                            @error('mail_username')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_password" />
                            <input type="text" class="form-control @error('mail_password') is-invalid @enderror"
                                id="mail_password" placeholder="{{ __('mail_password') }}" name="mail_password"
                                value="{{ config('mail.mailers.smtp.password') }}">
                            @error('mail_password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_encryption" />
                            <select name="mail_encryption" id="mail_encryption"
                                class="form-control @error('mail_encryption') is-invalid @enderror">
                                <option {{ config('mail.mailers.smtp.encryption') == 'tls' ? 'selected' : '' }}
                                    value="tls">TLS</option>
                                <option {{ config('mail.mailers.smtp.encryption') == 'ssl' ? 'selected' : '' }}
                                    value="ssl">SSL</option>
                            </select>
                            @error('mail_encryption')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_from_address" />
                            <input type="email" class="form-control @error('mail_from_address') is-invalid @enderror"
                                id="mail_from_address" value="{{ config('mail.from.address') }}"
                                name="mail_from_address">
                            @error('mail_from_address')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <x-forms.label name="mail_from_name" />
                            <input type="text" class="form-control @error('mail_from_name') is-invalid @enderror"
                                id="mail_from_name" value="{{ config('mail.from.name') }}" name="mail_from_name">
                            @error('mail_from_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                @if (userCan('setting.update'))
                    <div class="mx-auto">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                {{ __('update') }}</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">{{ __('send_test_mail') }}</h3>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <form class="form-inline" action="{{ route('settings.email.test') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <x-forms.label name="{{ __('email_address') }}" for="test_email" />
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input name="test_email" type="email"
                            class="form-control  @error('test_email') is-invalid @enderror mail-address-width"
                            id="test_email" placeholder="{{ __('email_address') }}">
                        @error('test_email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    @if (userCan('setting.update'))
                        <button type="submit" class="btn btn-primary mb-2"><i class="far fa-paper-plane"></i>
                            {{ __('send_mail') }}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .mail-address-width {
            min-width: 400px;
        }

    </style>
@endsection
