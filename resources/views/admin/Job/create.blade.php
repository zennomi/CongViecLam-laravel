@extends('admin.layouts.app')
@section('title')
    {{ __('create') }} {{ __('job') }}
@endsection
@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" action="{{ route('job.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title line-height-36">{{ __('create') }} {{ __('job') }}</h4>
                    <button type="submit"
                        class="btn bg-success float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-plus mr-1"></i> {{ __('save') }}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('job_details') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-12">
                                    <label for="title">
                                        {{ __('title') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <input id="title" type="text" name="title" placeholder="{{ __('title') }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="company_id">
                                        {{ __('company') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="company_id"
                                        class="form-control select2bs4 @error('company_id') is-invalid @enderror"
                                        id="company_id">
                                        <option value=""> {{ __('company') }}</option>
                                        @foreach ($companies as $company)
                                            <option {{ old('company_id') == $company->id ? 'selected' : '' }}
                                                value="{{ $company->id }}"> {{ $company->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="category_id">
                                        {{ __('category') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="category_id"
                                        class="form-control select2bs4 @error('category_id') is-invalid @enderror"
                                        id="category_id">
                                        <option value=""> {{ __('category') }}</option>
                                        @foreach ($job_category as $category)
                                            <option {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}"> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="vacancies" for="vacancies" :required="true" />
                                    <input id="vacancies" type="text" name="vacancies"
                                        placeholder="{{ __('vacancies') }}"
                                        class="form-control @error('vacancies') is-invalid @enderror"
                                        value="{{ old('vacancies') }}">
                                    @error('vacancies')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="deadline">
                                        {{ __('deadline') }}
                                    </label>
                                    <input id="deadline" type="date" name="deadline" placeholder="MM/DD/YYYY"
                                        class="form-control @error('deadline') is-invalid @enderror"
                                        value="{{ old('deadline') }}">
                                    @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                {{ __('location') }}
                                <span class="text-red font-weight-bold">*</span>
                                <small class="h6">
                                    ({{ __('click_to_add_a_pointer') }})
                                </small>
                            </div>
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
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('salary_details') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="salary_type">
                                        {{ __('salary_type') }}
                                        <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <select name="salary_type"
                                        class="form-control select2bs4 @error('salary_type') is-invalid @enderror"
                                        id="salary_type">
                                        @foreach ($salary_types as $salary_type)
                                            <option {{ $salary_type->id == old('salary_type') ? 'selected' : '' }}
                                                value="{{ $salary_type->id }}"> {{ $salary_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('salary_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="min_salary">
                                        {{ __('min_salary') }} <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <input id="min_salary" type="number" name="min_salary"
                                        placeholder="{{ __('min_salary') }}"
                                        class="form-control @error('min_salary') is-invalid @enderror"
                                        value="{{ old('min_salary') }}">
                                    @error('min_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="max_salary">
                                        {{ __('max_salary') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <input id="max_salary" type="number" name="max_salary"
                                        placeholder="{{ __('max_salary') }}"
                                        class="form-control @error('max_salary') is-invalid @enderror"
                                        value="{{ old('max_salary') }}">
                                    @error('max_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('applicant_options') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-12">
                                    <x-forms.label name="receive_applications" for="apply_on" :required="true" />
                                    <select name="apply_on" class="form-control @error('apply_on') is-invalid @enderror"
                                        id="apply_on">
                                        <option {{ old('apply_on') ? '' : 'selected' }} value="" class="d-none">
                                            {{ __('select_one') }}</option>
                                        <option {{ old('apply_on') == 'app' ? 'selected' : '' }} value="app"
                                            selected>
                                            {{ __('on_our_platform') }}</option>
                                        <option {{ old('apply_on') == 'email' ? 'selected' : '' }} value="email">
                                            {{ __('on_your_email_address') }}</option>
                                        <option {{ old('apply_on') == 'custom_url' ? 'selected' : '' }}
                                            value="custom_url">
                                            {{ __('on_a_custom_url') }}</option>
                                    </select>
                                    @error('apply_on')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-12 d-none mt-2" id="apply_email_div">
                                    <x-forms.label name="apply_email" for="apply_email" :required="true" />
                                    <input id="apply_email" type="email" name="apply_email"
                                        placeholder="{{ __('apply_email') }}"
                                        class="form-control @error('apply_email') is-invalid @enderror">
                                    @error('apply_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-12 d-none mt-2" id="apply_url_div">
                                    <x-forms.label name="apply_url" for="apply_url" :required="true" />
                                    <input id="apply_url" type="url" name="apply_url"
                                        placeholder="{{ __('apply_url') }}"
                                        class="form-control @error('apply_url') is-invalid @enderror">
                                    @error('apply_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('others') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row p-4">
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="featured" name="badge" type="radio" class="form-check-input"
                                            id="featured" {{ old('badge') == 'featured' ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5"
                                            for="featured">{{ __('featured') }}</label>
                                    </div>
                                    @error('featured')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="highlight" name="badge" type="radio" class="form-check-input"
                                            id="highlight" {{ old('badge') == 'highlight' ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5"
                                            for="highlight">{{ __('highlight') }}</label>
                                    </div>
                                    @error('highlight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="1" name="is_remote" type="checkbox" class="form-check-input"
                                            id="is_remote" {{ old('is_remote') ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5" for="is_remote">{{ __('remote') }}</label>
                                    </div>
                                    @error('is_remote')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('description') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="experience">
                                        {{ __('experience') }} <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <select name="experience"
                                        class="form-control select2bs4 @error('experience') is-invalid @enderror"
                                        id="experience">
                                        <option value=""> {{ __('experience') }}</option>
                                        @foreach ($experiences as $experience)
                                            <option {{ $experience->id == old('experience_id') ? 'selected' : '' }}
                                                value="{{ $experience->id }}"> {{ $experience->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('experience')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="role_id">
                                        {{ __('job_role') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="role_id"
                                        class="form-control select2bs4 @error('role_id') is-invalid @enderror"
                                        id="role_id">
                                        <option value=""> {{ __('job_role') }}</option>
                                        @foreach ($job_roles as $role)
                                            <option {{ $role->id == old('role_id') ? 'selected' : '' }}
                                                value="{{ $role->id }}">
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="education">
                                        {{ __('education') }} <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <select id="education" name="education"
                                        class="form-control select2bs4 @error('education') is-invalid @enderror">
                                        <option value=""> {{ __('education') }}</option>
                                        @foreach ($educations as $education)
                                            <option {{ $education->id == old('education') ? 'selected' : '' }}
                                                value="{{ $education->id }}">{{ $education->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('education')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="job_type">
                                        {{ __('job_type') }}
                                    </label>
                                    <select name="job_type"
                                        class="form-control select2bs4 @error('job_type') is-invalid @enderror"
                                        id="job_type">
                                        @foreach ($job_types as $job_type)
                                            <option {{ $job_type->id == old('job_type') ? 'selected' : '' }}
                                                value="{{ $job_type->id }}">{{ $job_type->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('job_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="description" class="pt-2">{{ __('description') }}<span
                                            class="text-red font-weight-bold">*</span></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="10">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
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
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <!-- Custom Script -->
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //init datepicker
        $(document).ready(function() {
            var dateToday = new Date();
            $('#deadline').datepicker({
                format: "yyyy-mm-dd",
                minDate: dateToday,
                startDate: dateToday,
                todayHighlight: true,
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tags').select2({
                theme: 'bootstrap4',
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });

        // condidtion based apply on show hide
        $('#apply_on').on('change', function() {
            var applyOn = $('#apply_on').val();
            var applyEmail = $('#apply_email_div');
            var applyUrl = $('#apply_url_div');
            applyOn == 'email' ? applyEmail.removeClass("d-none") : applyEmail.addClass("d-none");
            applyOn == 'custom_url' ? applyUrl.removeClass("d-none") : applyUrl.addClass("d-none");
        });

        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    @include('map::set-googlemap')
    @include('map::set-mapbox')
@endsection
