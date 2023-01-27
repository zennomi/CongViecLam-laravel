@props(['socials'])

<form action="{{ route('company.profile.complete', auth()->user()->id) }}" method="post">
    @method('PUT')
    @csrf
    <input type="hidden" name="field" value="social">
    <fieldset>
        <div class="form-card mb-4">
            <div class="dashboard-account-setting-item">
                <div class="row">
                    @forelse($socials as $social)
                    <div class="col-12 custom-select-padding">
                        <div class="d-flex">
                            <div class="d-flex mborder">
                                <div class="position-relative">
                                    <select
                                        class="w-100-p border-0 rt-selectactive form-control" name="social_media[]">
                                        <option value="" class="d-none" disabled>{{ __('select_one') }}</option>
                                        <option {{ $social->social_media == 'facebook' ? 'selected':''}} value="facebook">{{ __('facebook') }}</option>
                                        <option {{ $social->social_media == 'twitter' ? 'selected':''}} value="twitter">{{ __('twitter') }}</option>
                                        <option {{ $social->social_media == 'instagram' ? 'selected':''}} value="instagram">{{ __('instagram') }}</option>
                                        <option {{ $social->social_media == 'youtube' ? 'selected':''}} value="youtube">{{ __('youtube') }}</option>
                                        <option {{ $social->social_media == 'linkedin' ? 'selected':''}} value="linkedin">{{ __('linkedin') }}</option>
                                        <option {{ $social->social_media == 'pinterest' ? 'selected':''}} value="pinterest">{{ __('pinterest') }}</option>
                                        <option {{ $social->social_media == 'reddit' ? 'selected':''}} value="reddit">{{ __('reddit') }}</option>
                                        <option {{ $social->social_media == 'github' ? 'selected':''}} value="github">{{ __('github') }}</option>
                                        <option {{ $social->social_media == 'other' ? 'selected':''}} value="other">{{ __('other') }}</option>
                                    </select>
                                </div>
                                <div class="w-100">
                                    <input class="border-0" type="url" name="url[]" id="" placeholder="{{ __('profile_link_url') }}..." value="{{ $social->url }}">
                                </div>
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-primary2-50 cross-btn" type="button" id="remove_item">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#18191C" stroke-width="1.5" stroke-miterlimit="10"/>
                                        <path d="M15 9L9 15" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 15L9 9" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 custom-select-padding">
                        <div class="d-flex">
                            <div class="d-flex mborder">
                                <div class="position-relative">
                                    <select
                                        class="w-100-p border-0 rt-selectactive form-control" name="social_media[]">
                                        <option value="" class="d-none" disabled selected>{{ __('select_one') }}</option>
                                        <option value="facebook">{{ __('facebook') }}</option>
                                        <option value="twitter">{{ __('twitter') }}</option>
                                        <option value="instagram">{{ __('instagram') }}</option>
                                        <option value="youtube">{{ __('youtube') }}</option>
                                        <option value="linkedin">{{ __('linkedin') }}</option>
                                        <option value="pinterest">{{ __('pinterest') }}</option>
                                        <option value="reddit">{{ __('reddit') }}</option>
                                        <option value="github">{{ __('github') }}</option>
                                        <option value="other">{{ __('other') }}</option>
                                    </select>
                                </div>
                                <div class="w-100">
                                    <input class="border-0" type="url" name="url[]" id="" placeholder="{{ __('profile_link_url') }}...">
                                </div>
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-primary2-50 cross-btn" type="button" id="remove_item">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#18191C" stroke-width="1.5" stroke-miterlimit="10"/>
                                        <path d="M15 9L9 15" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 15L9 9" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforelse
                    <div id="multiple_feature_part">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary2-50 w-100 mt-4 add-new-social" onclick="add_features_field()" type="button">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z" stroke="#18191C" stroke-width="1.5" stroke-miterlimit="10"/>
                                <path d="M6.875 10H13.125" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 6.875V13.125" stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            <span>{{ __('add_new_social_link') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('company/account-progress?profile') }}">
            <button type="button" class="btn previous bg-gray-50 rt-mr-8">
                Previous
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
