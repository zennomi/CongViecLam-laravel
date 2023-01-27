@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('edit') }}</h3>
                        <a href="{{ route('module.blog.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row justify-content-center pt-3 pb-4">
                        <div class="col-md-9 px-5">
                            <form class="form-horizontal" action="{{ route('module.blog.update', $post->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('title') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-10">
                                        <input value="{{ $post->title }}" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{ __('enter') }} {{ __('title') }}">
                                        @error('title')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('category') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-10">
                                        <select name="category_id"
                                            class="select2bs4 @error('category_id') is-invalid @enderror w-100-p">
                                            @foreach ($categories as $category)
                                                <option {{ $post->category_id == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('short_description') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-10">
                                        <textarea rows="5" type="text" class="form-control" name="short_description" rows="3"
                                            {{ __('enter') }} {{ __('short_description') }}">{{ $post->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ __('description') }}<small
                                            class="text-danger">*</small></label>
                                    <div class="col-sm-10">
                                        <textarea id="editor2" type="text" class="form-control" name="description"
                                            placeholder="{{ __('enter') }}  {{ __('description') }}">{{ $post->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10 text-center">
                                        <button type="submit" value="draft" name="status" class="btn btn-success"><i
                                                class="fas fa-archive"></i>&nbsp;{{ __('save_as_draft') }}</button>
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-sync"></i>&nbsp;{{ __('update') }}</button>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <label class="form-lebel mb-5">{{ __('thumbnail_image') }}</label> <br>
                            <input name="image" type="file" accept="image/png, image/jpg, image/jpeg"
                                class="form-control dropify border-0 pl-0 @error('image') is-invalid @enderror"
                                data-default-file="{{ $post->image_url }}" data-max-file-size="3M" data-show-errors="true"
                                data-allowed-file-extensions='["jpg", "jpeg","png"]'>
                            @error('image')
                                <span class="invalid-feedback d-block"
                                    role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
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
    <link rel="stylesheet" href="{{ asset('backend') }}/css/dropify.min.css" />
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
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
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>
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

        // dropify
        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
    </script>
@endsection
