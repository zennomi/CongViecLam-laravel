@extends('admin.layouts.app')
@section('title')
    {{ __('create_category') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('create_category') }}</h3>
                        <a href="{{ route('module.category.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4 justify-content-center">
                        <div class="col-md-8">
                            <form class="form-horizontal" action="{{ route('module.category.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="author_id" value="{{ auth()->id() }}">
                                <div class="row justify-content-center pt-3 pb-4">
                                    <div class="col-md-9 px-5">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{ __('name') }}<small
                                                    class="text-danger">*</small></label>
                                            <div class="col-sm-10">
                                                <input value="{{ old('name') }}" name="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="{{ __('enter') }} {{ __('name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">{{ __('image') }}</label>
                                            <div class="col-sm-10">
                                                <input name="image" type="file"
                                                    class="form-control-file @error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-plus"></i>&nbsp;{{ __('create') }}</button>
                                            </div>
                                        </div>
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
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });

        $('#customFile').on('change', function(event) {
            $('#defaulthide').addClass('d-block')
            $('#defaulthide').removeClass('d-none')
        });
    </script>
@endsection
