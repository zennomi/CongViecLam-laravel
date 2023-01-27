@extends('admin.settings.setting-layout')
@section('title')
    {{ __('currency_example') }}
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
                <li class="breadcrumb-item active">{{ __('currency_example') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('currency_example') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <center>
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                width="50%" class="img-fluid mb-2 rounded" alt="white sample">
                        </center>
                        <div class="info-box-text text-center text-muted">{{ __('headphone') }} 1</div>
                        <div class="info-box-number text-center text-muted mb-0">
                            <span>{{ currencyPosition(11) }}</span>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <center>
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                                width="50%" class="img-fluid mb-2 rounded" alt="white sample">
                        </center>
                        <div class="info-box-text text-center text-muted">{{ __('headphone') }} 2</div>
                        <div class="info-box-number text-center text-muted mb-0">
                            <span>{{ currencyPosition(234) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
