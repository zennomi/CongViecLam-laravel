@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('jobs');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <form action="{{ route('website.job') }}" method="GET" id="job_search_form">
        {{-- job filtering --}}
        <x-website.job.job-filtering :countries="$countries" :categories="$categories" :job-roles="$job_roles" :min-salary="$min_salary"
            :max-salary="$max_salary" :experiences="$experiences" :educations="$educations" :job-types="$job_types" />

        <div class="job-filter-overlay"></div>

        <div class="joblist-content">
            <div class="container">
                <x-website.job.job-sorting />

                <div class="row">
                    <div class="col-12">
                        <hr class="rt-p-0 rt-m-0">
                        <div class="rt-spacer-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row">
                                    @forelse ($jobs as $job)
                                        <div class="col-xl-4 col-md-6 fade-in-bottom rt-mb-24 cat-1 cat-3 ">
                                            <x-website.job.job-card :job="$job" />
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <div class="card text-center">
                                                <x-not-found message="{{ __('no_data_found') }}" />
                                            </div>
                                        </div>
                                    @endforelse
                                </div>

                                @if ($jobs->total() > $jobs->count())
                                    <div class="rt-pt-30">
                                        <nav>
                                            {{ $jobs->links('vendor.pagination.frontend') }}
                                        </nav>
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <ul class="rt-list">
                                    @forelse ($jobs as $job)
                                        <x-website.job.job-list :job="$job" />
                                    @empty
                                        <div class="col-md-12">
                                            <div class="card text-center">
                                                <x-not-found message="{{ __('no_data_found') }}" />
                                            </div>
                                        </div>
                                    @endforelse
                                </ul>

                                @if ($jobs->total() > $jobs->count())
                                    <div class="rt-pt-30">
                                        <nav>
                                            {{ $jobs->links('vendor.pagination.frontend') }}
                                        </nav>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Careerjet jobs --}}
                    @if (isset($careerjet_jobs) && isset($careerjet_jobs->jobs) && count($careerjet_jobs->jobs))
                        <div class="col-12 mt-5 pt-5">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>{{ __('jobs_from_our_partner_site') }}</h5>
                                <div>
                                    <a href="https://www.careerjet.com/">{{ __('jobs_by') }}
                                        <svg height="25" width="80" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 148 46">
                                            <path
                                                d="M115 12V38c0 1.1 0 2.6-.2 3.5L114 43a6.2 6.2 0 0 1-1.2 1.4c-.8.6-1.6 1-2.6 1.3a6.3 6.3 0 0 1-1.6.2h-1.8v-5.7a2.7 2.7 0 0 0 1.6-.6 2.6 2.6 0 0 0 1-2V12h5.6zm-83.5-.5a8 8 0 0 1 3.8 2 7.9 7.9 0 0 1 2.3 5v15.3s-2.6.5-5.6.7c-2.9.2-5.4.2-6 .2-.6 0-2.6-.1-4.2-1.1a7.3 7.3 0 0 1-3.3-6c0-.6 0-3.2 2-5.3 2-2 4.4-2.1 5-2.1h.3a55.1 55.1 0 0 1 2.8 0l3.3.3v-.9c0-.6-.1-1.5-.8-2.1-.7-.6-1.8-.9-3.5-.9a13.8 13.8 0 0 0-4.6.8l-2-4.7c1-.5 2.7-.8 5-1.1a17 17 0 0 1 5.5-.1zM11 11.3c2.5 0 4.9 1 6.7 2.5a710.3 710.3 0 0 1-3.5 4.2c-.8-.7-1.9-1-3.2-1-2.1 0-5.3 1.8-5.3 6s3.2 6 5.3 6c1.2 0 2.2-.3 3-.9l.2-.1 3.5 4.2c-1 .8-2 1.4-3.1 1.9-1 .3-2 .5-3.2.6h-.7c-2.9-.1-5.4-1.3-7.3-3.2A12 12 0 0 1 0 23c0-6.4 5-11.7 11-11.7zM144.8 0v12h3.2v5.7h-3.2v8.6c0 .3 0 .7.2 1.2a2.6 2.6 0 0 0 1.3 1.2l.8.3H148v5.7h-1.8c-.8 0-1.4 0-2.3-.2-1-.3-1.8-.7-2.5-1.4a6.2 6.2 0 0 1-1.2-1.3c-.4-.6-.6-.9-.8-1.7-.3-.8-.3-2.2-.3-3.3V3.2l5.7-3.2zM62.1 11.3c1.5 0 4.7.6 7 3.3 2.2 2.6 2.2 6.3 2.2 7.7 0 1 0 1.9-.3 2.8H57.5c0 1.3.9 2.5 1.7 3.2 1 .7 3 1 4.2 1a15.5 15.5 0 0 0 4.9-.7l2.1 4.7a12.7 12.7 0 0 1-3.1 1 27.7 27.7 0 0 1-4.5.4c-.8 0-5.5-.2-8.4-3.5-2.9-3.3-3-7.2-3-7.8 0-1.2.2-2.4.5-3.9.2-.8.9-2.7 2.2-4.4a10 10 0 0 1 8-3.8zm21.7 0c1.5 0 4.6.6 6.9 3.3 2.2 2.6 2.3 6.3 2.3 7.7 0 1-.1 1.9-.4 2.8H79.1c0 1.3 1 2.5 1.8 3.2.9.7 2.9 1 4.1 1a15.5 15.5 0 0 0 4.9-.7l2.2 4.7a12.6 12.6 0 0 1-3.2 1 28 28 0 0 1-4.4.4c-.9 0-5.6-.2-8.5-3.5-2.8-3.3-2.9-7.2-2.9-7.8 0-1.2.1-2.4.5-3.9.2-.8.8-2.7 2.2-4.4a10 10 0 0 1 4-3c1.3-.6 2.4-.8 4-.8zm44 0c1.5 0 4.6.6 6.9 3.3 2.3 2.6 2.3 6.3 2.3 7.7 0 1-.1 1.9-.4 2.8h-13.4c0 1.3.8 2.5 1.7 3.2.9.7 2.9 1 4.1 1a15.5 15.5 0 0 0 5-.7l2 4.7a12.6 12.6 0 0 1-3 1 27.8 27.8 0 0 1-4.5.4c-.9 0-5.6-.2-8.4-3.5-3-3.3-3-7.2-3-7.8 0-1.2.1-2.4.5-3.9.2-.8.8-2.7 2.2-4.4a10 10 0 0 1 8-3.8zm-80.2 0a29.8 29.8 0 0 1 4.2.4l-2.1 5.5a5.3 5.3 0 0 0-.5-.1 5.2 5.2 0 0 0-1-.1 4 4 0 0 0-2 .7V34h-5.7V12.4l3.2-.8a22.9 22.9 0 0 1 3.9-.3zm55 0a29.8 29.8 0 0 1 4.2.4l-2.1 5.5a5.3 5.3 0 0 0-.5-.1 5.2 5.2 0 0 0-1-.1 4 4 0 0 0-2 .7V34h-5.7V12.4l3.2-.8a22.9 22.9 0 0 1 3.9-.3zM27 24.8c-1.8 0-3.2 1.2-3.2 2.6s1.4 2.7 3.2 2.7l1.7-.1 3.2-.3v-4.6a384 384 0 0 1-3.2-.3H27zm34.4-8.2a4 4 0 0 0-1.8.4 3.7 3.7 0 0 0-1.2 1 4.2 4.2 0 0 0-.7 1.3c-.2.5-.2 1-.2 1.6h7.8l-.1-1.6a3.8 3.8 0 0 0-.7-1.3 3.7 3.7 0 0 0-1.2-1c-.5-.2-1.2-.4-1.9-.4zm21.6 0a4 4 0 0 0-1.7.4 3.7 3.7 0 0 0-1.2 1 4.2 4.2 0 0 0-.8 1.3c-.2.5-.2 1-.2 1.6H87v-1.6A3.8 3.8 0 0 0 86 18a3.7 3.7 0 0 0-1.2-1c-.4-.2-1.1-.4-1.8-.4zm44 0a4 4 0 0 0-1.7.4 3.7 3.7 0 0 0-1.2 1 4.2 4.2 0 0 0-.8 1.3c-.2.5-.1 1-.1 1.6h7.8c0-.4 0-1.1-.2-1.6a3.8 3.8 0 0 0-.7-1.3 3.7 3.7 0 0 0-1.2-1c-.4-.2-1.1-.4-1.8-.4zM112.3 2.5c1 0 1.7.3 2.4 1 .8.6 1.1 1.4 1.1 2.5s-.3 2-1 2.6a3.6 3.6 0 0 1-2.5 1 3.6 3.6 0 0 1-2.5-1c-.7-.6-1.1-1.5-1.1-2.6 0-1 .4-2 1-2.6a3.6 3.6 0 0 1 2.6-1z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                @forelse ($careerjet_jobs->jobs as $job)
                                    <div class="col-lg-6 py-1">
                                        <div class="card iconxl-size jobcardStyle1 ">
                                            <div class="card-body">
                                                <div class="rt-single-icon-box icb-clmn-lg ">
                                                    <a target="_blank" href="{{ $job->url }}" class="iconbox-content">
                                                        <div class="post-info2">
                                                            <div class="post-main-title">
                                                                {{ $job->title }}
                                                                @if ($job->company)
                                                                    <span
                                                                        class="badge rounded-pill bg-primary-50 text-primary-500">
                                                                        {{ $job->company }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="body-font-4 text-gray-600 pt-2">
                                                                <p>{!! $job->description !!}</p>
                                                                <span class="info-tools">
                                                                    <svg width="22" height="22" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>

                                                                    {{ $job->locations }}
                                                                </span>
                                                                <span class="info-tools">
                                                                    <svg width="22" height="22" viewBox="0 0 22 22"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17.875 3.4375H4.125C3.7453 3.4375 3.4375 3.7453 3.4375 4.125V17.875C3.4375 18.2547 3.7453 18.5625 4.125 18.5625H17.875C18.2547 18.5625 18.5625 18.2547 18.5625 17.875V4.125C18.5625 3.7453 18.2547 3.4375 17.875 3.4375Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M15.125 2.0625V4.8125" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path d="M6.875 2.0625V4.8125" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path d="M3.4375 7.5625H18.5625" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>

                                                                    <span>{{ $job->date }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="iconbox-extra align-self-center">
                                                        <div>
                                                            <a href="{{ $job->url }}" target="_blank"
                                                                class="btn btn-primary2-50">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-icon align-icon-right"><i
                                                                            class="ph-arrow-right"></i></span>
                                                                    <span class="button-text">{{ __('details') }}</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <div class="card text-center">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif

                    {{-- Indeed jobs --}}
                    @if (isset($indeed_jobs) && isset($indeed_jobs->results) && count($indeed_jobs->results))
                        <div class="col-12 mt-3 pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <h5>{{ __('jobs_from_our_partner_site') }}</h5>
                                <div>
                                    <span>
                                        <a href="https://www.indeed.co.in">jobs
                                            by <img alt="Indeed" src="https://www.indeed.com/p/jobsearch.gif"
                                                style="border:0;vertical-align:middle" class=" ezlazyloaded"
                                                data-ezsrc="https://www.indeed.com/p/jobsearch.gif" height="19"
                                                width="54" ezoid="0.47928099933588997"></a>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                @forelse ($indeed_jobs->results as $job)
                                    <div class="col-lg-6 py-1">
                                        <div class="card iconxl-size jobcardStyle1 ">
                                            <div class="card-body">
                                                <div class="rt-single-icon-box icb-clmn-lg ">
                                                    <a target="_blank" href="{{ $job->url }}"
                                                        class="iconbox-content">
                                                        <div class="post-info2">
                                                            <div class="post-main-title">
                                                                {{ $job->jobtitle }}
                                                                <span
                                                                    class="badge rounded-pill bg-primary-50 text-primary-500">
                                                                    {{ $job->company }}
                                                                </span>
                                                            </div>
                                                            <div class="body-font-4 text-gray-600 pt-2">
                                                                <p>{!! $job->snippet !!}</p>
                                                                <span class="info-tools">
                                                                    <svg width="22" height="22"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>

                                                                    {{ $job->formattedLocationFull }}
                                                                </span>
                                                                <span class="info-tools">
                                                                    <svg width="22" height="22"
                                                                        viewBox="0 0 22 22" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M17.875 3.4375H4.125C3.7453 3.4375 3.4375 3.7453 3.4375 4.125V17.875C3.4375 18.2547 3.7453 18.5625 4.125 18.5625H17.875C18.2547 18.5625 18.5625 18.2547 18.5625 17.875V4.125C18.5625 3.7453 18.2547 3.4375 17.875 3.4375Z"
                                                                            stroke="#C5C9D6" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round">
                                                                        </path>
                                                                        <path d="M15.125 2.0625V4.8125" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path d="M6.875 2.0625V4.8125" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                        <path d="M3.4375 7.5625H18.5625" stroke="#C5C9D6"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </svg>

                                                                    <span>{{ $job->formattedRelativeTime }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <div class="iconbox-extra align-self-center">
                                                        <div>
                                                            <a href="{{ $job->url }}" target="_blank"
                                                                class="btn btn-primary2-50">
                                                                <span class="button-content-wrapper ">
                                                                    <span class="button-icon align-icon-right"><i
                                                                            class="ph-arrow-right"></i></span>
                                                                    <span class="button-text">{{ __('details') }}</span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-md-12">
                                        <div class="card text-center">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <div class="rt-spacer-100 rt-spacer-md-50"></div>

    {{-- Subscribe Newsletter --}}
    <x-website.subscribe-newsletter />

    {{-- Apply job Modal --}}
    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-transparent">
                    <h5 class="modal-title" id="cvModalLabel">Apply Job: <span id="apply_job_title">Job Title</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('website.job.apply') }}">
                    @csrf
                    <div class="modal-body mt-3">
                        <input type="hidden" id="apply_job_id" name="id">
                        <div class="from-group">
                            <x-forms.label name="choose_resume" :required="true" />
                            <select class="rt-selectactive form-control w-100-p" name="resume_id" required>
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
                                rows="7" required></textarea>
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

@section('script')
    <script>
        function applyJobb(id, name) {
            $('#cvModal').modal('show');
            $('#apply_job_id').val(id);
            $('#apply_job_title').text(name);
        }
    </script>
@endsection
