<li class="d-block fade-in-bottom  rt-mb-24">
    <div class="card iconxl-size jobcardStyle1 {{ $job->highlight ? 'gradient-bg' : '' }}">
        <div class="card-body">
            <div class="rt-single-icon-box icb-clmn-lg ">
                <a href="{{ route('website.job.details', $job->slug) }}" class="icon-thumb">
                    <img src="{{ $job->company->logo_url }}" alt="" draggable="false">
                </a>
                <a href="{{ route('website.job.details', $job->slug) }}" class="iconbox-content">
                    <div class="post-info2">

                        <div class="post-main-title">
                            {{ $job->title }}
                            <span class="badge rounded-pill bg-primary-50 text-primary-500">
                                {{ $job->job_type ? $job->job_type->name : '' }}
                            </span>
                        </div>
                        <div class="body-font-4 text-gray-600 pt-2">
                            <span class="info-tools">
                                <x-svg.location-icon stroke="#C5C9D6" />

                                {{ $job->country }}
                            </span>
                            <span class="info-tools">
                                <x-svg.doller-icon />
                                {{ currencyPosition($job->min_salary) }} - {{ currencyPosition($job->max_salary) }}
                            </span>
                            <span class="info-tools">
                                <x-svg.calender-icon stroke="#C5C9D6" />

                                @if ($job->deadline_active)
                                    <span>{{ $job->days_remaining }} {{ __('remaining') }}</span>
                                @else
                                    <span class="text-danger">{{ __('expired') }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </a>
                <div class="iconbox-extra align-self-center">
                    <div>
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
                    @if ($job->can_apply)
                        <div>
                            @if ($job->deadline_active)
                                @auth
                                    @if (auth()->user()->role == 'candidate')
                                        @if (!$job->applied)
                                            <button type="button"
                                                onclick="applyJobb({{ $job->id }}, '{{ $job->title }}')"
                                                class="btn btn-primary2-50">
                                                <span class="button-content-wrapper ">
                                                    <span class="button-icon align-icon-right"><i
                                                            class="ph-arrow-right"></i></span>
                                                    <span class="button-text">{{ __('apply_now') }}</span>
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
                                        <button type="button" class="btn btn-primary2-50 no_permission">
                                            <span class="button-content-wrapper ">
                                                <span class="button-icon align-icon-right"><i
                                                        class="ph-arrow-right"></i></span>
                                                <span class="button-text">{{ __('apply_now') }}</span>
                                            </span>
                                        </button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-primary2-50 login_required">
                                        <span class="button-content-wrapper ">
                                            <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                                            <span class="button-text">{{ __('apply_now') }}</span>
                                        </span>
                                    </button>
                                @endauth
                            @endif
                        </div>
                    @else
                        @if ($job->apply_on == 'custom_url')
                            <a href="{{ $job->apply_url }}" target="_blank" class="btn btn-primary2-50">
                                <span class="button-content-wrapper ">
                                    <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                                    <span class="button-text">{{ __('apply_now') }}</span>
                                </span>
                            </a>
                        @else
                            <a href="mailto:{{ $job->apply_email }}" class="btn btn-primary2-50">
                                <span class="button-content-wrapper ">
                                    <span class="button-icon align-icon-right"><i class="ph-arrow-right"></i></span>
                                    <span class="button-text">{{ __('apply_now') }}</span>
                                </span>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</li>
