@extends('website.layouts.app')

@section('title')
{{ __('settings') }}
@endsection
@section('main')
<div class="dashboard-wrapper">
    <div class="container">
        <div class="row">
            <x-website.candidate.sidebar />
            <div class="col-lg-9">
                <div class="dashboard-right">
                    <div class="dashboard-right-header rt-mb-32">
                        <div class="left-text m-0">
                            <h3 class="f-size-18 lh-1 m-0">{{ __('settings') }}</h3>
                        </div>
                        <span class="sidebar-open-nav">
                            <i class="ph-list"></i>
                        </span>
                    </div>
                    <div class="cadidate-dashboard-tabs">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ !session('type') || session('type') == 'basic' ? 'active' : '' }}"
                                    id="pills-personal-tab" data-bs-toggle="pill" data-bs-target="#pills-personal"
                                    type="button" role="tab" aria-controls="pills-personal" aria-selected="true">
                                    <x-svg.user-icon />
                                    {{ __('basic') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('type') == 'profile' ? 'active' : '' }}"
                                    id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                                    type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    <x-svg.user-round-icon />
                                    {{ __('profile') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ session('type') == 'social' ? 'active' : '' }}"
                                    id="pills-social-tab" data-bs-toggle="pill" data-bs-target="#pills-social"
                                    type="button" role="tab" aria-controls="pills-social" aria-selected="false">
                                    <x-svg.globe2-icon />
                                    {{ __('social_media') }}
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ session('type') == 'alert' || session('type') == 'contact' || session('type') == 'visibility' || session('type') == 'password' || session('type') == 'account-delete' ? 'active' : '' }} @error('password') active @enderror "
                                    id="pills-setting-tab" data-bs-toggle="pill" data-bs-target="#pills-setting"
                                    type="button" role="tab" aria-controls="pills-setting" aria-selected="false">
                                    <x-svg.cog-icon />
                                    {{ __('account_setting') }}
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade {{ !session('type') || session('type') == 'basic' ? 'show active' : '' }}"
                                id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab">
                                <form action="{{ route('candidate.settingUpdate') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="type" value="basic">
                                    <div class="dashboard-account-setting-item">
                                        <h6> {{ __('basic_information') }}</h6>
                                        <div class="row">
                                            <div class="col-lg-4">
                                               <x-website.candidate.photo-section :candidate="$candidate" />
                                            </div>
                                            <div class="row col-lg-8">
                                                <div class="col-lg-6 mb-3">
                                                    <x-forms.label :required="true" name="full_name"
                                                        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                    <div class="fromGroup">
                                                        <div class="form-control-icon">
                                                            <x-forms.input type="text" name="name"
                                                                value="{{ $candidate->user->name }}"
                                                                placeholder="{{ __('name') }}" class="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <x-forms.label :required="false" name="professional_title_tagline"
                                                        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                    <div class="fromGroup">
                                                        <div class="form-control-icon">
                                                            <x-forms.input type="text" name="title"
                                                                value="{{ $candidate->title }}"
                                                                placeholder="{{ _('title') }}" class="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <x-forms.label :required="true" name="experience"
                                                        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                    <select name="experience" class="select2-taggable w-100-p">
                                                        @foreach ($experiences as $experience)
                                                        <option
                                                            {{ $candidate->experience_id == $experience->id ? 'selected' : '' }}
                                                            value="{{ $experience->id }}">{{ $experience->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('experience')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <x-forms.label :required="true" name="education"
                                                        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                    <select name="education" class="select2-taggable w-100-p">
                                                        @foreach ($educations as $education)
                                                        <option
                                                            {{ $candidate->education_id == $education->id ? 'selected' : '' }}
                                                            value="{{ $education->id }}">{{ $education->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('education')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <x-forms.label :required="false" name="personal_website"
                                                        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                    <div class="fromGroup has-icon2">
                                                        <div class="form-control-icon">
                                                            <x-forms.input type="url" name="website"
                                                                value="{{ $candidate->website }}"
                                                                placeholder="{{ __('website') }}" class="" />
                                                            <div class="icon-badge-2">
                                                                <x-svg.link-icon />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mt-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('save_changes') }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                        <h6 class="resume">{{ __('your_cv_resume') }}</h6>
                                        @if ($errors->has('resume_name') || $errors->has('resume_file'))
                                            <div class="alert alert-danger" role="alert">
                                                @error('resume_name')
                                                    <span class="d-block"><strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('resume_file')
                                                    <span class="d-block"><strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                </form>
                                <div class="resume-lists">
                                    @foreach ($resumes as $resume)
                                        <div class="resume-item">
                                            <div class="resume-icon">
                                                <x-svg.file-icon2/>
                                            </div>
                                            <div>
                                                <h4 class="resume-title">{{ $resume->name }}</h4>
                                                <h6 class="resume-size">{{ $resume->file_size }}</h6>
                                            </div>
                                            <div class="dot-icon ms-auto">
                                                <button type="button" class="btn p-0" id="dropdownMenuButton5"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <x-svg.three-dots/>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                                    aria-labelledby="dropdownMenuButton5">
                                                    <li>
                                                        <button onclick="editResume({{ $resume->id }},'{{ $resume->name }}', '{{ $resume->file_size }}')" type="button" class="dropdown-item">
                                                            <x-svg.pen-edit/>
                                                            {{ __('edit') }}
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('candidate.resume.delete', $resume->id) }}"
                                                        method="POST" id="resumeForm">
                                                            @csrf
                                                            @method("DELETE")
                                                            <button type="button" onclick="resumeDelete()" class="dropdown-item">
                                                                <x-svg.trash-icon />
                                                                {{ __('delete') }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="resume-item add-resume" data-bs-toggle="modal"
                                        data-bs-target="#resumeModal">
                                        <div class="resume-icon">
                                            <x-svg.plus-icon />
                                        </div>
                                        <div>
                                            <h4 class="resume-title">{{ __('add_cv_resume') }}</h4>
                                            <h6 class="resume-size">{{ __('browse_file_here_only') }} - pdf</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ session('type') == 'profile' ? 'show active' : '' }}"
                                id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <form action="{{ route('candidate.settingUpdate') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="dashboard-account-setting-item pb-0">
                                        <input type="hidden" name="type" value="profile">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="true" name="nationality"
                                                    class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <select name="nationality" class="rt-selectactive w-100">
                                                    @foreach ($nationalities as $nationality)
                                                    <option
                                                        {{ $candidate->nationality_id == $nationality->id ? 'selected' : '' }}
                                                        value="{{ $nationality->id }}">
                                                        {{ $nationality->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="true" name="gender"
                                                    class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <select
                                                    class="rt-selectactive w-100-p @error('gender') is-invalid @enderror"
                                                    name="gender">
                                                    <option @if ($candidate->gender == 'male') selected @endif
                                                        value="male">
                                                        {{ __('male') }}
                                                    </option>
                                                    <option @if ($candidate->gender == 'female') selected @endif
                                                        value="female">
                                                        {{ __('female') }}
                                                    </option>
                                                    <option @if ($candidate->gender == 'other') selected @endif
                                                        value="other">
                                                        {{ __('other') }}
                                                    </option>
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback"
                                                        role="alert">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="true" name="marital_status"
                                                    class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <select name="marital_status" class="rt-selectactive w-100-p">
                                                    <option @if ($candidate->marital_status == 'married') selected @endif
                                                        value="married">{{ __('married') }}</option>
                                                    <option @if ($candidate->marital_status == 'single') selected @endif
                                                        value="single">{{ __('single') }}</option>
                                                </select>
                                                @error('marital_status')
                                                    <span class="invalid-feedback"
                                                        role="alert">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="true" name="profession"
                                                    class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <select name="profession" class="select2-taggable w-100-p">
                                                    @foreach ($professions as $profession)
                                                        <option
                                                            {{ $candidate->profession_id == $profession->id ? 'selected' : '' }}
                                                            value="{{ $profession->id }}">{{ $profession->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('profession')
                                                    <span class="invalid-feedback"
                                                        role="alert">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="true" name="date_of_birth"  class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <div class="fromGroup">
                                                    <div class="d-flex align-items-center form-control-icon date datepicker">
                                                        <input type="text" name="birth_date"
                                                                value="{{ $candidate->birth_date ? date('d-m-Y', strtotime($candidate->birth_date)) : old('birth_date') }}"
                                                                id="date" placeholder="dd/mm/yyyy"
                                                                class="form-control border-cutom @error('birth_date') is-invalid @enderror" />
                                                        <span class="input-group-addon input-group-text-custom">
                                                            <x-svg.calendar-icon />
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-3">
                                                <x-forms.label :required="false" name="biography"
                                                    class="body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <textarea name="bio" id="default">{!! $candidate->bio !!}</textarea>
                                                @error('bio')
                                                    <span class="text-danger">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12 mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('save_changes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade {{ session('type') == 'social' ? 'show active' : '' }}"
                                id="pills-social" role="tabpanel" aria-labelledby="pills-social-tab">
                                <div class="dashboard-account-setting-item">
                                    <form action="{{ route('candidate.settingUpdate') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="type" value="social">
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
                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ __('save_changes') }}
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane fade {{ session('type') == 'alert' || session('type') == 'contact' || session('type') == 'visibility' || session('type') == 'password' || session('type') == 'account-delete' ? 'show active' : '' }} {{ error('password', 'show active') }}"
                                id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
                                <form action="{{ route('candidate.settingUpdate') }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="type" value="contact">
                                    <div class="dashboard-account-setting-item pb-0">
                                        <h6>{{ __('locations') }}</h6>
                                        <div class="row">
                                            <div class="col-lg-12 mb-3">
                                                <x-website.map.map-warning/>
                                                @php
                                                $map = setting('default_map');
                                                @endphp
                                                <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}"
                                                    id="map-box">
                                                </div>
                                                <div id="google-map-div"
                                                    class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                                    <input id="searchInput" class="mapClass" type="text"
                                                        placeholder="Enter a location">
                                                    <div class="map mymap" id="google-map"></div>
                                                </div>
                                                @error('location')
                                                <span class="ml-3 text-md text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-account-setting-item">
                                        <h6>{{ __('phone_email') }}</h6>
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="false" name="phone"
                                                    class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <x-forms.input type="text" name="phone" value="{{ $contact->phone }}"
                                                    id="phone" placeholder="{{ __('phone') }}" class="phonecode" />
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="false" name="secondary_phone"
                                                    class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <x-forms.input type="text" name="secondary_phone"
                                                    value="{{ $contact->secondary_phone }}" id="phone2"
                                                    placeholder="{{ __('phone') }}" class="phonecode" />
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <x-forms.label :required="false" name="email"
                                                    class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                                                <div class="fromGroup has-icon2">
                                                    <div class="form-control-icon">
                                                        <x-forms.input type="email" name="email"
                                                            value="{{ $contact->email }}" id=""
                                                            placeholder="{{ __('email_address') }}" class="" />
                                                        <div class="icon-badge-2">
                                                            <x-svg.envelope-icon/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4">
                                            {{ __('save_changes') }}
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="dashboard-account-setting-item setting-border">
                                    {{-- <h6>{{ __('notification') }}</h6> --}}
                                    <form id="alert" action="{{ route('candidate.settingUpdate') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        {{-- <input type="hidden" name="type" value="alert">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-check from-chekbox-custom rt-mb-15">
                                                    <input name="shortlisted" class="form-check-input" type="checkbox"
                                                        value="1" id="check1"
                                                        {{ auth()->user()->shortlisted_alert ? 'checked' : '' }}>
                                                    <x-forms.label for="check1" :required="false"
                                                        name="notify_me_when_employers_shortlisted_me"
                                                        class="form-check-label pointer f-size-14" />
                                                </div>
                                                <div class="form-check from-chekbox-custom rt-mb-15">
                                                    <input name="job_expired" class="form-check-input" type="checkbox"
                                                        value="1" id="check2"
                                                        {{ auth()->user()->job_expired_alert ? 'checked' : '' }}>
                                                    <x-forms.label for="check2" :required="false"
                                                        name="notify_me_when_my_applied_jobs_are_expire"
                                                        class="form-check-label pointer f-size-14" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-check from-chekbox-custom">
                                                    <input name="recent_activity" class="form-check-input"
                                                        type="checkbox" value="1" id="check3"
                                                        {{ auth()->user()->recent_activities_alert ? 'checked' : '' }}>
                                                    <x-forms.label for="check3" :required="false"
                                                        name="notify_me_my_recent_activities"
                                                        class="form-check-label pointer f-size-14" />
                                                </div>
                                                <div class="form-check from-chekbox-custom">
                                                    <input name="new_job" class="form-check-input" type="checkbox"
                                                        value="1" id="check3"
                                                        {{ auth()->user()->new_job_alert ? 'checked' : '' }}>
                                                    <x-forms.label for="check3" :required="false"
                                                        name="notify_me_when_new_job_published"
                                                        class="form-check-label pointer f-size-14" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr> --}}
                                        <div class="row">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>{{ __('job_alert') }}</h6>
                                                <div class="input-group-text bg-transparent border-0" id="basic-addon1">
                                                    <div class="form-check form-switch">
                                                        <input type="hidden" value="0" name="received_job_alert">
                                                        <input name="received_job_alert" class="form-check-input"
                                                            type="checkbox" id="flexSwitchCheckDefault" value="1"
                                                            {{ $candidate->received_job_alert ? 'checked' : '' }}>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 ">
                                                <x-forms.label :required="false" name="job_role"
                                                    class="f-size-14 text-gray-700 rt-mb-6" />
                                                <div class="fromGroup has-icon2">
                                                    <div class="form-control-icon">
                                                        <select name="role_id" id="job_role">
                                                            @foreach ($job_roles as $job_role)
                                                            <option value="{{ $job_role->id }}" @if ($job_role->id ==
                                                                $candidate->role_id) selected @endif>
                                                                {{ $job_role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <br>
                                                        <p>
                                                            {{ __('note_you_will_be_notified_for_this_role_only') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('save_changes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="dashboard-account-setting-item setting-border">
                                    <form id="visibility" action="{{ route('candidate.settingUpdate') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="type" value="visibility">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label
                                                    class="text-gray-900 rt-mb-15 fw-medium">{{ __('profile_privacy') }}</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text bg-transparent border border-gray-50 extra-design"
                                                        id="basic-addon1">
                                                        <div class="form-check form-switch">
                                                            <input name="profile_visibility" class="form-check-input"
                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                {{ $candidate->visibility ? 'checked' : '' }}>
                                                            <span
                                                                class="form-check-label f-size-14">{{ __('yes') }}</span>
                                                        </div>
                                                    </div>
                                                    <input disabled type="text" class="form-control"
                                                        placeholder="Your profile is {{ $candidate->visibility ? 'public' : 'private' }} now"
                                                        id="msalary">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-forms.label :required="false" name="resume_privacy"
                                                    class="text-gray-900 rt-mb-15 fw-medium" />
                                                <div class="input-group mb-3">
                                                    <div class="input-group-text bg-transparent border border-gray-50 extra-design"
                                                        id="basic-addon1">
                                                        <div class="form-check form-switch">
                                                            <input name="cv_visibility" class="form-check-input"
                                                                type="checkbox" id="flexSwitchCheckDefault"
                                                                {{ $candidate->cv_visibility ? 'checked' : '' }}>
                                                            <span
                                                                class="form-check-label f-size-14">{{ __('yes') }}</span>
                                                        </div>
                                                    </div>
                                                    <input disabled type="text" class="form-control"
                                                        placeholder="Your resume is {{ $candidate->cv_visibility ? 'public' : 'private' }} now"
                                                        id="msalary">
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="dashboard-account-setting-item setting-border">
                                    <h6>{{ __('change_password') }}</h6>
                                    <form action="{{ route('candidate.settingUpdate') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="type" value="password">
                                        <div class="row">
                                            <div class="col-lg-6 rt-mb-32">
                                                <x-forms.label :required="true" name="new_password"
                                                    class="f-size-14 text-gray-700 rt-mb-6" />
                                                <div class="fromGroup rt-mb-15">
                                                    <div class="d-flex">
                                                        <input name="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password-hide_show" type="password"
                                                            placeholder="{{ __('password') }}" required>
                                                        <div
                                                            class="has-badge @error('password') has-badge-cutom @enderror">
                                                            <i class="ph-eye @error('password') m-3 @enderror"></i>
                                                        </div>
                                                    </div>
                                                    @error('password')
                                                    <span role="alert" class="text-danger">{{ __($message) }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6 rt-mb-32">
                                                <x-forms.label :required="true" name="confirm_password"
                                                    class="f-size-14 text-gray-700 rt-mb-6" />
                                                <div class="fromGroup rt-mb-15">
                                                    <input name="password_confirmation"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password-hide_show1" type="password"
                                                        placeholder="{{ __('confirm_password') }}" required>
                                                    <div
                                                        class="has-badge @error('password') has-badge-cutom @enderror select-icon__one">
                                                        <i class="ph-eye"></i>
                                                    </div>
                                                    @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('save_changes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="dashboard-account-setting-item setting-border">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4>{{ __('close_delete_account') }}</h4>
                                            <p>{{ __('account_delete_msg') }}</p>
                                            <form action="{{ route('candidate.settingUpdate') }}" id="AccountDelete"
                                                method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="type" value="account-delete">
                                                <button type="button" onclick="AccountDelete()"
                                                    class="btn p-0 text-danger-500">
                                                    <span class="button-content-wrapper ">
                                                        <span class="button-icon">
                                                            <i class="ph-x-circle"></i>
                                                        </span>
                                                        <span class="button-text">
                                                            {{ __('close_account') }}
                                                        </span>
                                                    </span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-footer text-center body-font-4 text-gray-500">
        <x-website.footer-copyright />
    </div>
</div>

{{-- Resume add modal --}}
<div class="modal fade" id="resumeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-transparent">
                <h5 class="modal-title" id="cvModalLabel">{{ __('add_cv_resume') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('candidate.resume.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="from-group py-2">
                        <x-forms.label name="cv_resume_name" :required="true" />
                        <input type="text" name="resume_name" id="">
                        @error('is_remote')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group py-2">
                        <x-forms.label name="upload_cv_resume"
                            class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                        <div class="cv-image-upload-wrap">
                            <input name="resume_file" class="resume-file-upload-input" type="file" onchange="resumeManageReadURL(this, 'add');" accept="application/pdf" id="resume_add_input"/>
                            <div class="drag-text">
                                <x-svg.upload-icon/>
                                <h3>{{ __('browse_file') }}</h3>
                                <p>{{ __('available_format') }} - PDF<br>
                                    {{ __('maximum_file_size') }} - 5 MB</p>
                            </div>
                        </div>
                        <div class="resume-file-upload-content none ">
                            <div class="wrap">
                                <x-svg.file-icon2 />
                                <h3 class="resume_selected_file_name">file</h3>
                                <p>
                                    <span><span class="resume_selected_file_size">2.3</span> MB</span> <br>
                                    <span class="resume_selected_file_type">.pdf</span>
                                </p>
                                <div class="image-title-wrap">
                                    <button type="button" class="cv-remove-image">
                                        <x-svg.trash-icon />
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="bg-priamry-50 btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="button-content-wrapper ">
                            <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                            <span class="button-text">
                                {{ __('add_cv_resume') }}
                            </span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Resume edit modal --}}
<div class="modal fade" id="resumeEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-transparent">
                <h5 class="modal-title" id="cvModalLabel">{{ __('update_cv_resume') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('candidate.resume.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="resume_id" id="resume_id_input">
                <div class="modal-body">
                    <div class="from-group py-2">
                        <x-forms.label name="cv_resume_name" :required="true" />
                        <input type="text" name="resume_name" id="resume_name_input">
                        @error('is_remote')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group py-2">
                        <x-forms.label name="upload_cv_resume"
                            class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
                        <div class="cv-image-upload-wrap" >
                            <input name="resume_file" class="resume-file-upload-input" type="file" onchange="resumeManageReadURL(this, 'edit');" accept="application/pdf" id="resume_edit_input"/>
                            <div class="drag-text">
                                <x-svg.upload-icon/>
                                <h3>{{ __('change_file') }}</h3>
                                <p>{{ __('current_resume_size') }}: <span id="resume_file_size"></span></p>
                            </div>
                        </div>
                        <div class="resume-file-upload-content none">
                            <div class="wrap">
                                <x-svg.file-icon2 />
                                <h3 class="resume_selected_file_name">file</h3>
                                <p>
                                    <span><span class="resume_selected_file_size">2.3</span> MB</span> <br>
                                    <span class="resume_selected_file_type">.pdf</span>
                                </p>
                                <div class="image-title-wrap">
                                    <button type="button" class="cv-remove-image">
                                        <x-svg.trash-icon />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-transparent">
                    <button type="button" class="bg-priamry-50 btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">{{ __('cancel') }}</button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span class="button-content-wrapper ">
                            <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                            <span class="button-text">
                                {{ __('update_cv_resume') }}
                            </span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('frontend_links')
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
        .w-100-percent {
            width: 100% !important;
        }
        #jobrole #basic-addon1 {
            width: 50px !important;
            margin-left: 28px !important;
        }
        .border-cutom {
            border-radius: 5px 0 0 5px !important;
        }
        .input-group-text-custom {
            max-height: 48px;
            padding: 12px;
            background-color: #e9ecef;
            border-radius: 0 5px 5px 0;
        }
        .has-badge-cutom {
            top: 34% !important;
        }
    </style>
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
    <style>
        .mymap {
            border-radius: 12px;
            z-index: 999;
        }
    </style>
@endsection

@section('frontend_scripts')
<script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('frontend') }}/assets/js/ckeditor.min.js"></script>
<script>
     function UploadMode(param){
        if(param === 'photo'){
            $('#photo-uploadMode').removeClass('d-none');
            $('#photo-oldMode').addClass('d-none');
        }else{
            $('#banner-uploadMode').removeClass('d-none');
            $('#banner-oldMode').addClass('d-none');
        }
    }
    //init datepicker
    $("#date").attr("autocomplete", "off");
    //init datepicker
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#default'))
        .catch(error => {
            console.error(error);
        });
    $('#visibility').on('change', function () {
        $(this).submit();
    });
    $('#alert').on('change', function () {
        $(this).submit();
    });
    function AccountDelete() {
        if (confirm("Are you sure ??") == true) {
            $('#AccountDelete').submit();
        } else {
            return false;
        }
    }
    function resumeDelete() {
        if (confirm("Are you sure ?") == true) {
            $('#resumeForm').submit();
        } else {
            return false;
        }
    }
    function editResume(id, name, size) {
        $('#resume_id_input').val(id);
        $('#resume_name_input').val(name);
        $('#resume_file_size').html(size);
        $('#resumeEditModal').modal('show');
    }
    $('.cv-remove-image').on('click', function(){
        $('.resume-file-upload-input').replaceWith($('.resume-file-upload-input').clone());
        $('.resume-file-upload-content').hide();
        $('.cv-image-upload-wrap').show();
        $('.resume-file-upload-input').val('');
    })
    function resumeManageReadURL(input, type) {
        if (type == 'add') {
            var fileName = document.querySelector('#resume_add_input').files[0].name;
            var fileSize = document.querySelector('#resume_add_input').files[0].size / 1024 / 1024;
            var fileType = document.querySelector('#resume_add_input').files[0].type;
        }else{
            var fileName = document.querySelector('#resume_edit_input').files[0].name;
            var fileSize = document.querySelector('#resume_edit_input').files[0].size / 1024 / 1024;
            var fileType = document.querySelector('#resume_edit_input').files[0].type;
        }
        $('.resume_selected_file_name').html(fileName);
        $('.resume_selected_file_size').html(fileSize.toFixed(4));
        $('.resume_selected_file_type').html(fileType);
        if (input.files && input.files[0]) {
            console.log(input.className)
            var reader = new FileReader();
            reader.onload = function (e) {
                if(input.className === 'profile-file-upload-input'){
                    $('.profile-image-upload-wrap').hide();
                    $('.profile-file-upload-image').attr('src', e.target.result);
                    $('.profile-file-upload-content').show();
                    // $('.image-title').html(input.files[0].name);
                }
                if(input.className === 'banner-file-upload-input'){
                    $('.banner-image-upload-wrap').hide();
                    $('.banner-file-upload-image').attr('src', e.target.result);
                    $('.banner-file-upload-content').show();
                    // $('.image-title').html(input.files[0].name);
                }
                if(input.className === 'resume-file-upload-input'){
                    $('.cv-image-upload-wrap').hide();
                    $('.resume-file-upload-content.none').show();
                }
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            $('.profile-remove-image').on('click', function(){
                console.log(this.className)
                $('.profile-file-upload-input').replaceWith($('.profile-file-upload-input').clone());
                $('.profile-file-upload-content').hide();
                $('.profile-file-upload-image').attr('src', '');
                $('.profile-image-upload-wrap').show();
            })
            $('.banner-remove-image').on('click', function(){
                console.log(this.className)
                $('.banner-file-upload-input').replaceWith($('.banner-file-upload-input').clone());
                $('.banner-file-upload-content').hide();
                $('.banner-file-upload-image').attr('src', '');
                $('.banner-image-upload-wrap').show();
            })
        }
    }
    setTimeout(function () {
        {{ session()-> forget('type') }}
    }, 10000);
</script>

<!-- >=>Mapbox<=< -->
@include('map::scripts')
<!--=============== map box ===============-->
<x-website.map.map-box-check/>
<script>
    var token = "{{ $setting->map_box_key }}";
    mapboxgl.accessToken = token;
    const coordinates = document.getElementById('coordinates');
    var oldlat = "{!! $candidate->lat ? $candidate->lat : setting('default_lat') !!}";
    var oldlng = "{!! $candidate->long ? $candidate->long : setting('default_long') !!}";
    const map = new mapboxgl.Map({
        container: 'map-box',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [oldlng, oldlat],
        zoom: 6
    });
    // Add the control to the map.
    map.addControl(
        new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl,
            marker: false,
        })
    );
    // Add the control to the map.
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        marker: {
            color: 'orange',
            draggable: true
        },
        mapboxgl: mapboxgl
    });
    var marker = new mapboxgl.Marker({
            draggable: true
        }).setLngLat([oldlng, oldlat])
        .addTo(map);
    function onDragEnd() {
        const lngLat = marker.getLngLat();
        let lat = lngLat.lat;
        let lng = lngLat.lng;
        axios.get(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
            )
            .then((res) => {
                var form = new FormData();
                form.append('lat', lat);
                form.append('lng', lng);
                for (let i = 0; i < res.data.features.length; i++) {
                    form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                }
                axios.post(
                        '/set/session', form
                    )
                    .then((res) => {
                        // console.log(res.data);
                        // toastr.success("Location Saved", 'Success!');
                    })
                    .catch((e) => {
                        toastr.error("Something Wrong", 'Error!');
                    });
            })
            .catch((e) => {
                // toastr.error("Something Wrong", 'Error!');
            });
    }
    function add_marker(event) {
        var coordinates = event.lngLat;
        marker.setLngLat(coordinates).addTo(map);
    }
    map.on('style.load', function () {
        map.on('click', function (e) {
            var coordinates = e.lngLat;
            let lat = parseFloat(coordinates.lat);
            let lng = parseFloat(coordinates.lng);
            axios.get(
                    `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
                )
                .then((res) => {
                    var form = new FormData();
                    form.append('lat', lat);
                    form.append('lng', lng);
                    for (let i = 0; i < res.data.features.length; i++) {
                        form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                    }
                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                })
                .catch((e) => {
                    // toastr.error("Something Wrong", 'Error!');
                });
        });
    });
    map.on('click', add_marker);
    marker.on('dragend', onDragEnd);
</script>
<script>
    $('.mapboxgl-ctrl-logo').addClass('d-none');
    $('.mapboxgl-compact').addClass('d-none');
    $('.mapboxgl-ctrl-attrib-inner').addClass('d-none');
</script>
<!-- ============== map box ============= -->
<!-- ============== google map ========= -->
<x-website.map.google-map-check/>
<script>
    function initMap() {
        var token = "{{ $setting->google_map_key }}";
        var oldlat = {!! $candidate->lat ? $candidate->lat : setting('default_lat') !!};
        var oldlng = {!! $candidate->long ? $candidate->long : setting('default_long') !!};
        const map = new google.maps.Map(document.getElementById("google-map"), {
            zoom: 7,
            center: {
                lat: oldlat,
                lng: oldlng
            },
        });
        const image =
            "https://gisgeography.com/wp-content/uploads/2018/01/map-marker-3-116x200.png";
        const beachMarker = new google.maps.Marker({
            draggable: true,
            position: {
                lat: oldlat,
                lng: oldlng
            },
            map,
            // icon: image
        });
        google.maps.event.addListener(map, 'click',
            function (event) {
                pos = event.latLng
                beachMarker.setPosition(pos);
                let lat = beachMarker.position.lat();
                let lng = beachMarker.position.lng();
                axios.post(
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
                ).then((data) => {
                    if(data.data.error_message){
                        toastr.error(data.data.error_message, 'Error!');
                        toastr.error('Your location is not set because of a wrong API key.', 'Error!');
                    }

                    const total = data.data.results.length;
                    let amount = '';
                    if (total > 1) {
                        amount = total - 2;
                    }
                    const result = data.data.results.slice(amount);
                    let country = '';
                    let region = '';
                    for (let index = 0; index < result.length; index++) {
                        const element = result[index];
                        if (element.types[0] == 'country') {
                            country = element.formatted_address;
                        }
                        if (element.types[0] == 'administrative_area_level_1') {
                            const str = element.formatted_address;
                            const first = str.split(',').shift()
                            region = first;
                        }
                    }
                    var form = new FormData();
                    form.append('lat', lat);
                    form.append('lng', lng);
                    form.append('country', country);
                    form.append('region', region);
                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                })
            });
        google.maps.event.addListener(beachMarker, 'dragend',
            function () {
                let lat = beachMarker.position.lat();
                let lng = beachMarker.position.lng();
                axios.post(
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
                ).then((data) => {
                    if(data.data.error_message){
                        toastr.error(data.data.error_message, 'Error!');
                        toastr.error('Your location is not set because of a wrong API key.', 'Error!');
                    }

                    const total = data.data.results.length;
                    let amount = '';
                    if (total > 1) {
                        amount = total - 2;
                    }
                    const result = data.data.results.slice(amount);
                    let country = '';
                    let region = '';
                    for (let index = 0; index < result.length; index++) {
                        const element = result[index];
                        if (element.types[0] == 'country') {
                            country = element.formatted_address;
                        }
                        if (element.types[0] == 'administrative_area_level_1') {
                            const str = element.formatted_address;
                            const first = str.split(' ').shift()
                            region = first;
                        }
                    }
                    var form = new FormData();
                    form.append('lat', lat);
                    form.append('lng', lng);
                    form.append('country', country);
                    form.append('region', region);
                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                })
            });
        // Search
        var input = document.getElementById('searchInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });
        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
        });
    }
    window.initMap = initMap;
</script>
<script>
    @php
    $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
    $link2 = $setting->google_map_key;
    $Link3 = '&callback=initMap&libraries=places,geometry';
    $scr = $link1.$link2.$Link3;
    @endphp;
</script>
<script src="{{ $scr }}" async defer></script>
<!-- =============== google map ========= -->
<script type="text/javascript">
    $(document).ready(function () {
        $("[data-toggle=tooltip]").tooltip()
    })
</script>
<!-- >=>Mapbox<=< -->
<script>
    $('#pills-contact-tab').on('click', function () {
        setTimeout(() => {
            map.resize();
        }, 200);
    })
</script>
<script type="text/javascript">
    // feature field
    function add_features_field() {
        $("#multiple_feature_part").append(`
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
    `);
    $(".rt-selectactive").select2({ // minimumResultsForSearch: Infinity,
    });
    }
    $(document).on("click", "#remove_item", function() {
        $(this).parent().parent().parent('div').remove();
    });
</script>
@endsection
