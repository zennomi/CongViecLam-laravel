@extends('website.layouts.app')
@section('title')
    {{ __('verify_email_address') }}
@endsection
@section('main')
    <div class="row justify-content-center align-items-center full-height pt-5 mt-5">
        <div class="col-lg-4">
            <div class="auth-box2 mx-auto">
                <form method="POST" action="{{ route('verification.resend') }}" class="rt-form">
                    @csrf
                    <h4 class="rt-mb-20 text-center">{{ __('verify_your_email_before_accessing_dashboard') }}</h4>
                    <span
                        class="d-block body-font-3 text-center text-gray-600 rt-mb-32">{{ __('we_have_sent_an_verification_to_your_email_address_click_the_to_verify_your_email_address_and_activate_your_account') }}
                    </span>
                    <button type="submit" class="btn btn-primary d-block rt-mb-15">
                        <span class="button-content-wrapper ">
                            <span class="button-icon align-icon-right">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>
                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </span>
                            <span class="button-text">
                                {{ __('resend_link') }}
                            </span>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
