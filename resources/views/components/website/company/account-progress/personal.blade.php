@props(['user'])

<form action="{{ route('company.profile.complete', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="field" value="personal">
    <fieldset>
        <div class="form-card">
            <div class="personal-profile-picture-wrap">
                <div class="company-logo-banner-info">
                    <h6>{{ __('logo_banner_image') }}</h6>
                    <div class="row">
                         <x-website.company.photo-section :user="$user" />
                        <x-website.company.banner-section :user="$user" />
                    </div>
                </div>
            </div>

            <div class="dashboard-account-setting-item">
                <h6>{{ __('company_information') }}</h6>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="pointer body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('company_name') }}
                        </label>
                        <div class="fromGroup">
                            <div class="form-control-icon">
                                <input class="form-control" type="text"
                                    name="name" value="{{ $user->name ?? old('name') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="body-font-4 d-block text-gray-900 rt-mb-8">
                            {{ __('biography') }}
                            <x-forms.required />
                        </label>
                        <textarea rows="8" class="form-control  @error('bio') is-invalid @enderror" name="bio"
                            placeholder="{{ __('biography') }}">{{ $user->company->bio ?? old('bio') }}</textarea>
                        @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ __($message) }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn next btn-primary">
            {{ __('save_next') }}
        </button>
    </fieldset>
</form>
