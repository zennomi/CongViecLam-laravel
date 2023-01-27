<li>
    <div class="notification-icon position-relative pointer">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M5.26904 10.5002C5.26657 9.61461 5.43885 8.73727 5.77603 7.91841C6.1132 7.09956 6.60864 6.35528 7.23394 5.72822C7.85925 5.10116 8.60214 4.60365 9.42006 4.26419C10.238 3.92474 11.1148 3.75 12.0004 3.75C12.8859 3.75 13.7628 3.92474 14.5807 4.26419C15.3986 4.60365 16.1415 5.10116 16.7668 5.72822C17.3921 6.35528 17.8876 7.09956 18.2247 7.91841C18.5619 8.73727 18.7342 9.61461 18.7317 10.5002V10.5002C18.7317 13.8579 19.4342 15.8063 20.0529 16.8712C20.1196 16.985 20.1551 17.1144 20.1558 17.2462C20.1565 17.3781 20.1224 17.5078 20.0569 17.6223C19.9915 17.7368 19.8971 17.832 19.7831 17.8984C19.6691 17.9647 19.5397 17.9998 19.4078 18.0002H4.59222C4.46034 17.9998 4.33087 17.9647 4.21689 17.8984C4.1029 17.832 4.00844 17.7368 3.94301 17.6223C3.87759 17.5077 3.84352 17.378 3.84425 17.2461C3.84498 17.1142 3.88048 16.9849 3.94716 16.8711C4.56622 15.8061 5.26904 13.8577 5.26904 10.5002H5.26904Z"
                stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path
                d="M9 18V18.75C9 19.5456 9.31607 20.3087 9.87868 20.8713C10.4413 21.4339 11.2044 21.75 12 21.75C12.7956 21.75 13.5587 21.4339 14.1213 20.8713C14.6839 20.3087 15 19.5456 15 18.75V18"
                stroke="#18191C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M17.1968 2.24902C18.7229 3.21245 19.9531 4.57885 20.7516 6.19736" stroke="#18191C"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M3.24829 6.19736C4.04681 4.57885 5.27703 3.21245 6.80315 2.24902" stroke="#18191C"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        @if (candidateUnreadNotifications() > 0)
            <svg id="unNotifications" class="circle" width="14" height="14" viewBox="0 0 14 14" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <circle cx="7" cy="7" r="6" fill="#E05151" stroke="white" stroke-width="2">
                </circle>
            </svg>
        @endif
        <div class="notification-bar">
            <a href="#" onclick="ReadNotification()" class="notification-header">
                <h2>{{ __('notifications') }}</h2>
                <p>{{ __('mark_all_as_read') }}</p>
            </a>
            <div class="devider">
            </div>
            <div class="notification-list">
                <ul>
                    @if (candidateNotifications()->count() > 0)
                        @foreach (candidateNotifications() as $noti)
                            @if ($noti->type == 'App\Notifications\Website\Candidate\ApplyJobNotification')
                                <li>
                                    <a onclick="readSingleNotification('{{ $noti->data['url2'] }}', '{{ $noti->id }}')"
                                        href="javascript:void(0)" class="d-flex">
                                        <div class="notification-thumb">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                fill="#000000" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <rect x="32" y="72" width="192" height="144"
                                                    rx="8" fill="none" stroke="#000000"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16">
                                                </rect>
                                                <path d="M168,72V56a16,16,0,0,0-16-16H104A16,16,0,0,0,88,56V72"
                                                    fill="none" stroke="#000000" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16"></path>
                                                <line x1="32" y1="160" x2="224" y2="160"
                                                    fill="none" stroke="#000000" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16">
                                                </line>
                                            </svg>
                                        </div>
                                        <div class="">
                                            <h4>{{ $noti->data['title2'] }}</h4>
                                            <p>{{ $noti->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                            @if ($noti->type == 'App\Notifications\Website\Candidate\BookmarkJobNotification')
                                <li>
                                    <a onclick="readSingleNotification('{{ $noti->data['url2'] }}', '{{ $noti->id }}')"
                                        href="javascript:void(0)" class="d-flex">
                                        <div class="notification-thumb">
                                            <x-svg.bookmark-icon width="40" height="40" />
                                        </div>
                                        <div class="">
                                            <h4>{{ $noti->data['title2'] }}</h4>
                                            <p>{{ $noti->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                            @if ($noti->type == 'App\Notifications\Website\Candidate\RelatedJobNotification')
                                <li>
                                    <a onclick="readSingleNotification('{{ $noti->data['url'] }}', '{{ $noti->id }}')"
                                        href="javascript:void(0)" class="d-flex">
                                        <div class="notification-thumb">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                fill="#000000" viewBox="0 0 256 256">
                                                <rect width="256" height="256" fill="none"></rect>
                                                <rect x="32" y="72" width="192" height="144"
                                                    rx="8" fill="none" stroke="#000000"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16">
                                                </rect>
                                                <path d="M168,72V56a16,16,0,0,0-16-16H104A16,16,0,0,0,88,56V72"
                                                    fill="none" stroke="#000000" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16"></path>
                                                <line x1="32" y1="160" x2="224" y2="160"
                                                    fill="none" stroke="#000000" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="16">
                                                </line>
                                            </svg>
                                        </div>
                                        <div class="">
                                            <h4>{{ $noti->data['title'] }}</h4>
                                            <p>{{ $noti->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                            @if ($noti->type == 'App\Notifications\Website\Company\CandidateBookmarkNotification')
                                <li>
                                    <a onclick="readSingleNotification('{{ $noti->data['url'] }}', '{{ $noti->id }}')"
                                        href="javascript:void(0)" class="d-flex">
                                        <div class="notification-thumb">
                                            <x-svg.bookmark-icon width="40" height="40" />
                                        </div>
                                        <div class="">
                                            <h4>{{ $noti->data['title'] }}</h4>
                                            <p>{{ $noti->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @else
                        <div class="text-center">{{ __('no_notification') }}</div>
                    @endif
                </ul>
            </div>
            @if (candidateNotificationsCount() > 6)
                <div class="text-center bg-gray-50 p-2">
                    <a href="{{ route('company.allNotification') }}">
                        <span class="body-font-1 ft-wt-5 m-2 underCs">{{ __('view_all_notifications') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</li>
