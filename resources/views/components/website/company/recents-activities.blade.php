<div class="col-lg-6 rt-mb-32">
    <div class="border border-gray-50 p-24 rt-rounded-12">
        <div class="d-flex flex-lg-row flex-column justify-content-lg-between rt-mb-24">
            <span class="body-font-1 ft-wt-5">{{ __('recent_activities') }}</span>
        </div>
        <ul class="rt-list recent-activity">
            @if ($recentActivities->count() > 0)
                @foreach ($recentActivities as $noti)
                    @if ($noti->type == 'App\Notifications\Website\Company\JobCreatedNotification')
                        <a href="{{ route('website.job.details', $noti->data['job']['slug']) }}">
                            <li class="d-block">
                                <div class="rt-single-icon-box">
                                    <div class="icon-thumb rt-mr-16 text-primary-500">
                                        <i class="ph-briefcase"></i>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="body-font-3 text-gray-700 rt-mb-4">
                                            <span>
                                                {{ $noti->data['title'] }}
                                            </span>
                                        </div>
                                        <div class="body-font-4 text-gray-400">
                                            {{ $noti->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif
                    @if ($noti->type == 'App\Notifications\Website\Company\JobEditedNotification')
                        <a href="{{ route('website.job.details', $noti->data['job']['slug']) }}">
                            <li class="d-block">
                                <div class="rt-single-icon-box">
                                    <div class="icon-thumb rt-mr-16 text-primary-500">
                                        <svg width="24" height="24" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="iconbox-content">
                                        <div class="body-font-3 text-gray-700 rt-mb-4">
                                            {{ $noti->data['title'] }}
                                        </div>
                                        <div class="body-font-4 text-gray-400">
                                            {{ $noti->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif
                    @if ($noti->type == 'App\Notifications\Website\Company\CandidateBookmarkNotification')
                        <li class="d-block">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb rt-mr-16 text-primary-500">
                                    <x-svg.bookmark-icon />
                                </div>
                                <div class="iconbox-content">
                                    <div class="body-font-3 text-gray-700 rt-mb-4">
                                        {{ $noti->data['title2'] }}
                                    </div>
                                    <div class="body-font-4 text-gray-400">
                                        {{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if ($noti->type == 'App\Notifications\Website\Company\JobDeletedNotification')
                        <li class="d-block">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb rt-mr-16 text-danger-500">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </div>
                                <div class="iconbox-content">
                                    <div class="body-font-3 text-gray-700 rt-mb-4">
                                        {{ $noti->data['title'] }}
                                    </div>
                                    <div class="body-font-4 text-gray-400">{{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <div class="text-center">{{ __('no_activity') }}!</div>
            @endif
        </ul>
    </div>
</div>
