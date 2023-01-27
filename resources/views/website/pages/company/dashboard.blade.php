@extends('website.layouts.app')

@section('title', __('dashboard'))

@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                <x-website.company.sidebar />
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard-right-header">
                            <div class="left-text">
                                <h5>{{ __('hello') }}, {{ ucfirst(auth()->user()->name) }}</h5>
                                <p class="m-0">{{ __('here_is_your_daily_activities_career_opportunities') }}
                                </p>
                            </div>
                            <span class="sidebar-open-nav">
                                <i class="ph-list"></i>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="single-feature-box">
                                    <div class="single-feature-data">
                                        <h6>{{ $openJobCount }}</h6>
                                        <p>{{ __('open_job') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-suitcase-simple"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="single-feature-box">
                                    <div class="single-feature-data">
                                        <h6>{{ $savedCandidates }}</h6>
                                        <p>{{ __('saved_candidate') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-identification-card"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="single-feature-box bg-danger-50">
                                    <div class="single-feature-data">
                                        <h6>{{ $pendingJobCount }}</h6>
                                        <p>{{ __('pending_jobs') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-suitcase-simple text-danger-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>@lang('remaining_features_on_current_plan')</h5>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="single-feature-box bg-success-50">
                                    <div class="single-feature-data">
                                        <h6>{{ $userplan->job_limit }}</h6>
                                        <p>{{ __('active_jobs') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-suitcase-simple text-success-500"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="single-feature-box bg-warning-50">
                                    <div class="single-feature-data">
                                        <h6>{{ $userplan->highlight_job_limit }}</h6>
                                        <p>{{ __('highlight_jobs') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-shield-star text-warning-500"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="single-feature-box">
                                    <div class="single-feature-data">
                                        <h6>{{ $userplan->featured_job_limit }}</h6>
                                        <p>{{ __('featured_jobs') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-circle-wavy-check text-primary-500"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <div class="single-feature-box bg-danger-50">
                                    <div class="single-feature-data">
                                        <h6>{{ $userplan->candidate_cv_view_limit }}</h6>
                                        <p>{{ __('profile_view') }}</p>
                                    </div>
                                    <div class="single-feature-icon">
                                        <i class="ph-users-four text-danger-500"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="recently-applied-wrap d-flex justify-content-between align-items-center rt-mb-15">
                            <h3 class="f-size-16">{{ __('recent_jobs') }}</h3>
                            <a class="view-all text-gray-500 f-size-16 d-flex align-items-center"
                                href="{{ route('company.myjob') }}">
                                {{ __('view_all') }}
                                <i class="ph-arrow-right f-size-20 rt-ml-8"></i>
                            </a>
                        </div>
                        <div class="db-job-card-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>{{ __('job') }}</th>
                                        <th>{{ __('status') }}</th>
                                        <th>{{ __('applications') }}</th>
                                        <th>{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($recentJobs->count() > 0)
                                        @foreach ($recentJobs as $job)
                                            <tr>
                                                <td>
                                                    <div class="iconbox-content">
                                                        <div class="post-info2">
                                                            <div class="post-main-title">
                                                                <a href="{{ route('website.job.details', $job->slug) }}"
                                                                    class="text-gray-900 f-size-16  ft-wt-5">
                                                                    {{ Str::limit($job->title, 40, '...') }}
                                                                </a>
                                                            </div>
                                                            <div class="body-font-4 text-gray-600 pt-2">
                                                                <span class="info-tools rt-mr-8">
                                                                    {{ $job->job_type ? $job->job_type->name : '' }}
                                                                </span>
                                                                <span class="info-tools">
                                                                    {{ $job->days_remaining }}
                                                                    {{ __('remaining') }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($job->status == 'active')
                                                        <div class="text-success-500 ft-wt-5 d-flex align-items-center">
                                                            <i class="ph-check-circle f-size-18 mt-1 rt-mr-4"></i>
                                                            {{ __('active') }}
                                                        </div>
                                                    @elseif ($job->status == 'pending')
                                                        <div class="text-primary-500 ft-wt-5 d-flex align-items-center">
                                                            <i class="ph-hourglass f-size-18 mt-1 rt-mr-4"></i>
                                                            {{ __('pending') }}
                                                        </div>
                                                    @else
                                                        <div class="text-danger-500 ft-wt-5 d-flex align-items-center">
                                                            <i class="ph-x-circle f-size-18 mt-1 rt-mr-4"></i>
                                                            {{ __('job_expire') }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ph-users f-size-20 rt-mr-4"></i>
                                                        {{ $job->applied_jobs_count }} {{ __('applications') }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="db-job-btn-wrap d-flex justify-content-end">
                                                        <a href="{{ route('company.job.application', ['job' => $job->id]) }}"
                                                            class="btn bg-gray-50 text-primary-500 rt-mr-8">
                                                            <span class="button-text">
                                                                {{ __('view_applications') }}
                                                            </span>
                                                        </a>
                                                        <button type="button" class="btn btn-icon" id="dropdownMenuButton5"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 13.125C12.6213 13.125 13.125 12.6213 13.125 12C13.125 11.3787 12.6213 10.875 12 10.875C11.3787 10.875 10.875 11.3787 10.875 12C10.875 12.6213 11.3787 13.125 12 13.125Z"
                                                                    fill="#767F8C" stroke="#767F8C" />
                                                                <path
                                                                    d="M12 6.65039C12.6213 6.65039 13.125 6.14671 13.125 5.52539C13.125 4.90407 12.6213 4.40039 12 4.40039C11.3787 4.40039 10.875 4.90407 10.875 5.52539C10.875 6.14671 11.3787 6.65039 12 6.65039Z"
                                                                    fill="#767F8C" stroke="#767F8C" />
                                                                <path
                                                                    d="M12 19.6094C12.6213 19.6094 13.125 19.1057 13.125 18.4844C13.125 17.8631 12.6213 17.3594 12 17.3594C11.3787 17.3594 10.875 17.8631 10.875 18.4844C10.875 19.1057 11.3787 19.6094 12 19.6094Z"
                                                                    fill="#767F8C" stroke="#767F8C" />
                                                            </svg>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end company-dashboard-dropdown"
                                                            aria-labelledby="dropdownMenuButton5">
                                                            <li>
                                                                <a href="{{ route('company.promote', $job->slug) }}"
                                                                    class="dropdown-item">
                                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z"
                                                                            stroke="#0A65CC" stroke-width="1.5"
                                                                            stroke-miterlimit="10" />
                                                                        <path d="M6.875 10H13.125" stroke="#0A65CC"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path d="M10 6.875V13.125" stroke="#0A65CC"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>

                                                                    {{ __('Promote Job') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('website.job.details', $job->slug) }}">
                                                                    <svg width="20" height="20"
                                                                        viewBox="0 0 20 20" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M10 3.54102C3.75 3.54102 1.25 9.99996 1.25 9.99996C1.25 9.99996 3.75 16.4577 10 16.4577C16.25 16.4577 18.75 9.99996 18.75 9.99996C18.75 9.99996 16.25 3.54102 10 3.54102Z"
                                                                            stroke="var(--primary-500)" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                        <path
                                                                            d="M10 13.125C11.7259 13.125 13.125 11.7259 13.125 10C13.125 8.27411 11.7259 6.875 10 6.875C8.27411 6.875 6.875 8.27411 6.875 10C6.875 11.7259 8.27411 13.125 10 13.125Z"
                                                                            stroke="var(--primary-500)" stroke-width="1.5"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                    {{ __('view_details') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form method="POST"
                                                                    action="{{ route('company.job.make.expire', $job->id) }}">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        <svg width="20" height="20"
                                                                            viewBox="0 0 20 20" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M10 17.5C14.1421 17.5 17.5 14.1421 17.5 10C17.5 5.85786 14.1421 2.5 10 2.5C5.85786 2.5 2.5 5.85786 2.5 10C2.5 14.1421 5.85786 17.5 10 17.5Z"
                                                                                stroke="#5E6670" stroke-width="1.5"
                                                                                stroke-miterlimit="10"></path>
                                                                            <path d="M12.5 7.5L7.5 12.5" stroke="#5E6670"
                                                                                stroke-width="1.5" stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                            <path d="M12.5 12.5L7.5 7.5" stroke="#5E6670"
                                                                                stroke-width="1.5" stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                        </svg>
                                                                        {{ __('make_it_expire') }}
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <x-svg.not-found-icon />
                                                <p class="mt-4">{{ __('no_data_found') }}</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-footer text-center body-font-4 text-gray-500">
            <x-website.footer-copyright />
        </div>
    </div>
@endsection
