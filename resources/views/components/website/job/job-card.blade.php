<div class="card jobcardStyle1 {{ $job->highlight ? 'gradient-bg' : '' }}">
    <div class="card-body">
        <div class="rt-single-icon-box">
            <a href="{{ route('website.job.details', $job->slug) }}">
                <div class="icon-thumb">
                    <img src="{{ $job->company->logo_url }}" alt="" draggable="false">
                </div>
            </a>
            <div class="iconbox-content">
                <div class="job-mini-title"><a
                        href="{{ route('website.job.details', $job->slug) }}">{{ $job->company->user->name }}</a>
                </div>
                <span class="loacton text-gray-400 d-inline-flex ">
                    <i class="ph-map-pin"></i>
                    {{ $job->country }}
                </span>
            </div>
            <div class="iconbox-extra">
                <div class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                    @auth
                        @if (auth()->user()->role == 'candidate')
                            <a href="{{ route('website.job.bookmark', $job->slug) }}"
                                class="text-primary-500 hoverbg-primary-50 plain-button icon-button">
                                @if ($job->bookmarked)
                                    <x-svg.bookmark-icon />
                                @else
                                    <x-svg.unmark-icon />
                                @endif
                            </a>
                        @else
                            <button type="button"
                                class="text-primary-500 hoverbg-primary-50 plain-button icon-button no_permission">
                                <x-svg.unmark-icon />
                            </button>
                        @endif
                    @else
                        <button type="button"
                            class="text-primary-500 hoverbg-primary-50 plain-button icon-button login_required">
                            <x-svg.unmark-icon />
                        </button>
                    @endauth
                </div>
            </div>
        </div>
        <div class="post-info">
            <div class="post-main-title">
                <a href="{{ route('website.job.details', $job->slug) }}">
                    {{ $job->title }}
                </a>
            </div>
            <div class="body-font-4 text-gray-600">
                <span class="info-tools">{{ $job->job_type ? $job->job_type->name : '' }}</span>
                <span class="info-tools has-dot">
                    {{ currencyPosition($job->min_salary) }} - {{ currencyPosition($job->max_salary) }}
                </span>
            </div>
        </div>
    </div>
</div>
