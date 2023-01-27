@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('contact');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <div class="breadcrumbs-custom breadcrumbs-height">
        <div class="container">
            <div class="breadcrumb-menu">
                <h6 class="f-size-18 m-0">{{ __('contact') }}</h6>
                <ul>
                    <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                    <li>/</li>
                    <li>{{ __('contact') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="rt-contact">
        <div class="container">
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 rt-mb-lg-30 ">
                    <div class="pl30">
                        <span
                            class="body-font-3 ft-wt-5 text-primary-500 rt-mb-15 d-inline-block">{{ __('contact_title') }}</span>
                        <h2 class="rt-mb-32">{{ __('we_care_about_customer_services') }}</h2>
                        <p class="body-font-2 text-gray-500 rt-mb-32">{{ __('want_to_chat_We_love_to_hear_from_you_get_in_touch_with_our_customer_success_team_to_inquire_rates_or_just_say_hello') }}</p>
                        <a href="mailto:{{ $setting->email }}" target="__blank" class="btn btn-primary btn-lg">
                            {{ __('email_support') }}</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="contact-auth-box">
                        <form action="{{ route('module.contact.store') }}" class="rt-form" method="POST">
                            @csrf
                            <h5 class="rt-mb-32">{{ __('get_in_touch') }}</h5>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fromGroup rt-mb-15">
                                        <input id="name" class=" form-control @error('name') is-invalid @enderror"
                                            type="text" placeholder="{{ __('name') }}" name="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="fromGroup rt-mb-15">
                                        <input id="email" class="form-control @error('email') is-invalid @enderror"
                                            type="email" placeholder="{{ __('email') }}" name="email"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="fromGroup rt-mb-15">
                                <input id="subject" class="form-control @error('subject') is-invalid @enderror"
                                    type="text" placeholder="{{ __('subjects') }}" name="subject"
                                    value="{{ old('subject') }}">
                                @error('subject')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="rt-mb-30 tarea-dafault">
                                <textarea id="message" class="form-control @error('message') is-invalid @enderror" type="text"
                                    placeholder="{{ __('message') }}" name="message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary d-block rt-mb-15" id="submitButton">
                                <span class="button-content-wrapper ">
                                    <span class="button-icon align-icon-right">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M22 2L11 13" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M22 2L15 22L11 13L2 9L22 2Z" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </span>
                                    <span class="button-text rt-mr-8">
                                        {{ __('send_message') }}
                                    </span>
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="rt-spacer-100 rt-spacer-md-50"></div>
        </div>
        <div class="map">
            {!! $cms_setting->contact_map !!}
        </div>
    </div>


    {{-- Subscribe Newsletter --}}
    <x-website.subscribe-newsletter />
@endsection
@section('css')
    <style>
        .breadcrumbs-custom {
            padding: 20px;
            background-color: var(--gray-20);
            transition: all 0.24s ease-in-out;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            validate();
            $('#name, #email, #subject, #message').keyup(validate);
        });

        function validate() {
            if (
                $('#name').val().length > 0 &&
                $('#email').val().length > 0 &&
                $('#subject').val().length > 0 &&
                $('#message').val().length > 0
            ) {
                $('#submitButton').attr('disabled', false);
            } else {
                $('#submitButton').attr('disabled', true);
            }
        }
    </script>
@endsection
