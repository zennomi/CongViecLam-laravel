@extends('website.layouts.app')

@section('title')
    {{ __('privacy_policy') }}
@endsection

@section('main')
    <div class="breadcrumbs breadcrumbs-height">
        <div class="container">
            <div class="row align-items-center breadcrumbs-height">
                <div class="col-12 justify-content-center text-center">
                    <div class="breadcrumb-title rt-mb-10"> {{ __('privacy_policy') }}</div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ __('privacy_policy') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="terms-condition ">
        <div class="container">
            <div class="row">
                <div class=" col-lg-12 order-1 order-lg-0 rt-mb-lg-20">
                    <div>
                        <div class="rt-spacer-50"></div>
                        <div class="body-font-3 text-gray-500 rt-mb-24">
                            {!! $privacy_page == null ? $privacy_page_default->privary_page : $privacy_page !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Subscribe Newsletter --}}
    <x-website.subscribe-newsletter />
@endsection
