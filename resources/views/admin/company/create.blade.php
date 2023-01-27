@extends('admin.layouts.app')
@section('title')
    {{ __('create_employer') }}
@endsection

@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title line-height-36">{{ __('create') }}</h4>
                    <button type="submit"
                        class="btn bg-success float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus mr-1"></i>
                        {{ __('save') }}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            {{ __('account_details') }}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <x-forms.label name="employer_name" :required="false"/>
                                <x-forms.input type="text" name="name" placeholder="name" />
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="username" :required="false"/>
                                    <x-forms.input type="text" name="username" placeholder="username" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="email" />
                                    <x-forms.input type="email" name="email" placeholder="email" />
                                </div>

                            </div>
                            <div class="form-group">
                                <x-forms.label name="password" />
                                <x-forms.input type="password" name="password" placeholder="password" />
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            {{ __('location') }}
                            <span class="text-red font-weight-bold">*</span>
                            <small class="h6">
                                ({{ __('click_to_add_a_pointer') }})
                            </small>
                        </div>
                        <div class="card-body">
                            <x-website.map.map-warning/>
                            @php
                                $map = setting('default_map');
                            @endphp
                            <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}" id='map-box'>
                            </div>
                            <div id="google-map-div" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                <input id="searchInput" class="mapClass" type="text" placeholder="Enter a location">
                                <div class="map mymap" id="google-map"></div>
                            </div>
                            @error('location')
                                <span class="ml-3 text-md text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            {{ __('contact') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="phone" />
                                    <x-forms.input type="text" name="contact_phone" placeholder="phone" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="email" />
                                    <x-forms.input type="email" name="contact_email" placeholder="email" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            {{ __('images') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4">
                                    <x-forms.label name="logo" :required="false" />
                                    <input name="logo" type="file" data-show-errors="true" data-width="50%"
                                        data-default-file="" class="dropify">
                                </div>
                                <div class="form-group col-8">
                                    <x-forms.label name="banner" :required="false" />
                                    <input name="image" type="file" data-show-errors="true" data-width="100%"
                                        data-default-file="" class="dropify">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            {{ __('social_details') }}
                        </div>
                        <div class="card-body">
                            <div id="multiple_feature_part">
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <select class="form-control @error('social_media') border-danger @enderror"
                                            name="social_media[]">
                                            <option value="" class="d-none" disabled>{{ __('select_one') }}
                                            </option>
                                            <option {{ old('social_media') == 'facebook' ? 'selected' : '' }}
                                                value="facebook">{{ __('facebook') }}</option>
                                            <option {{ old('social_media') == 'twitter' ? 'selected' : '' }}
                                                value="twitter">{{ __('twitter') }}</option>
                                            <option {{ old('social_media') == 'instagram' ? 'selected' : '' }}
                                                value="instagram">{{ __('instagram') }}
                                            </option>
                                            <option {{ old('social_media') == 'youtube' ? 'selected' : '' }}
                                                value="youtube">{{ __('youtube') }}</option>
                                            <option {{ old('social_media') == 'linkedin' ? 'selected' : '' }}
                                                value="linkedin">{{ __('linkedin') }}</option>
                                            <option {{ old('social_media') == 'pinterest' ? 'selected' : '' }}
                                                value="pinterest">{{ __('pinterest') }}
                                            </option>
                                            <option {{ old('social_media') == 'reddit' ? 'selected' : '' }}
                                                value="reddit">{{ __('reddit') }}</option>
                                            <option {{ old('social_media') == 'github' ? 'selected' : '' }}
                                                value="github">{{ __('github') }}</option>
                                            <option {{ old('social_media') == 'other' ? 'selected' : '' }} value="other">
                                                {{ __('other') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="url" name="url[]" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a role="button" onclick="add_features_field()"
                                            class="btn bg-primary text-light"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            {{ __('profile_details') }}
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="organization_type" />
                                    <select name="organization_type_id"
                                        class="form-control select2bs4 {{ error('organization_type_id') }}"
                                        id="organization_type_id">
                                        <option value="" class="d-none">
                                            {{ __('select_one') }}
                                        </option>
                                        @foreach ($organization_types as $type)
                                            <option {{ $type->id == old('organization_type_id') ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="organization_type_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="industry_type" />
                                    <select name="industry_type_id"
                                        class="form-control select2bs4 {{ error('industry_type_id') }}"
                                        id="organization_type_id">
                                        <option value="" class="d-none">
                                            {{ __('select_one') }}
                                        </option>
                                        @foreach ($industry_types as $type)
                                            <option {{ $type->id == old('industry_type_id') ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="industry_type_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="team_size" :required="false"/>
                                    <select name="team_size_id"
                                        class="form-control select2bs4 {{ error('team_size_id') }}"
                                        id="organization_type_id">
                                        <option value="" class="d-none">
                                            {{ __('select_one') }}
                                        </option>
                                        @foreach ($team_sizes as $size)
                                            <option {{ $size->id == old('team_size_id') ? 'selected' : '' }}
                                                value="{{ $size->id }}">
                                                {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="team_size_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="nationality" />
                                    <select name="nationality_id"
                                        class="form-control select2bs4 {{ error('nationality_id') }}"
                                        id="nationality_id">
                                        <option value="" class="d-none">
                                            {{ __('nationality') }}
                                        </option>
                                        @foreach ($nationalities as $nationality)
                                            <option {{ $nationality->id == old('nationality_id') ? 'selected' : '' }}
                                                value="{{ $nationality->id }}">
                                                {{ $nationality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="nationality_id" />
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group datepicker col-4">
                                    <x-forms.label name="website" :required="false"/>
                                    <x-forms.input type="text" name="website" placeholder="website" />
                                </div>
                                <div class="form-group datepicker col-4">
                                    <x-forms.label name="establishment_date" :required="false" />
                                    <x-forms.input type="text" name="establishment_date" placeholder="select_one"
                                        id="establishment_date" />
                                    <x-forms.error name="establishment_date" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="bio" :required="false" />
                                    <textarea id="editor" rows="8" name="bio" placeholder="{{ __('bio') }}" class="form-control">{{ old('bio') }}</textarea>
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="vision" :required="false" />
                                    <textarea id="editor2" rows="8" name="vision" placeholder="{{ __('vision') }}" class="form-control">{{ old('vision') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">

    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
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
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
@endsection

@section('script')
    <script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>

    <script>
        $('.dropify').dropify();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });

        //init datepicker
        $(document).ready(function() {
            $('#establishment_date').datepicker({
                format: 'dd-mm-yyyy'
            });
        });

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });

        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="row justify-content-center">
                <div class="form-group col-md-4">
                    <select class="form-control @error('social_media') border-danger @enderror"
                        name="social_media[]">
                        <option value="" class="d-none" disabled>{{ __('select_one') }}
                        </option>
                        <option {{ old('social_media') == 'facebook' ? 'selected' : '' }}
                            value="facebook">{{ __('facebook') }}</option>
                        <option {{ old('social_media') == 'twitter' ? 'selected' : '' }}
                            value="twitter">{{ __('twitter') }}</option>
                        <option {{ old('social_media') == 'instagram' ? 'selected' : '' }}
                            value="instagram">{{ __('instagram') }}
                        </option>
                        <option {{ old('social_media') == 'youtube' ? 'selected' : '' }}
                            value="youtube">{{ __('youtube') }}</option>
                        <option {{ old('social_media') == 'linkedin' ? 'selected' : '' }}
                            value="linkedin">{{ __('linkedin') }}</option>
                        <option {{ old('social_media') == 'pinterest' ? 'selected' : '' }}
                            value="pinterest">{{ __('pinterest') }}
                        </option>
                        <option {{ old('social_media') == 'reddit' ? 'selected' : '' }}
                            value="reddit">{{ __('reddit') }}</option>
                        <option {{ old('social_media') == 'github' ? 'selected' : '' }}
                            value="github">{{ __('github') }}</option>
                        <option {{ old('social_media') == 'other' ? 'selected' : '' }} value="other">
                            {{ __('other') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="url" name="url[]" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <a role="button" id="remove_item"
                        class="btn bg-danger text-light"><i class="fas fa-times"></i></a>
                </div>
            </div>
            `);
        }
    </script>
    @include('map::set-googlemap')
    @include('map::set-mapbox')
@endsection
