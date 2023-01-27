@extends('admin.settings.setting-layout')
@section('title')
    {{ __('edit_language') }}
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
                <li class="breadcrumb-item active">{{ __('edit_language') }}</li>
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
                        <h3 class="card-title line-height-36">{{ __('edit_language') }}</h3>
                        <a href="{{ route('languages.index') }}" class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('languages.update', $language->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="name" class="select2bs4 w-100 @error('name') is-invalid @enderror">
                                            @foreach ($translations as $key => $country)
                                                <option {{ $country['name'] == $language->name ? 'selected' : '' }}
                                                    value="{{ $country['name'] }}"> {{ $country['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"> <strong> {{ $message }} </strong> </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="code" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="code"
                                            class="select2bs4 w-100 @error('code') is-invalid @enderror">
                                            @foreach ($translations as $key => $country)
                                                <option {{ $key == $language->code ? 'selected' : '' }}
                                                    value="{{ $key }}"> {{ $key }}</option>
                                            @endforeach
                                        </select>
                                        @error('code')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="direction" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="direction" class="form-control @error('direction') is-invalid @enderror">
                                            <option {{ $language->direction == 'ltr' ? 'selected' : '' }} value="ltr">
                                                {{ __('ltr') }}
                                            </option>
                                            <option {{ $language->direction == 'rtl' ? 'selected' : '' }} value="rtl">
                                                {{ __('rtl') }}
                                            </option>
                                        </select>
                                        @error('direction')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="flag" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="hidden" name="icon" id="icon"
                                            value="{{ old('icon', $language->icon) }}" />
                                        <div id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sync"></i>&nbsp; {{ __('update') }}</button>
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

@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flag-icon-css/css/flag-icon.min.css">

    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: '{{ $language->icon }}',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
