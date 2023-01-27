<header class="header rt-fixed-top">
    <div class="n-header">
        <div class="n-header--top relative">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="n-header--top__left main-menu">
                        <div
                            class="mbl-top d-flex align-items-center justify-content-between container position-relative d-lg-none">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('website.home') }}" class="brand-logo">
                                    <img src="{{ $setting->dark_logo_url }}" alt="">
                                </a>
                            </div>

                            <div class="">
                                <div class="d-flex align-items-center ">
                                    <div class="search-icon d-lg-none">
                                        <svg id="mblSearchIcon" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                                stroke="#18191C" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M20.9999 21L16.6499 16.65" stroke="#18191C" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="mblTogglesearch bg-primary-500 rounded">
                                        <form action="{{ route('website.job') }}" method="GET" id="search-form"
                                            class="shadow px-md-5 py-md-3 p-3 rounded w-sm-75 w-100">
                                            <div class="form-item">
                                                <input name="keyword" class="search-input w-100" type="text"
                                                    placeholder="{{ __('job_title_keyword') }}"
                                                    value="{{ request('keyword') }}" id="global_search">
                                            </div>
                                        </form>
                                    </div>
                                    @auth('user')
                                        <ul
                                            class="custom-border list-unstyled d-flex align-items-center justify-content-end">
                                            @if (auth()->user()->role == 'company')
                                                <x-website.company.notifications-component />
                                            @endif
                                            @if (auth()->user()->role == 'candidate')
                                                <x-website.candidate.notifications-component />
                                            @endif
                                            @company
                                                <li class="relative">
                                                    <a href="{{ route('user.dashboard') }} " class="candidate-profile p-0">

                                                        <img src="{{ auth()->user()->company->logo_url }}" alt="">
                                                    </a>
                                                </li>
                                            @else
                                                <li class="relative">
                                                    <a href="{{ route('user.dashboard') }} " class="candidate-profile p-0">
                                                        <img src="{{ auth()->user()->candidate->photo }}" alt="">

                                                    </a>
                                                </li>
                                            @endcompany
                                            @if (!request()->is('email/verify'))
                                                @if (auth()->user()->role !== 'company' && auth()->user()->role !== 'candidate')
                                                    <li>
                                                        <a href="{{ route('company.job.create') }}">
                                                            <button class="btn btn-primary">
                                                                {{ __('post_job') }}
                                                            </button>
                                                        </a>
                                                    </li>
                                                @endif
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
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="{{ route('company.job.create') }}"
                                                    class="btn btn-primary text-white"
                                                    style="padding:12px 24px !important;">{{ __('post_a_job') }}
                                                </a>
                                            </li>
                                        </ul>
                                    @endguest
                                </div>
                            </div>
                        </div>
                        @if (auth('user')->check())
                            @if (auth('user')->user()->role == 'company')
                                <div class="container">
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
                                        <li>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="container">
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
                                </div>
                            @endif
                        @else
                            <div class="container">
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
                                    <li class="menu-item"><a
                                            class="{{ linkActive('website.posts', 'text-primary') }}"
                                            href="{{ route('website.posts') }}">{{ __('blog') }}</a>
                                    </li>
                                    @guest
                                        <li>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </li>
                                        <div class="mbl-btn d-flex">
                                            <a href="{{ route('register') }}"
                                                class="btn btn-primary d-sm-none text-white">Create Account</a>
                                            <a href="{{ route('login') }}"
                                                class="btn btn-outline-primary d-lg-none ms-2 ms-sm-0 text-primary-500 border-primary-100">{{ __('Sign In') }}</a>
                                        </div>
                                    @endguest

                                    @if (auth('user')->check() && auth('user')->user()->role != 'candidate')
                                        <div>
                                            <a class="{{ linkActive('website.plan', 'text-primary') }}"
                                                href="{{ route('website.plan') }}">
                                                {{ __('pricing') }}
                                            </a>
                                        </div>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="n-header--top__right d-flex align-items-center">
                        @if ($cms_setting->footer_phone_no)
                            <div class="contact-info">
                                <a class="text-gray-900" href="tel:{{ $cms_setting->footer_phone_no }}">
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
                                                                stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16">
                                                            </path>
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
                    <div class="mobile-menu">
                        <div class="menu-click">
                            <button class="effect1">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header top -->
        <div class="n-header--bottom">
            <div class="container position-relative">
                <div class="d-flex">
                    <div class="n-header--bottom__left d-flex align-items-center">
                        <a href="{{ route('website.home') }}" class="brand-logo">
                            <img src="{{ $setting->dark_logo_url }}" alt="">
                        </a>
                        <form action="{{ route('website.job') }}" method="GET" id="search-form"
                            class="mx-width-300 d-lg-block d-none">
                            <div class="search-box form-item position-relative">
                                <input name="keyword" class="search-input w-100" type="text"
                                    placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                                    id="global_search">
                                <svg class="position-absolute" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M21 20.9999L16.65 16.6499" stroke="#0A65CC" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            </div>
                        </form>
                    </div>

                    <div class="n-header--bottom__right">
                        <div class="d-flex align-items-center ">
                            <div class="search-icon mx-2 d-lg-none">
                                <svg id="searchIcon" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#18191C" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20.9999 21L16.6499 16.65" stroke="#18191C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="togglesearch ">
                                <form action="{{ route('website.job') }}" method="GET" id="search-form"
                                    class="shadow px-md-5 py-md-3 p-3 rounded w-sm-75 w-100">
                                    <div class="search-box form-item position-relative">
                                        <input name="keyword" class="search-input w-100" type="text"
                                            placeholder="{{ __('job_title_keyword') }}"
                                            value="{{ request('keyword') }}" id="global_search">
                                        <svg class="position-absolute" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                                stroke="#0A65CC" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M21 20.9999L16.65 16.6499" stroke="#0A65CC" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                </form>
                            </div>
                            @auth('user')
                                <ul class="custom-border list-unstyled d-flex align-items-center justify-content-between">
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
                                        <li class="d-none d-sm-block">
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
                                <ul class="list-unstyled d-flex align-items-center justify-content-between">
                                    <li>
                                        <a href="{{ route('login') }}"
                                            class="btn btn-outline-primary">{{ __('sign_in') }}</a>
                                    </li>
                                    <li class="d-none d-sm-block">
                                        <a href="{{ route('company.job.create') }}"
                                            class="btn btn-primary">{{ __('post_job') }}
                                        </a>
                                    </li>
                                </ul>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-mobile-menu-overlay"></div>
    </div>
</header>
