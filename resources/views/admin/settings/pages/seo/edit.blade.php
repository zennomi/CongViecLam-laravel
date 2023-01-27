@extends('admin.settings.setting-layout')

@section('title')
    {{ __('edit') }}
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
                <li class="breadcrumb-item active">{{ __('edit_seo') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div width="100%" class="d-flex justify-content-between card-header1">
                            <h3 width="100%" class="card-title line-height-36">
                                {{ __('seo_page_list') }}
                            </h3>
                            <a width="100%" class="btn bg-primary" href="{{ route('settings.seo.index') }}">
                                {{ __('back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.seo.update', $seo->page_slug) }}" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="Title" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title" value="{{ $seo->title }}" id="inputName" placeholder="{{ __('Title') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="description" class="col-sm-2" for="inputExperience">
                                        <small class="d-block">Standard SEO meta descriptions consist 160-165 characters maximum 
                                            <a href="https://www.searchenginejournal.com/on-page-seo/optimize-meta-description" target="_blank">Learn more</a>
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" cols="4" rows="4" name="description" id="description" placeholder="{{ __('Description') }}">{{ $seo->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="Image" class="col-sm-2">
                                        <small class="d-block">
                                            It should be at least 600×315 pixels, but 1200×630 or larger is preferred (up to 5MB).
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <input type="file" data-default-file="{{ asset($seo->image) }}" class="form-control dropify" name="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-info">{{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    {{-- Image upload and Preview --}}
    <style>
        .card-header1 {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            padding: 0.75rem 1.25rem;
            position: relative;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dropify.css">
@endsection

@section('script')
    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endsection
