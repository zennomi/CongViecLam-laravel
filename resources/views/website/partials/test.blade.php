<header class="site-header rt-fixed-top">
    <div class="main-header">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="main-menu">
                            <a href="{{ route('website.home') }}" class="mblbrand-logo">
                                <img src="{{ $setting->dark_logo_url }}" alt="">
                            </a>
                            <span class="rt-mobile-menu-close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </span><!-- /.rt-mobile-menu-close -->
                            @if (auth('user')->check())
                                @if (auth('user')->user()->role == 'company')
                                    <ul class="menu-active-classes ">
                                        <li class="menu-item"><a
                                                class="{{ linkActive('website.home', 'text-primary') }}"
                                                href="{{ route('website.home') }}">{{ __('home') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('website.candidate', 'text-primary') }}"
                                                href="{{ route('website.candidate') }}">{{ __('find_candidate') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('company.dashboard', 'text-primary') }}"
                                                href="{{ route('company.dashboard') }}">{{ __('dashboard') }}</a>
                                        </li>
                                        <li class="menu-item">
                                            <a class="{{ linkActive('company.myjob', 'text-primary') }}"
                                                href="{{ route('company.myjob') }}">{{ __('my_jobs') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('company.myjob', 'text-primary') }}"
                                                href="{{ route('company.myjob') }}">{{ __('applications') }}</a>
                                        </li>
                                        <li>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="menu-active-classes ">
                                        <li class="menu-item"><a
                                                class="{{ linkActive('website.home', 'text-primary') }}"
                                                href="{{ route('website.home') }}">{{ __('home') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('website.job', 'text-primary') }}"
                                                href="{{ route('website.job') }}">{{ __('find_job') }}</a></li>
                                        <li class="menu-item">
                                            <a class="{{ linkActive('website.company', 'text-primary') }}"
                                                href="{{ route('website.company') }}">{{ __('find_employers') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('candidate.dashboard', 'text-primary') }}"
                                                href="{{ route('candidate.dashboard') }}">{{ __('dashboard') }}</a>
                                        </li>
                                        <li class="menu-item"><a
                                                class="{{ linkActive('candidate.job', 'text-primary') }}"
                                                href="{{ route('candidate.job.alerts') }}">{{ __('job_alert') }}</a>
                                        </li>
                                        @if (auth('user')->user()->role != 'candidate')
                                            <li>
                                                <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                    href="{{ route('website.plan') }}">
                                                    {{ __('pricing') }}
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @else
                                <ul class="menu-active-classes ">
                                    <li class="menu-item"><a class="{{ linkActive('website.home', 'text-primary') }}"
                                            href="{{ route('website.home') }}">{{ __('home') }}</a>
                                    </li>
                                    <li class="menu-item"><a class="{{ linkActive('website.job', 'text-primary') }}"
                                            href="{{ route('website.job') }}">{{ __('find_job') }}</a></li>
                                    <li class="menu-item">
                                        <a class="{{ linkActive('website.candidate', 'text-primary') }}"
                                            href="{{ route('website.candidate') }}">{{ __('candidates') }}</a>
                                    </li>
                                    <li class="menu-item"><a
                                            class="{{ linkActive('website.company', 'text-primary') }}"
                                            href="{{ route('website.company') }}">{{ __('companies') }}</a>
                                    </li>
                                    <li class="menu-item"><a class="{{ linkActive('website.posts', 'text-primary') }}"
                                            href="{{ route('website.posts') }}">{{ __('blog') }}</a>
                                    </li>
                                    @guest
                                        <li>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </li>
                                    @endguest

                                    @if (auth('user')->check() && auth('user')->user()->role != 'candidate')
                                        <li>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                        </div><!-- /.main-menu -->
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="header-top-right">
                            @if ($cms_setting->footer_phone_no)
                                <div class="header-top-info">
                                    <a class="contact-info" href="tel:{{ $cms_setting->footer_phone_no }}">
                                        <x-svg.telephone2-icon />
                                        {{ $cms_setting->footer_phone_no }}
                                    </a>
                                </div>
                            @endif
                            @if ($setting->language_changing)
                                <div class="dropdown">
                                    @php
                                        $language_count = count($languages) && count($languages) > 1;
                                        $language_count2 = count($languages);
                                        $current_language = currentLanguage() ? currentLanguage() : $defaultLanguage;
                                    @endphp
                                    <button class="btn {{ $language_count ? 'dropdown-toggle' : '' }}" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="flag-icon {{ $current_language->icon }}"></i>
                                        {{ $current_language->name }}
                                    </button>
                                    @if ($language_count)
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach ($languages as $lang)
                                                @if ($current_language->code != $lang->code)
                                                    <li id="lang-dropdown-item">
                                                        <a class="dropdown-item"
                                                            href="{{ route('changeLanguage', $lang->code) }}">
                                                            <i class="flag-icon {{ $lang->icon }}"></i>
                                                            {{ $lang->name }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endif
                            @if (setting('app_country_type') === 'multiple_base')
                                <form action="{{ route('website.job') }}" method="GET" id="search-form"
                                    class="mx-width-300">
                                    <div class="d-flex">
                                        @php
                                            $selected_country = session('selected_country');
                                        @endphp
                                        <div class="">
                                            <div class="dropdown">
                                                <button class="btn dropdown-toggle" type="button" id=""
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    @if ($selected_country)
                                                        <i class="flag-icon {{ selected_country()->icon }}"></i>
                                                        {{ selected_country()->name }}
                                                    @else
                                                        {{ __('all_country') }}
                                                    @endif
                                                </button>

                                                <ul class="dropdown-menu mx-height-400 overflow-auto"
                                                    aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('website.set.country') }}">
                                                            <svg width="26" height="26" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                            </svg>
                                                            <span class="marginleft">
                                                                {{ __('all_country') }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                    @foreach ($headerCountries as $country)
                                                        <li id="lang-dropdown-item">
                                                            <a class="dropdown-item"
                                                                href="{{ route('website.set.country', ['country' => $country->id]) }}">
                                                                <i class="flag-icon {{ $country->icon }}"></i>
                                                                {{ $country->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header top -->
        <div class="navbar">
            <div class="container container-full-xxl">
                <div class=" d-flex align-items-center">
                    <a href="{{ route('website.home') }}" class="brand-logo">
                        <img src="{{ $setting->dark_logo_url }}" alt="">
                    </a>
                </div><!-- /.ms-auto -->
                {{-- <form action="{{ route('website.job') }}" method="GET" id="search-form">
                    <div class="form-item">
                        <input name="keyword" class="custom-input5 w-100" type="text"
                            placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                            id="global_search">
                    </div>
                </form> --}}
                <div class="ms-auto">
                    <div class="rt-nav-tolls d-flex align-items-center">
                        @auth('user')
                            <ul>
                                @if (auth()->user()->role == 'company')
                                    <x-website.company.notifications-component />
                                @endif
                                @if (auth()->user()->role == 'candidate')
                                    <x-website.candidate.notifications-component />
                                @endif

                                <li class="relative">
                                    <a href="{{ route('user.dashboard') }} " class="candidate-profile">
                                        @company
                                            <img src="{{ auth()->user()->company->logo_url }}" alt="">
                                        @else
                                            <img src="{{ auth()->user()->candidate->photo }}" alt="">
                                        @endcompany
                                    </a>
                                </li>
                                @if (!request()->is('email/verify'))
                                    <li>
                                        @company
                                            <a href="{{ route('company.job.create') }}">
                                                <button class="btn btn-primary">
                                                    {{ __('post_job') }}
                                                </button>
                                            </a>
                                        @endcompany
                                    </li>
                                @endif
                                @if (request()->is('email/verify'))
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <button class="btn btn-primary">
                                                {{ __('log_out') }}
                                            </button>
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            </ul>
                        @endauth
                        @guest
                            <ul>
                                <li>
                                    <a href="{{ route('register') }}"
                                        class="btn btn-outline-primary">{{ __('create_account') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('login') }}" class="btn btn-primary">{{ __('log_in') }} </a>
                                </li>
                            </ul>
                        @endguest

                        <div class="mobile-menu">
                            <div class="menu-click">
                                <div class="menu-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

@push('frontend_scripts')
    <script>
        $('#global_search').keypress(function(e) {
            var key = e.which;

            if (key == 13) {
                $('#search-form').submit();
            }
        })
    </script>
@endpush

@push('frontend_links')
    <style>
        .globe-spacing {
            margin-left: 18px !important;
        }

        .custom-input5 {
            border-radius: 5px 5px 5px 5px !important;
            width: 400px !important;
        }

        @media (max-width: 992px) {
            .custom-input5 {
                width: 100% !important;
            }
        }
    </style>
@endpush
