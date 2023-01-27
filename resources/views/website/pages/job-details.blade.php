@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('job-details');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $job->title }}
@endsection

@section('main')
    <div class="breadcrumbs breadcrumbs-height">
        <div class="container">
            <div class="breadcrumb-menu">
                <h6 class="f-size-18 m-0">
                    {{ __('job_details') }}
                </h6>
                <ul>
                    <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                    <li>/</li>
                    <li>{{ __('job_details') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!--Breadcrumb Area-->
    <div class="breadcrumbs-height rt-pt-50">
        <div class="container">
            <div class="row align-items-center breadcrumbs-height">
                <div class="col-12">
                    <div
                        class="card jobcardStyle1 bg-transparent border-transparent hover:bg-transparent hover-shadow:none body-0">
                        <div class="card-body">
                            @if ($job->status == 'pending')
                                <div class="alert bg-warning" role="alert">
                                    <strong>
                                        {{ __('this_job_is_now_pending_please_wait_for_admin_approval') }}
                                    </strong>
                                </div>
                            @endif
                            <div class="rt-single-icon-box  flex-wrap">
                                <a href="{{ route('website.employe.details', $job->company->user->username) }}"
                                    class="icon-thumb rt-mb-10 rt-mb-lg-20">
                                    <img src="{{ $job->company->logo_url }}" alt="" draggable="false">
                                </a>
                                <div class="iconbox-content">
                                    <div class="post-info2">
                                        <div class="post-main-title2"> <a
                                                href="#">{{ Str::limit($job->title, 36, '...') }}</a>
                                            @if ($job->company->user->email_verified_at)
                                                <span class="badge rounded-pill bg-success-50 text-success-500">
                                                    {{ __('verified') }}</span>
                                            @endif
                                            @if ($job->featured)
                                                <span class="badge rounded-pill bg-primary-50 text-primary-500">
                                                    {{ __('featured') }}
                                                </span>
                                            @endif
                                            @if ($job->highlight)
                                                <span class="badge rounded-pill bg-warning-50 text-warning-500">
                                                    {{ __('highlight') }}
                                                </span>
                                            @endif
                                            @if ($job->is_remote)
                                                <span class="badge rounded-pill bg-success-50 text-success-500">
                                                    {{ __('remote_job') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="body-font-3 text-gray-600 pt-2">
                                            @if ($job->company->website)
                                                <a target="_blank" class="info-tools" href="{{ $job->company->website }}">
                                                    <span> <i class="ph-link text-primary-500"></i> </span>
                                                    <span
                                                        class="text-gray-600">{{ Str::limit($job->company->website, 30, '...') }}</span>
                                                </a>
                                            @endif
                                            @auth
                                                @if ($job->company->user->contactInfo->phone)
                                                    <a class="info-tools" href="tel:555-0120">
                                                        <span><i class="ph-phone text-primary-500"></i></span>
                                                        <span
                                                            class="text-gray-600">{{ $job->company->user->contactInfo->phone }}</span>
                                                    </a>
                                                @endif
                                                @if ($job->company->user->contactInfo->email)
                                                    <a class="info-tools" href="mailto: twitter@gmail.com">
                                                        <span><i class="ph-envelope-simple text-primary-500"></i></span>
                                                        <span
                                                            class="text-gray-600">{{ $job->company->user->contactInfo->email }}</span>
                                                    </a>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="iconbox-extra align-self-center flex-md-row flex-column">
                                    <div class="rt-mb-md-10">
                                        @auth
                                            @if (auth()->user()->role == 'candidate')
                                                <a href="{{ route('website.job.bookmark', $job->slug) }}"
                                                    class="bg-gray-10 text-primary-500 plain-button icon-56 hoverbg-primary-50">
                                                    @if ($job->bookmarked)
                                                        <x-svg.bookmark-icon />
                                                    @else
                                                        <x-svg.unmark-icon />
                                                    @endif
                                                </a>
                                            @else
                                                <button type="button"
                                                    class="bg-gray-10 text-primary-500 plain-button icon-56 hoverbg-primary-50 no_permission">
                                                    <x-svg.unmark-icon />
                                                </button>
                                            @endif
                                        @else
                                            <button type="button"
                                                class="bg-gray-10 text-primary-500 plain-button icon-56 hoverbg-primary-50 login_required">
                                                <x-svg.unmark-icon />
                                            </button>
                                        @endauth
                                    </div>
                                    @if ($job->can_apply)
                                        <div class="max-311">
                                            @if ($job->deadline_active)
                                                @auth('user')
                                                    @if (auth()->user()->role == 'candidate')
                                                        @if (!$job->applied)
                                                            <button
                                                                onclick="applyJobb({{ $job->id }}, '{{ $job->title }}')"
                                                                class="btn btn-primary btn-lg d-block">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-icon align-icon-right"><i
                                                                            class="ph-arrow-right"></i></span>
                                                                    <span class="button-text">{{ __('apply_now') }}</span>
                                                                </span>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-success btn-lg d-block">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-text">
                                                                        {{ __('already_applied') }}
                                                                    </span>
                                                                </span>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-primary btn-lg d-block no_permission">
                                                            <span class="button-content-wrapper ">
                                                                <span class="button-icon align-icon-right"><i
                                                                        class="ph-arrow-right"></i></span>
                                                                <span class="button-text">{{ __('apply_now') }}</span>
                                                            </span>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        class="btn btn-primary btn-lg d-block login_required">
                                                        <span class="button-content-wrapper ">
                                                            <span class="button-icon align-icon-right"><i
                                                                    class="ph-arrow-right"></i></span>
                                                            <span class="button-text">{{ __('apply_now') }}</span>
                                                        </span>
                                                    </button>
                                                @endauth
                                                <span class="d-block rt-pt-10 text-lg-end text-start f-size-14 text-gray-700 ">
                                                    {{ __('job_expire_in') }}
                                                    <span class="text-danger-500">
                                                        {{ $job->days_remaining }}
                                                    </span>
                                                </span>
                                            @else
                                                <button type="button" class="btn btn-danger btn-lg d-block">
                                                    <span class="button-content-wrapper ">
                                                        <span class="button-text">
                                                            {{ __('expired') }}
                                                        </span>
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        @if ($job->apply_on == 'custom_url')
                                            <a href="{{ $job->apply_url }}" target="_blank"
                                                class="btn btn-primary btn-lg d-block">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right"><i
                                                            class="ph-arrow-right"></i></span>
                                                    <span class="button-text">{{ __('apply_now') }}</span>
                                                </span>
                                            </a>
                                        @else
                                            <a href="mailto:{{ $job->apply_email }}"
                                                class="btn btn-primary btn-lg d-block">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right"><i
                                                            class="ph-arrow-right"></i></span>
                                                    <span class="button-text">{{ __('apply_now') }}</span>
                                                </span>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Single job content Area-->
    <div class="single-job-content rt-pt-50 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 rt-mb-lg-30">
                    <div class="body-font-1 ft-wt-5 rt-mb-20">
                        {{ __('job_description') }}
                    </div>
                    {!! $job->description !!}
                    <div class="share-job rt-pt-50">
                        <ul class="rt-list gap-8">
                            <li class="d-inline-block body-font-3 text-gray-900">
                                {{ __('share_this_job') }}:
                            </li>
                            <li class="d-inline-block ms-3">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'facebook') }}">
                                    <button class="btn btn-outline-plain">
                                        <span class="f-size-18 text-primary-500"> <span class="iconify"
                                                data-icon="bx:bxl-facebook"></span></span>
                                        <span class="text-primary-500">{{ __('facebook') }}</span>
                                    </button>
                                </a>
                            </li>
                            <li class="d-inline-block">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'twitter') }}">
                                    <button class="btn btn-outline-plain">
                                        <span class="f-size-18 text-twitter"> <span class="iconify"
                                                data-icon="bx:bxl-twitter"></span></span>
                                        <span class="text-twitter">{{ __('twitter') }}</span>
                                    </button>
                                </a>
                            </li>
                            <li class="d-inline-block my-lg-2 my-0">
                                <a href="{{ socialMediaShareLinks(url()->current(), 'pinterest') }}">
                                    <button class="btn btn-outline-plain">
                                        <span class="f-size-18 text-pinterest me-1"> <span class="iconify"
                                                data-icon="bi:pinterest"></span></span>
                                        <span class="text-pinterest">{{ __('pinterest') }}</span>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="p-32 border border-2 border-primary-50 rt-rounded-12 rt-mb-24 lg:max-536">
                        <div class="body-font-1 ft-wt-5 rt-mb-32 ">{{ __('job_overview') }}</div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="icon-thumb">
                                        <i class="ph-calendar-blank f-size-30 text-primary-500"></i>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            {{ __('job_posted') }}:
                                        </div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($job->deadline_active)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                    <div class="single-jSidebarWidget">
                                        <div class="icon-thumb">
                                            <i class="ph-timer f-size-30 text-primary-500"></i>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                                {{ __('job_expire_in') }}:
                                            </div>
                                            <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                                {{ $job->days_remaining }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="icon-thumb">
                                        <i class="ph-suitcase-simple f-size-30 text-primary-500"></i>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            {{ __('job_type') }}</div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $job->job_type ? $job->job_type->name : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                <div class="single-jSidebarWidget">
                                    <div class="icon-thumb">
                                        <i class="ph-user f-size-30 text-primary-500"></i>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                            {{ __('job_role') }}</div>
                                        <span class="d-block f-size-14 ft-wt-5 text-gray-900">
                                            {{ $job->role ? $job->role->name : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($job->education)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                    <div class="single-jSidebarWidget">
                                        <div class="icon-thumb rt-mr-17">
                                            <i class="ph-graduation-cap f-size-30 text-primary-500"></i>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                                {{ __('education') }}</div>
                                            <span class=d-block f-size-14 ft-wt-5 text-gray-900">
                                                {{ $job->education ? $job->education->name : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($job->experience)
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-4 rt-mb-32">
                                    <div class="single-jSidebarWidget">
                                        <div class="icon-thumb rt-mr-17">
                                            <i class="ph-clipboard-text f-size-30 text-primary-500"></i>
                                        </div>
                                        <div class="iconbox-content">
                                            <div class="f-size-12 text-gray-500 uppercase text-uppercase rt-mb-6">
                                                {{ __('experience') }}</div>
                                            <span class=d-block f-size-14 ft-wt-5 text-gray-900">
                                                {{ $job->experience ? $job->experience->name : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="border border-2 border-primary-50 rt-rounded-12 rt-mb-24 lg:max-536">
                        <div class="body-font-1 ft-wt-5 custom-p">{{ __('location') }}
                        </div>
                        <div>
                            @php
                                $map = setting('default_map');
                            @endphp
                            @if ($map == 'map-box')
                                <div class="map mymap" id='map-box'></div>
                            @endif

                            @if ($map == 'google-map')
                                <div class="map mymap" id="google-map"></div>
                            @endif
                        </div>
                    </div>

                    <div class="p-32 border border-2 border-primary-50 rt-rounded-12 rt-mb-24 lg:max-536">
                        <div class="rt-single-icon-box rt-mb-32">
                            <a href="{{ route('website.employe.details', $job->company->user->username) }}"
                                class="icon-thumb rt-mr-16">
                                <img src="{{ $job->company->logo_url }}" alt="">
                            </a>
                            <div class="iconbox-content">
                                <a href="{{ route('website.employe.details', $job->company->user->username) }}"
                                    class="f-size-20 text-gray-900 ft-wt-5 rt-mb-6">{{ $job->company->user->name }}
                                </a>
                                <div class="d-block text-gray-500 f-size-14">
                                    {{ $job->company->organization_type ? $job->company->organization_type->name : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="rt-mb-32">
                            <ul class="rt-list">
                                <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                    <span class="text-gray-500 d-block">{{ __('founded_in') }}</span>
                                    <div class="my-auto">
                                        {{ formatTime($job->company->created_at, 'M d, Y') }}
                                    </div>
                                </li>
                                @if ($job->company->organization_type)
                                    <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                        <span class="text-gray-500 d-block">{{ __('organization_type') }}</span>
                                        <div class="my-auto">
                                            {{ $job->company->organization_type ? $job->company->organization_type->name : '' }}
                                        </div>
                                    </li>
                                @endif
                                @if ($job->company->team_size)
                                    <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                        <span class="text-gray-500 d-block">{{ __('company_size') }}</span>
                                        <div class="my-auto">
                                            {{ $job->company->team_size ? $job->company->team_size->name : '' }}
                                        </div>
                                    </li>
                                @endif
                                @auth
                                    @if ($job->company->user->contactInfo->phone)
                                        <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                            <span class="text-gray-500 d-block">{{ __('phone') }}</span>
                                            <a href="tel:{{ $job->company->user->contactInfo->phone }}" target="_black"
                                                class="my-auto">
                                                {{ $job->company->user->contactInfo->phone }}
                                            </a>
                                        </li>
                                    @endif
                                    @if ($job->company->user->contactInfo->email)
                                        <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                            <span class="text-gray-500 d-block">{{ __('email') }}</span>
                                            <a href="mailto:{{ $job->company->user->contactInfo->email }}" target="_black"
                                                class="my-auto">
                                                {{ $job->company->user->contactInfo->email }}
                                            </a>
                                        </li>
                                    @endif
                                @endauth
                                @if ($job->company->website)
                                    <li class="d-flex justify-content-between align-items-start body-font-3 rt-mb-14">
                                        <span class="text-gray-500 d-block">{{ __('website') }}</span>
                                        <a href="{{ $job->company->website }}" target="_black"  class="my-auto">
                                            {{ __('learn_more') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <ul class="rt-list gap-8">
                            @if (!empty($job->company->user->socialInfo->facebook) && $job->company->user->socialInfo->facebook !== null)
                                <li class="d-inline-block">
                                    <a href="{{ url($job->company->user->socialInfo->facebook) }}"
                                        class="icon-44 bg-gray-10 text-primary-500 border-gray-10 border hover:border-primary-500">
                                        <x-svg.facebook-icon />
                                    </a>
                                </li>
                            @endif
                            @if (!empty($job->company->user->socialInfo->twitter) && $job->company->user->socialInfo->twitter !== null)
                                <li class="d-inline-block">
                                    <a href="{{ url($job->company->user->socialInfo->twitter) }}"
                                        class="icon-44 bg-gray-10 text-primary-500 border-gray-10 border hover:border-primary-500">
                                        <x-svg.twitter-icon />
                                    </a>
                                </li>
                            @endif
                            @if (!empty($job->company->user->socialInfo->instagram) && $job->company->user->socialInfo->instagram !== null)
                                <li class="d-inline-block">
                                    <a href="{{ url($job->company->user->socialInfo->instagram) }}"
                                        class="icon-44 bg-gray-10  text-primary-500 border-gray-10 border hover:border-primary-500">
                                        <x-svg.instagram-icon />
                                    </a>
                                </li>
                            @endif
                            @if (!empty($job->company->user->socialInfo->youtube) && $job->company->user->socialInfo->youtube !== null)
                                <li class="d-inline-block">
                                    <a href="{{ url($job->company->user->socialInfo->youtube) }}"
                                        class="icon-44 bg-gray-10  text-primary-500 border-gray-10 border hover:border-primary-500">
                                        <x-svg.youtube-icon />
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($related_jobs))
        <div class="rt-spacer-100 rt-spacer-md-50"></div>
        <!--Related jobs Area-->
        <hr class="hr-0">
        <section class="related-jobs-area rt-pt-100 rt-pt-md-50 mb-5">
            <div class="container">
                <h4>{{ __('related_jobs') }}</h4>
                <div class="rt-spacer-40 rt-spacer-md-20"></div>
                <div class="related-jobs pb-5">
                    <div class="row">
                        @foreach ($related_jobs as $job)
                            <div class="col-12 col-sm-6 col-md-6 col-xl-4 mb-3">
                                <div class="single-item">
                                    <x-website.job.job-card :job="$job" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Apply Job Modal -->
    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-transparent">
                    <h5 class="modal-title" id="cvModalLabel">{{ __('job') }}: <span id="apply_job_title">Job
                            Title</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('website.job.apply', $job->slug) }}" method="POST">
                    @csrf
                    <div class="modal-body mt-3">
                        <input type="hidden" id="apply_job_id" name="id">
                        <div class="from-group">
                            <x-forms.label name="choose_resume" :required="true" />
                            <select class="rt-selectactive form-control w-100-p" name="resume_id">
                                <option value="">{{ __('select_one') }}</option>
                                @foreach ($resumes as $resume)
                                    <option {{ old('resume_id') == $resume->id ? 'selected' : '' }}
                                        value="{{ $resume->id }}">{{ $resume->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <x-forms.label name="cover_letter" :required="true" />
                            <textarea id="default" class="form-control @error('cover_letter') is-invalid @enderror" name="cover_letter"
                                rows="7"></textarea>
                            @error('cover_letter')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer border-transparent">
                        <button type="button" class="bg-priamry-50 btn btn-outline-primary" data-bs-dismiss="modal"
                            aria-label="Close">{{ __('cancel') }}</button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <span class="button-content-wrapper ">
                                <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                                <span class="button-text">
                                    {{ __('apply_now') }}
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
    <style>
        .mymap {
            border-radius: 0 0 12px 12px;
        }

        .custom-p {
            padding-top: 24px;
            padding-bottom: 16px;
            padding-left: 24px
        }
    </style>
@endsection

@section('script')
    <!-- >=>Mapbox<=< -->
    @include('map::scripts')
    <!-- >=>Mapbox<=< -->
    <!-- ================ mapbox map ============== -->
    <script>
        function applyJobb(id, name) {
            $('#cvModal').modal('show');
            $('#apply_job_id').val(id);
            $('#apply_job_title').text(name);
        }

        mapboxgl.accessToken = "{{ $setting->map_box_key }}";
        const coordinates = document.getElementById('coordinates');

        var oldlat = {!! $job->lat ? $job->lat : setting('default_lat') !!};
        var oldlng = {!! $job->long ? $job->long : setting('default_long') !!};

        const map = new mapboxgl.Map({
            container: 'map-box',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [oldlng, oldlat],
            zoom: 6
        });

        var marker = new mapboxgl.Marker({
                draggable: false
            }).setLngLat([oldlng, oldlat])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            let lat = lngLat.lat;
            let lng = lngLat.lng;
            $('#lat').val(lat);
            $('#lng').val(lng);
            document.getElementById('form').submit();
        }

        function add_marker(event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);

        }
    </script>
    <script>
        $('.mapboxgl-ctrl-logo').addClass('d-none');
        $('.mapboxgl-ctrl-bottom-right').addClass('d-none');
    </script>
    <!-- ================ mapbox map ============== -->
    <!-- ================ google map ============== -->
    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";

            var oldlat = {!! $job->lat ? $job->lat : setting('default_lat') !!};
            var oldlng = {!! $job->long ? $job->long : setting('default_long') !!};

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

                draggable: false,
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
            });
        }
        window.initMap = initMap;
    </script>
    <script>
        @php
            $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
            $link2 = $setting->google_map_key;
            $Link3 = '&callback=initMap&libraries=places,geometry';
            $scr = $link1 . $link2 . $Link3;
        @endphp;
    </script>
    <script src="{{ $scr }}" async defer></script>
    <!-- ================ google map ============== -->
@endsection
