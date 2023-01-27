@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('pricing');
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
            <div class="row align-items-center breadcrumbs-height">
                <div class="col-12 justify-content-center text-center">
                    <div class="breadcrumb-title rt-mb-10"> {{ __('pricing') }}</div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> {{ __('pricing') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="terms-condition ">
        <div class="container">
            @if ($plans->count() > 0)
                <div class="row justify-content-center text-center">
                    <div class="col-12">
                        <div class="rt-spacer-100 rt-spacer-md-50"></div>
                        <h4 class="rt-mb-24">
                            {{ __('choose_plan') }}
                        </h4>
                        <div class="body-font-3 text-gray-500 rt-mb-24 max-474 d-inline-block">
                            {{ __('choose_plan_description') }}
                        </div>
                    </div>
                </div>
            @endif
            <section class="pricing-area mt-5">
                <div class="row">
                    @forelse ($plans as $plan)
                        @if ($plan->frontend_show)
                            <div class="col-xl-4 col-lg-4 col-md-6 rt-mb-24">
                                <div class="single-price-table mb-4 mb-md-0 {{ $plan->recommended ? 'active' : '' }}">
                                    <div class="price-header">
                                        <h6 class="rt-mb-10">{{ $plan->label }}</h6>
                                        @if ($plan->recommended)
                                            <span class="badge bg-primary-500 text-white">{{ __('recommanded') }}</span>
                                        @endif
                                        <span
                                            class="text-gray-500 body-font-3 rt-mb-15 d-block">{{ $plan->description }}</span>
                                        <div class="price-amount">
                                            <span class="text-primary-500 text-h2">
                                                <span class="fst">{{ currencyPosition($plan->price) }}</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="price-body">
                                        <ul class="rt-list">
                                            <li>
                                                <span>
                                                    <img src="{{ asset('frontend') }}/assets/images/icon/check.png"
                                                        alt="">
                                                </span>
                                                <span>
                                                    {{ __('post') }} <b>{{ $plan->job_limit }}</b>
                                                    {{ __('jobs') }}
                                                </span>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('frontend') }}/assets/images/icon/check.png"
                                                        alt=""></span>
                                                <span><b>{{ $plan->featured_job_limit }}</b>
                                                    {{ __('featured_job') }}</span>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('frontend') }}/assets/images/icon/check.png"
                                                        alt=""></span>
                                                <span><b>{{ $plan->highlight_job_limit }}</b>
                                                    {{ __('highlights_job') }}</span>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('frontend') }}/assets/images/icon/check.png"
                                                        alt=""></span>
                                                <span><b>{{ $plan->candidate_cv_view_limit }}</b>
                                                    {{ __('candidate_profile_view') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="price-footer">
                                        @auth('user')
                                            <a href="{{ route('website.plan.details', $plan->label) }}"
                                                class="btn btn-primary-50 d-block">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right">
                                                        <i class="ph-arrow-right"></i>
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('get_started') }}
                                                    </span>
                                                </span>
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-primary-50 d-block login_required">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right">
                                                        <i class="ph-arrow-right"></i>
                                                    </span>
                                                    <span class="button-text">
                                                        {{ __('get_started') }}
                                                    </span>
                                                </span>
                                            </button>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-md-12">
                            <div class="card text-center">
                                <x-not-found message="{{ __('no_price_plan_found_contact_website_owner') }}" />
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </section>
    <div class="rt-spacer-75 rt-spacer-md-30"></div>

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
