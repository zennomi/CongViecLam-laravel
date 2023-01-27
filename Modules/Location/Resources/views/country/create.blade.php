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
                                <a href="{{ route('module.country.index') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                                </a>
                            </div>
                            <div class="row pt-3 pb-4">
                                <div class="col-md-6 offset-md-3">
                                    <form class="form-horizontal" action="{{ route('module.country.store') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                {{ __('name') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <input value="{{ old('name') }}" name="name" type="text"
                                                    class="form-control {{ $errors->has('name') ? 'is-invalid ' : '' }}"
                                                    placeholder="{{ __('enter') }} {{ __('name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{ __('image') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <div class="">
                                                    <input name="image" type="file" data-show-errors="true"
                                                        data-width="100%" data-default-file=""
                                                        class="form-control dropify form-control-file @error('image') is-invalid @enderror border-0">
                                                    @error('image')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="dropify-preview">
                                                        <span class="dropify-render"></span>
                                                        <div class="dropify-infos">
                                                            <div class="dropify-infos-inner">
                                                                <p class="dropify-filename">
                                                                    <span class="file-icon">
                                                                    </span>
                                                                    <span class="dropify-filename-inner"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">
                                                {{ __('icon') }}
                                                <small class="text-danger">*</small>
                                            </label>
                                            <div class="col-sm-9">
                                                <input type="hidden" name="icon" id="icon"
                                                    value="{{ old('icon') }}" class="form-control" />
                                                <div class="" data-icon="fab fa-twitter" id="target"></div>
                                                @error('icon')
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
    {{-- Flat Icon Css Link --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css" />
    {{-- Image upload and Preview --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
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
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();

        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 16,
            footer: true,
            header: true,
            icon: '',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 6,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });
        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
        // dropify
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
        $('.search-control').val('');
    </script>
@endsection
