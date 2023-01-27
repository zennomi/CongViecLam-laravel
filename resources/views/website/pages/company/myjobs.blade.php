@extends('website.layouts.app')

@section('title')
    {{ __('my_jobs') }}
@endsection
@section('main')
    <div class="dashboard-wrapper">
        <div class="container">
            <div class="row">
                <x-website.company.sidebar />
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard-right-header rt-mb-32 mt-5">
                            <div class="left-text m-0">
                                <h3 class="f-size-18 lh-1 m-0">
                                    {{ __('my_jobs') }}
                                    <span class="text-gray-400">({{ $myJobs->total() }})</span>
                                </h3>
                            </div>
                            <form id="status-filter" class="d-flex" action="{{ route('company.myjob') }}" method="GET">
                                <div class="header-dropdown">
                                    <h4 class="f-size-14 text-gray-900 m-0">
                                        {{ __('job_status') }}
                                    </h4>
                                    <select name="status" class="rt-selectactive">
                                        <option value="">{{ __('all') }}</option>
                                        <option {{ request('status') == 'active' ? 'selected' : '' }} value="active">
                                            {{ __('active') }}</option>
                                        <option {{ request('status') == 'pending' ? 'selected' : '' }} value="pending">
                                            {{ __('pending') }}</option>
                                        <option {{ request('status') == 'expired' ? 'selected' : '' }} value="expired">
                                            {{ __('expired') }}</option>
                                    </select>
                                </div>
                                <div class="rt-ml-6 header-dropdown">
                                    <h4 class="f-size-14 text-gray-900 m-0">
                                        {{ __('apply_on') }}
                                    </h4>
                                    <select name="apply_on" class="rt-selectactive">
                                        <option value="">{{ __('all') }}</option>
                                        <option {{ request('apply_on') == 'app' ? 'selected' : '' }} value="app">
                                            {{ __('app') }}</option>
                                        <option {{ request('apply_on') == 'email' ? 'selected' : '' }} value="email">
                                            {{ __('email') }}</option>
                                        <option {{ request('apply_on') == 'custom_url' ? 'selected' : '' }}
                                            value="custom_url">{{ __('custom_url') }}</option>
                                    </select>
                                </div>
                                <span class="sidebar-open-nav">
                                    <i class="ph-list"></i>
                                </span>
                            </form>
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
                                    @if ($myJobs->count() > 0)
                                        @foreach ($myJobs as $job)
                                            <tr>
                                                <td>
                                                    <div class="iconbox-content">
                                                        <div class="post-info2">
                                                            <div class="post-main-title">
                                                                <a href="{{ route('website.job.details', $job->slug) }}"
                                                                    class="text-gray-900 f-size-16  ft-wt-5">
                                                                    {{ $job->title }}
                                                                </a>
                                                            </div>
                                                            <div class="body-font-4 text-gray-600 pt-2">
                                                                <span class="info-tools rt-mr-8">
                                                                    {{ ucfirst($job->job_type->name) }}
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
                                                                <a class="dropdown-item"
                                                                    href="{{ route('website.job.details', $job->slug) }}">
                                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                                            @if ($job->status == 'active')
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
                                                                                <path d="M12.5 7.5L7.5 12.5"
                                                                                    stroke="#5E6670" stroke-width="1.5"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                                <path d="M12.5 12.5L7.5 7.5"
                                                                                    stroke="#5E6670" stroke-width="1.5"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></path>
                                                                            </svg>
                                                                            {{ __('make_it_expire') }}
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <a href="{{ route('company.promote', $job->slug) }}"
                                                                    class="dropdown-item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="var(--primary-500)"
                                                                        viewBox="0 0 256 256">
                                                                        <rect width="256" height="256"
                                                                            fill="none"></rect>
                                                                        <path
                                                                            d="M54.5,201.5c-9.2-9.2-3.1-28.5-7.8-39.8S24,140.5,24,128s17.8-22,22.7-33.7-1.4-30.6,7.8-39.8S83,51.4,94.3,46.7,115.5,24,128,24s22,17.8,33.7,22.7,30.6-1.4,39.8,7.8,3.1,28.5,7.8,39.8S232,115.5,232,128s-17.8,22-22.7,33.7,1.4,30.6-7.8,39.8-28.5,3.1-39.8,7.8S140.5,232,128,232s-22-17.8-33.7-22.7S63.7,210.7,54.5,201.5Z"
                                                                            fill="none" stroke="#5E6670"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="16"></path>
                                                                        <polyline points="172 104 113.3 160 84 132"
                                                                            fill="none" stroke="#5E6670"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="16"></polyline>
                                                                    </svg>
                                                                    {{ __('promote') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('company.clone', $job->slug) }}"
                                                                    class="dropdown-item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="#5E6670"
                                                                        viewBox="0 0 256 256">
                                                                        <rect width="256" height="256"
                                                                            fill="none"></rect>
                                                                        <polyline
                                                                            points="168 168 216 168 216 40 88 40 88 88"
                                                                            fill="none" stroke="#5E6670"
                                                                            stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="16"></polyline>
                                                                        <rect x="40" y="88"
                                                                            width="128" height="128" fill="none"
                                                                            stroke="#5E6670" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="16">
                                                                        </rect>
                                                                    </svg>
                                                                    {{ __('clone') }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <x-website.not-found />
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="rt-pt-30">
                            @if ($myJobs->total() > $myJobs->count())
                                <nav>
                                    {{ $myJobs->links('vendor.pagination.frontend') }}
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-footer text-center body-font-4 text-gray-500">
                <x-website.footer-copyright />
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.delete').on('click', function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `{{ __('are_you_sure_want_to_delete_this_item') }}`,
                    text: "{{ __('if_you_delete_this') }}, {{ __('it_will_be_gone_forever') }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>

    <script>
        $('#status-filter').on('change', function() {
            this.submit();
        })
    </script>
@endsection
