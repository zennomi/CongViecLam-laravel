@props(['countries', 'user', 'organizationTypes', 'industryTypes', 'teamSizes', 'nationalities'])

<form action="{{ route('company.profile.complete', auth()->user()->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="field" value="profile">
    <fieldset>
        <div class="form-card mb-4">
            <div class="dashboard-account-setting-item pb-0">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label class="body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('organization_type') }}
                            <x-forms.required />
                        </label>
                        <select name="organization_type_id"
                            class="select2-taggable @error('organization_type_id') is-invalid @enderror w-100-p"
                            id="organization_type_id">
                            @foreach ($organizationTypes as $type)
                                <option
                                    {{ $type->id == old('organization_type_id', $user->company->organization_type_id) ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('organization_type_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="body-font-4 d-block text-gray-900 rt-mb-8">{{ __('industry_type') }}
                            <x-forms.required />
                        </label>
                        <select type="text"
                            class="select2-taggable @error('industry_type_id') is-invalid @enderror w-100-p text-uppercase"
                            name="industry_type_id" id="industry_type">
                            @foreach ($industryTypes as $type)
                                <option
                                    {{ $type->id == old('industry_type_id', $user->company->industry_type_id) ? 'selected' : '' }}
                                    value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('industry_type_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ __($message) }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('team_size') }}
                        </label>
                        <select type="text" name="team_size_id"
                            class="rt-selectactive @error('team_size_id') is-invalid @enderror w-100-p" id="team_size">
                            <option value="" >{{ __('select_one') }}</option>
                            @foreach ($teamSizes as $size)
                                <option
                                    {{ $size->id == old('team_size_id', $user->company->team_size_id) ? 'selected' : '' }}
                                    value="{{ $size->id }}">
                                    {{ $size->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('team_size_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ __($message) }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('website') }}
                        </label>
                        <div class="fromGroup has-icon2">
                            <div class="form-control-icon">
                                <input name="website" class="form-control @error('website') is-invalid @enderror"
                                    type="url" placeholder="{{ __('website') }}"
                                    value="{{ old('website', $user->company->website) }}">
                                <div class="icon-badge-2">
                                    <x-svg.link-icon />
                                </div>
                            </div>
                        </div>
                        @error('website')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('year_of_establishment') }}
                        </label>
                        <div class="fromGroup">
                            <div class="form-control-icon date datepicker">
                                <input name="establishment_date" placeholder="m/d/y" type="text"
                                    class="form-control @error('establishment_date') is-invalid @enderror"
                                    id="date"
                                    value="{{ $user->company->establishment_date ? date('d-m-Y', strtotime($user->company->establishment_date)) : old('establishment_date') }}" />
                                <span class="input-group-addon has-badge">
                                    <x-svg.calendar-icon />
                                </span>
                                @error('establishment_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __($message) }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('company_vision') }}
                            <x-forms.required />
                        </label>
                        <textarea id="default" name="vision" class="ckeditor @error('vision') is-invalid @enderror"
                            placeholder="{{ __('company_vision') }}">{{ old('vision', $user->company->vision) }}</textarea>
                        @error('vision')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('company/account-progress') }}">
            <button type="button" class="btn previous bg-gray-50 rt-mr-8">
                {{ __('previous') }}
            </button>
        </a>
        <button type="submit" class="btn next btn-primary">
            <span class="button-content-wrapper ">
                <span class="button-icon align-icon-right">
                    <i class="ph-arrow-right"></i>
                </span>
                <span class="button-text">
                    {{ __('save_next') }}
                </span>
            </span>
        </button>
    </fieldset>
</form>

@push('frontend_scripts')
    <script src="{{ asset('frontend') }}/assets/js/ckeditor.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#default'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
