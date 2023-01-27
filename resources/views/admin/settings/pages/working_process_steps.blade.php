@extends('admin.settings.setting-layout')

@section('title')
    {{ __('working_process_setup') }}
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
                <li class="breadcrumb-item active">{{ __('working_process_setup') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ __('working_process_setup') }}</div>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('settings.working.process.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="working_step_1"> {{ __('step_1_title') }}
                                <x-forms.required />
                            </label>
                            <input value="{{ $working_process->working_process_step1_title }}"
                                name="working_process_step1_title" type="text"
                                class="form-control @error('working_process_step1_title') is-invalid @enderror"
                                placeholder="{{ __('step_1_title') }}" id="working_step_1">
                            @error('working_process_step1_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('step_1_description') }}
                                <x-forms.required />:
                            </label>
                            <textarea class="form-control p-2 @error('working_process_step1_description') is-invalid @enderror" rows="5"
                                name="working_process_step1_description"
                                placeholder="{{ __('step_1_description') }}">{{ $working_process->working_process_step1_description }}</textarea>
                            @error('working_process_step1_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="working_step_2"> {{ __('step_2_title') }}
                                <x-forms.required />
                            </label>
                            <input value="{{ $working_process->working_process_step2_title }}"
                                name="working_process_step2_title" type="text"
                                class="form-control @error('working_process_step2_title') is-invalid @enderror"
                                placeholder="{{ __('step_2_title') }}" id="working_step_2">
                            @error('working_process_step2_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('step_2_description') }}
                                <x-forms.required />:
                            </label>
                            <textarea class="form-control p-2 @error('working_process_step2_description') is-invalid @enderror" rows="5"
                                name="working_process_step2_description"
                                placeholder="{{ __('step_2_description') }}">{{ $working_process->working_process_step2_description }}</textarea>
                            @error('working_process_step2_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="working_step_3"> {{ __('step_3_title') }}
                                <x-forms.required />
                            </label>
                            <input value="{{ $working_process->working_process_step3_title }}"
                                name="working_process_step3_title" type="text"
                                class="form-control @error('working_process_step3_title') is-invalid @enderror"
                                placeholder="{{ __('step_3_title') }}" id="working_step_3">
                            @error('working_process_step3_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('step_3_description') }}
                                <x-forms.required />:
                            </label>
                            <textarea class="form-control p-2 @error('working_process_step3_description') is-invalid @enderror" rows="5"
                                name="working_process_step3_description"
                                placeholder="{{ __('step_3_description') }}">{{ $working_process->working_process_step3_description }}</textarea>
                            @error('working_process_step3_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="working_step_4"> {{ __('step_4_title') }}
                                <x-forms.required />
                            </label>
                            <input value="{{ $working_process->working_process_step4_title }}"
                                name="working_process_step4_title" type="text"
                                class="form-control @error('working_process_step4_title') is-invalid @enderror"
                                placeholder="{{ __('step_4_title') }}" id="working_step_2">
                            @error('working_process_step4_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('step_4_description') }}
                                <x-forms.required />:
                            </label>
                            <textarea class="form-control p-2 @error('working_process_step4_description') is-invalid @enderror" rows="5"
                                name="working_process_step4_description"
                                placeholder="{{ __('step_4_description') }}">{{ $working_process->working_process_step4_description }}</textarea>
                            @error('working_process_step4_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mx-auto d-flex justify-content-center">
                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                        {{ __('update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
