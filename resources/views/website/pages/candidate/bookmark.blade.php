@extends('website.layouts.app')

@section('title')
    {{ __('favorite_jobs') }}
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
                                <h3 class="f-size-18 lh-1 m-0">
                                    {{ __('favorite_jobs') }}
                                    <span class="text-gray-400">({{ $jobs->total() }})</span>
                                </h3>
                            </div>
                            <span class="sidebar-open-nav">
                                <i class="ph-list"></i>
                            </span>
                        </div>
                        <div class="card jobcardStyle1 rt-mb-24">
                            @if ($jobs->count() > 0)
                                @foreach ($jobs as $job)
                                    <div class="card-body">
                                        <div class="rt-single-icon-box ">
                                            <div class="icon-thumb">
                                                <img src="{{ asset($job->company->logo_url) }}" alt=""
                                                    draggable="false">
                                            </div>
                                            <div class="iconbox-content">
                                                <div class="post-info2">
                                                    <div class="post-main-title">
                                                        <a href="{{ route('website.job.details', $job->slug) }}">
                                                            {{ $job->title }}
                                                        </a>
                                                        <span class="badge rounded-pill bg-primary-50 text-primary-500">
                                                            {{ $job->job_type ? $job->job_type->name : '' }}
                                                        </span>
                                                    </div>
                                                    <div class="body-font-4 text-gray-600 pt-2">
                                                        <span class="info-tools">
                                                            <svg width="22" height="22" viewBox="0 0 22 22"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M19.25 9.16602C19.25 15.5827 11 21.0827 11 21.0827C11 21.0827 2.75 15.5827 2.75 9.16602C2.75 6.97798 3.61919 4.87956 5.16637 3.33238C6.71354 1.78521 8.81196 0.916016 11 0.916016C13.188 0.916016 15.2865 1.78521 16.8336 3.33238C18.3808 4.87956 19.25 6.97798 19.25 9.16602Z"
                                                                    stroke="#C5C9D6" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path
                                                                    d="M11 11.916C12.5188 11.916 13.75 10.6848 13.75 9.16602C13.75 7.64723 12.5188 6.41602 11 6.41602C9.48122 6.41602 8.25 7.64723 8.25 9.16602C8.25 10.6848 9.48122 11.916 11 11.916Z"
                                                                    stroke="#C5C9D6" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            {{ $job->country }}
                                                        </span>
                                                        <span class="info-tools">
                                                            <svg width="22" height="22" viewBox="0 0 22 22"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11 2.0625V19.9375" stroke="#C5C9D6"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M15.8125 7.5625C15.8125 7.11108 15.7236 6.66408 15.5508 6.24703C15.3781 5.82997 15.1249 5.45102 14.8057 5.13182C14.4865 4.81262 14.1075 4.55941 13.6905 4.38666C13.2734 4.21391 12.8264 4.125 12.375 4.125H9.28125C8.36957 4.125 7.49523 4.48716 6.85057 5.13182C6.20591 5.77648 5.84375 6.65082 5.84375 7.5625C5.84375 8.47418 6.20591 9.34852 6.85057 9.99318C7.49523 10.6378 8.36957 11 9.28125 11H13.0625C13.9742 11 14.8485 11.3622 15.4932 12.0068C16.1378 12.6515 16.5 13.5258 16.5 14.4375C16.5 15.3492 16.1378 16.2235 15.4932 16.8682C14.8485 17.5128 13.9742 17.875 13.0625 17.875H8.9375C8.02582 17.875 7.15148 17.5128 6.50682 16.8682C5.86216 16.2235 5.5 15.3492 5.5 14.4375"
                                                                    stroke="#C5C9D6" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            {{ currencyPosition($job->min_salary) }} -
                                                            {{ currencyPosition($job->max_salary) }}
                                                        </span>
                                                        @if ($job->deadline_active)
                                                            <span class="info-tools text-success-500">
                                                                <svg width="22" height="22" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                                    </path>
                                                                </svg>
                                                                {{ $job->days_remaining }} {{ __('remaining') }}
                                                            </span>
                                                        @else
                                                            <span class="info-tools text-danger-500">
                                                                <i class="ph-x-circle text-danger-500"></i>
                                                                {{ __('job_expire') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="iconbox-extra align-self-center">
                                                <div>
                                                    <a href="{{ route('website.job.bookmark', $job->slug) }}"
                                                        class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M17.735 21.424C17.8892 21.5203 18.0834 21.5254 18.2424 21.4373C18.4014 21.3492 18.5 21.1818 18.5 21V4.5C18.5 4.16848 18.3683 3.85054 18.1339 3.61612C17.8995 3.3817 17.5815 3.25 17.25 3.25H6.75C6.41848 3.25 6.10054 3.3817 5.86612 3.61612C5.6317 3.85054 5.5 4.16848 5.5 4.5V21C5.5 21.1818 5.59864 21.3492 5.75763 21.4373C5.91661 21.5254 6.11089 21.5203 6.26502 21.424L11.9993 17.8396L17.735 21.424Z"
                                                                fill="#18191C" stroke="#18191C" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                @if ($job->can_apply)
                                                    <div>
                                                        @if ($job->deadline_active)
                                                            @if (!$job->applied)
                                                                <button type="button"
                                                                    onclick="applyJobb({{ $job->id }}, '{{ $job->title }}')"
                                                                    class="btn btn-primary2-50">
                                                                    <span class="button-content-wrapper ">
                                                                        <span class="button-icon align-icon-right"><i
                                                                                class="ph-arrow-right"></i></span>
                                                                        <span
                                                                            class="button-text">{{ __('apply_now') }}</span>
                                                                    </span>
                                                                </button>
                                                            @else
                                                                <button type="button" class="btn btn-success">
                                                                    <span class="button-content-wrapper ">
                                                                        <span class="button-text">
                                                                            {{ __('already_applied') }}
                                                                        </span>
                                                                    </span>
                                                                </button>
                                                            @endif
                                                        @else
                                                            <button type="button" class="btn bg-gray-50 text-gray-400"
                                                                disabled>
                                                                <span class="button-text">
                                                                    {{ __('deadline_expired') }}
                                                                </span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                @else
                                                    @if ($job->apply_on == 'custom_url')
                                                        <a href="{{ $job->apply_url }}" target="_blank"
                                                            class="btn btn-primary2-50">
                                                            <span class="button-content-wrapper ">
                                                                <span class="button-icon align-icon-right"><i
                                                                        class="ph-arrow-right"></i></span>
                                                                <span class="button-text">
                                                                    {{ __('apply_now') }}
                                                                </span>

                                                            </span>
                                                        </a>
                                                    @else
                                                        <a href="mailto:{{ $job->apply_email }}"
                                                            class="btn btn-primary2-50">
                                                            <span class="button-content-wrapper ">
                                                                <span class="button-icon align-icon-right"><i
                                                                        class="ph-arrow-right"></i></span>
                                                                <span class="button-text">
                                                                    {{ __('apply_now') }}
                                                                </span>

                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <x-not-found message="no_data_found" />
                            @endif
                        </div>
                        <div class="rt-pt-30">
                            @if ($jobs->total() > $jobs->count())
                                <nav>
                                    {{ $jobs->links('vendor.pagination.frontend') }}
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500">
            <x-website.footer-copyright />
        </div>
    </div>

    {{-- Apply job Modal --}}
    <div class="modal fade" id="cvModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-transparent">
                    <h5 class="modal-title" id="cvModalLabel">Apply Job: <span id="apply_job_title">Job Title</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('website.job.apply') }}" method="POST">
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

@section('script')
    <script>
        function applyJobb(id, name) {
            $('#cvModal').modal('show');
            $('#apply_job_id').val(id);
            $('#apply_job_title').text(name);
        }

        function keywordClose() {
            $('#keyword').val('');
            $('#form').submit();
        }

        function LoactionClear() {
            $('#country').val('');
            $('#form').submit();
        }

        function CategoryClear() {
            $('#category').val('');
            $('#form').submit();
        }
        $('#form').on('change', function() {
            this.submit();
        })
    </script>
@endsection
