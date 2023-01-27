<div class="col-lg-6 rt-mb-32">
    <div class="border border-gray-50 p-24 rt-rounded-12">
        <div class="d-flex flex-lg-row flex-column justify-content-lg-between rt-mb-24">
            <span class="body-font-1 ft-wt-5">{{ __('recent_activities') }}</span>
        </div>
        <ul class="rt-list recent-activity">
            @if ($recentActivities->count() > 0)
                @foreach ($recentActivities as $noti)
                    @if ($noti->type == 'App\Notifications\Website\Candidate\BookmarkJobNotification')
                        <li class="d-block">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb rt-mr-16 text-primary-500">
                                    <x-svg.bookmark-icon/>
                                </div>
                                <div class="iconbox-content">
                                    <div class="body-font-3 text-gray-700 rt-mb-4">
                                        {{ $noti->data['title2'] }}
                                    </div>
                                    <div class="body-font-4 text-gray-400">{{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                    @if ($noti->type == 'App\Notifications\Website\Candidate\ApplyJobNotification')
                        <li class="d-block">
                            <div class="rt-single-icon-box">
                                <div class="icon-thumb rt-mr-16 text-primary-500">
                                    <i class="ph-briefcase"></i>
                                </div>
                                <div class="iconbox-content">
                                    <div class="body-font-3 text-gray-700 rt-mb-4">
                                        {{ $noti->data['title2'] }}
                                    </div>
                                    <div class="body-font-4 text-gray-400">{{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            @else
                <div class="text-center">{{ __('no_activities') }}</div>
            @endif
        </ul>
    </div>
</div>
