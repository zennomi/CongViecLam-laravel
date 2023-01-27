@if ($jobs->count() > 0)
    @foreach ($jobs as $job)
        <div class="card jobcardStyle1 rt-mb-24">
            <div class="card-body">
                <div class="rt-single-icon-box ">
                    <div class="icon-thumb">
                        <img src="{{ asset($job->company->logo_url) }}" alt="" draggable="false">
                    </div>
                    <div class="iconbox-content">
                        <div class="post-info2">
                            <div class="post-main-title">
                                <a href="{{ route('website.job.details', $job->slug) }}">{{ $job->title }}</a>
                                <span class="badge rounded-pill bg-primary-50 text-primary-500">
                                    {{ $job->job_type ? $job->job_type->name : '' }}
                                </span>
                            </div>
                            <div class="body-font-4 text-gray-600 pt-2">
                                <span class="info-tools">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.25 9.16602C19.25 15.5827 11 21.0827 11 21.0827C11 21.0827 2.75 15.5827 2.75 9.16602C2.75 6.97798 3.61919 4.87956 5.16637 3.33238C6.71354 1.78521 8.81196 0.916016 11 0.916016C13.188 0.916016 15.2865 1.78521 16.8336 3.33238C18.3808 4.87956 19.25 6.97798 19.25 9.16602Z"
                                            stroke="#C5C9D6" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M11 11.916C12.5188 11.916 13.75 10.6848 13.75 9.16602C13.75 7.64723 12.5188 6.41602 11 6.41602C9.48122 6.41602 8.25 7.64723 8.25 9.16602C8.25 10.6848 9.48122 11.916 11 11.916Z"
                                            stroke="#C5C9D6" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    {{ $job->country }}
                                </span>
                                <span class="info-tools">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 2.0625V19.9375" stroke="#C5C9D6" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M15.8125 7.5625C15.8125 7.11108 15.7236 6.66408 15.5508 6.24703C15.3781 5.82997 15.1249 5.45102 14.8057 5.13182C14.4865 4.81262 14.1075 4.55941 13.6905 4.38666C13.2734 4.21391 12.8264 4.125 12.375 4.125H9.28125C8.36957 4.125 7.49523 4.48716 6.85057 5.13182C6.20591 5.77648 5.84375 6.65082 5.84375 7.5625C5.84375 8.47418 6.20591 9.34852 6.85057 9.99318C7.49523 10.6378 8.36957 11 9.28125 11H13.0625C13.9742 11 14.8485 11.3622 15.4932 12.0068C16.1378 12.6515 16.5 13.5258 16.5 14.4375C16.5 15.3492 16.1378 16.2235 15.4932 16.8682C14.8485 17.5128 13.9742 17.875 13.0625 17.875H8.9375C8.02582 17.875 7.15148 17.5128 6.50682 16.8682C5.86216 16.2235 5.5 15.3492 5.5 14.4375"
                                            stroke="#C5C9D6" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    {{ currencyPosition($job->min_salary) }} -
                                    {{ currencyPosition($job->max_salary) }}
                                </span>
                                <span class="info-tools">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.875 3.4375H4.125C3.7453 3.4375 3.4375 3.7453 3.4375 4.125V17.875C3.4375 18.2547 3.7453 18.5625 4.125 18.5625H17.875C18.2547 18.5625 18.5625 18.2547 18.5625 17.875V4.125C18.5625 3.7453 18.2547 3.4375 17.875 3.4375Z"
                                            stroke="#C5C9D6" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.125 2.0625V4.8125" stroke="#C5C9D6" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M6.875 2.0625V4.8125" stroke="#C5C9D6" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M3.4375 7.5625H18.5625" stroke="#C5C9D6" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    {{ $job->days_remaining }} {{ __('remaining') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="iconbox-extra align-self-center">
                        <div>
                            <a href="{{ route('website.job.bookmark', $job->slug) }}"
                                class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 21L12 16L5 21V5C5 4.46957 5.21071 3.96086 5.58579 3.58579C5.96086 3.21071 6.46957 3 7 3H17C17.5304 3 18.0391 3.21071 18.4142 3.58579C18.7893 3.96086 19 4.46957 19 5V21Z"
                                        fill="var(--primary-500)" stroke="{{ $setting->frontend_primary_color }}"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        @if ($job->can_apply)
                            <div>
                                @if (!$job->applied)
                                    <a href="{{ route('website.job.apply', $job->slug) }}"
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
                                    <button type="button" class="btn btn-success">
                                        <span class="button-content-wrapper ">
                                            <span class="button-text">
                                                {{ __('already_applied') }}
                                            </span>
                                        </span>
                                    </button>
                                @endif
                            </div>
                        @else
                            @if ($job->apply_on == 'custom_url')
                                <a href="{{ $job->apply_url }}" target="_blank" class="btn btn-primary2-50">
                                    <span class="button-content-wrapper ">
                                        <span class="button-icon align-icon-right"><i
                                                class="ph-arrow-right"></i></span>
                                        <span class="button-text">
                                            {{ __('apply_now') }}
                                        </span>

                                    </span>
                                </a>
                            @else
                                <a href="mailto:{{ $job->apply_email }}" class="btn btn-primary2-50">
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
        </div>
    @endforeach
@else
    <x-not-found message=" No Jobs found" />
@endif
<div class="rt-spacer-50 rt-spacer-md-20"></div>
<nav>
    {{ $jobs->links('vendor.pagination.frontend') }}
</nav>
