@extends('admin.layouts.app')
@section('title')
    {{ __('create') }}
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                                <a href="{{ route('module.state.index') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                                </a>
                            </div>
                            <div class="row pt-3 pb-4">
                                <div class="col-md-6 offset-md-3">
                                    <form class="form-horizontal" action="{{ route('module.state.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                {{ __('country') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <select id="country" name="country"
                                                    class="form-control @error('country') is-invalid @enderror select2bs4 w-100-p">
                                                    <option value="">{{ __('select_one') }}</option>
                                                    @foreach ($countries as $country)
                                                        <option {{ old('country') == $country->id ? 'selected' : '' }}
                                                            value="{{ $country->id }}">
                                                            {{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('country')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                {{ __('state') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="text" value="{{ old('state') }}"
                                                    placeholder="{{ __('enter') }} {{ __('state') }}" name="state"
                                                    class="form-control @error('state') is-invalid @enderror">
                                                @error('state')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-3 col-sm-4">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-plus"></i>
                                                    &nbsp; {{ __('create') }}
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
        </div>
    </div>
@endsection

@section('style')
    <!-- Custom Link -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

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
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <!-- Custom Script -->

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
