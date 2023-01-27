@props([
    'user' => $user,
])

<div class="sidebar-widget">
    <div class="contact">
        <h2 class="title">
            {{ __('contact_information') }}
        </h2>
        @if ($user->company->website)
            <div class="contact-icon-box">
                <div class="icon-img">
                    <x-svg.globe-icon />
                </div>
                <div class="info">
                    <h3 class="subtitle">{{ __('website') }}</h3>
                    <h2 class="title">{{ $user->company->website }}</h2>
                </div>
            </div>
            <div class="devider">
                <hr>
            </div>
        @endif
        <div class="contact-icon-box">
            <div class="icon-img">
                <x-svg.location2-icon />
            </div>
            <div class="info">
                <h3 class="subtitle">{{ __('location') }}</h3>
                <h2 class="title">
                    {{ $user->company->full_address }}
                </h2>
            </div>
        </div>
        @auth
            <div class="collapse" id="contact-more-collapse">
                @if ($user->contactInfo->phone)
                    <div class="devider">
                        <hr>
                    </div>
                    <div class="contact-icon-box">
                        <div class="icon-img">
                            <x-svg.telephone-icon />
                        </div>
                        <div class="info">
                            <h3 class="subtitle">{{ __('phone') }}</h3>
                            <h2 class="title">{{ $user->contactInfo->phone }}</h2>
                        </div>
                    </div>
                @endif
                @if ($user->contactInfo->email)
                    <div class="devider">
                        <hr>
                    </div>
                    <div class="contact-icon-box">
                        <div class="icon-img">
                            <x-svg.envelope-icon height="32" width="32" />
                        </div>
                        <div class="info">
                            <h3 class="subtitle">{{ __('email_address') }}</h3>
                            <h2 class="title">{{ $user->contactInfo->email }}</h2>
                        </div>
                    </div>
                @endif
            </div>
        @endauth
    </div>
    <div id="show-more" data-bs-toggle="collapse" data-bs-target="#contact-more-collapse" aria-expanded="false"
        aria-controls="contact-more-collapse" class="@guest login_required @endguest mt-2 rounded show-more">Show
        Contact Information</div>
</div>
