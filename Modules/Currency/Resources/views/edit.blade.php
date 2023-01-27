@extends('admin.settings.setting-layout')
@section('title')
    {{ __('edit_currency') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('currency') }} {{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('edit_currency') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                        <a href="{{ route('module.currency.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center   justify-content-center"><i
                                class="fas fa-arrow-left"></i>
                            &nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.currency.update', $currency->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="name">
                                        {{ __('name') }}
                                        <span class="form-label-required text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ $currency->name }}" placeholder="E.g - Dollar">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="code">
                                        {{ __('code') }}
                                        <span class="form-label-required text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" id="code" class="form-control  "
                                            value="{{ $currency->code }}" placeholder="E.g - USD">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="symbol">
                                        {{ __('symbol') }}
                                        <span class="form-label-required text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="symbol" id="symbol" class="form-control  "
                                            value="{{ $currency->symbol }}" placeholder="E.g - USD">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="position">
                                        {{ __('position') }}
                                        <span class="form-label-required text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <x-forms.switch-input button="buttonOne" oldvalue="oldalue" name="symbol_position" onText="{{ __('left') }}" offText="{{ __('right') }}" value="left" :checked="$currency->symbol_position == 'left'" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>
                                            {{ __('update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $("input[name=symbol_position]").on('switchChange.bootstrapSwitch', function(event, state) {
            let val = event.currentTarget.checked ? 'left' : 'right';
            $('input[name=symbol_position]').val(val);
        });
    </script>
@endsection
