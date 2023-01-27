@extends('admin.layouts.app')
@section('title')
    {{ __('create') }}
@endsection
@section('content')
    @if (userCan('plan.create'))
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                            <a href="{{ route('module.plan.index') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('module.plan.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="label">{{ __('label') }} <small
                                                    class="text-danger">*</small></label>
                                            <input type="text" id="label" name="label" value="{{ old('label') }}"
                                                class="form-control @error('label') is-invalid @enderror"
                                                placeholder="{{ __('basic_standard_premium') }}">
                                            @error('label')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="price">{{ __('price') }}
                                                {{ defaultCurrencySymbol() }}<small
                                                    class="text-danger">*</small></label>
                                            <input type="number" id="price" name="price" value="{{ old('price') }}"
                                                class="form-control @error('price') is-invalid @enderror"
                                                placeholder="{{ __('10') }}{{ defaultCurrencySymbol() }}">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="job_limit">{{ __('job_limit') }} <small
                                                    class="text-danger">*</small></label>
                                            <input type="number" id="job_limit" name="job_limit"
                                                value="{{ old('job_limit') }}"
                                                class="form-control @error('job_limit') is-invalid @enderror"
                                                placeholder="{{ __('enter') }} {{ __('job_limit') }}">
                                            @error('job_limit')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="featured_job_limit">{{ __('featured_job_limit') }} <small
                                                    class="text-danger">*</small></label>
                                            <input type="number" id="featured_job_limit" name="featured_job_limit"
                                                value="{{ old('featured_job_limit') }}"
                                                class="form-control @error('featured_job_limit') is-invalid @enderror"
                                                placeholder="{{ __('enter') }} {{ __('featured_job_limit') }}">
                                            @error('featured_job_limit')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="highlight_job_limit">{{ __('highlight_job_limit') }} <small
                                                    class="text-danger">*</small></label>
                                            <input type="number" id="highlight_job_limit" name="highlight_job_limit"
                                                value="{{ old('highlight_job_limit') }}"
                                                class="form-control @error('highlight_job_limit') is-invalid @enderror"
                                                placeholder="{{ __('enter') }} {{ __('highlight_job_limit') }}">
                                            @error('highlight_job_limit')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="candidate_cv_preview_limit">{{ __('candidate_cv_preview_limit') }}
                                                <small class="text-danger">*</small></label>
                                            <input type="number" id="candidate_cv_preview_limit"
                                                name="candidate_cv_view_limit"
                                                value="{{ old('candidate_cv_view_limit') }}"
                                                class="form-control @error('candidate_cv_view_limit') is-invalid @enderror"
                                                placeholder="{{ __('enter') }} {{ __('candidate_cv_preview_limit') }}">
                                            @error('candidate_cv_view_limit')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="frontend_show">{{ __('show_frontend') }}</label>
                                            <select name="frontend_show" id="frontend_show"
                                                class="form-control @error('frontend_show') is-invalid @enderror">
                                                <option value="1">{{ __('yes') }}</option>
                                                <option value="0">{{ __('no') }}</option>
                                            </select>
                                            @error('frontend_show')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="description">{{ __('description') }}
                                                <small class="text-danger">*</small></label>
                                            <textarea name="description" placeholder="{{ __('enter') }} {{ __('description') }}" value="{{ old('description') }}"
                                                class="form-control @error('description') is-invalid @enderror"
                                                id="description" cols="1" rows="4"></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <button class="btn btn-success" type="submit"><i
                                            class="fas fa-plus"></i>&nbsp; {{ __('create') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
