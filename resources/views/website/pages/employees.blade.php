@extends('website.layouts.app')

@section('description')
    @php
    $data = metaData('company');
    @endphp
    {{ $data->description }}
@endsection
@section('og:image')
    {{ asset($data->image) }}
@endsection
@section('title')
    {{ $data->title }}
@endsection

@section('main')
    <div class="breadcrumbs style-two">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-12 position-relative ">
                    <div class="breadcrumb-menu mb-4">
                        <h6 class="f-size-18 m-0">{{ __('find_employers') }}</h6>
                        <ul>
                            <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                            <li>/</li>
                            <li>{{ __('companies') }}</li>
                        </ul>
                    </div>
                    <div class="jobsearchBox  bg-gray-10 input-transparent with-advanced-filter height-auto-xl">
                        <form action="{{ route('website.company') }}" id="formSubmit">
                            <div class="top-content d-flex flex-column flex-xl-row">
                                <div class="left-content">
                                    <div class="inputbox_1 fromGroup has-icon">
                                        <input type="text" name="keyword"
                                            placeholder="{{ __('company_title_keyword') }}">
                                        <div class="icon-badge">
                                            <x-svg.search-icon stroke="{{ $setting->frontend_primary_color }}"
                                                width="24" height="24" />
                                        </div>
                                    </div>

                                    <input type="hidden" name="lat" id="lat" value="">
                                    <input type="hidden" name="long" id="long" value="">
                                    @php
                                        $oldLocation = request('location');
                                        $map = setting('default_map');
                                    @endphp
                                    @if ($map == 'map-box')
                                        <div class="inputbox_2 fromGroup has-icon">
                                            <input type="hidden" name="location" id="insertlocation" value="">
                                            <span id="geocoder"></span>
                                            <div class="icon-badge">
                                                <x-svg.location-icon stroke="{{ $setting->frontend_primary_color }}"
                                                    width="24" height="24" />
                                            </div>
                                        </div>
                                    @endif
                                    @if ($map == 'google-map')
                                        <div class="inputbox_2 fromGroup has-icon">
                                            <input type="text" id="searchInput" placeholder="Enter a location..."
                                                name="location" value="{{ $oldLocation }}" />
                                            <div id="google-map" class="d-none"></div>
                                            <div class="icon-badge">
                                                <x-svg.location-icon stroke="{{ $setting->frontend_primary_color }}"
                                                    width="24" height="24" />
                                            </div>
                                        </div>
                                    @endif


                                    {{-- <div class="inputbox_2 fromGroup has-icon">
                                        <select class="rt-selectactive w-100-p" id="country" name="country">
                                            <option {{ request('country') ? '' : 'selected' }} value="">
                                                {{ __('all_country') }}</option>
                                            @foreach ($countries as $country)
                                                <option {{ request('country') == $country->slug ? 'selected' : '' }}
                                                    value="{{ $country->slug }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="icon-badge">
                                            <x-svg.location-icon stroke="{{ $setting->frontend_primary_color }}"
                                                width="24" height="24" />
                                        </div>
                                    </div> --}}
                                    <div class="flex-grow-3 fromGroup has-icon banner-select">
                                        <select class="rt-selectactive w-100-p" name="industry_type" id="industry_type">
                                            <option value="">{{ __('select_one') }}</option>
                                            @foreach ($industry_types as $type)
                                                <option {{ $type->name == request('industry_type') ? 'selected' : '' }}
                                                    value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="icon-badge category-icon">
                                            <x-svg.layer-icon stroke="{{ $setting->frontend_primary_color }}"
                                                width="24" height="24" />
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-0">
                                    <button type="submit" class="btn btn-primary d-block d-md-inline-block ">
                                        {{ __('find_employers') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="candidate-content">
        <div class="container">
            <div class="row">
                <div class="d-flex w-100-p">
                    @if (Request::get('keyword'))
                        <div class="icon-badge">
                            <x-website.company.filter-data-component filter="{{ Request::get('keyword') }}" title="Keyword"
                                onClick="keywordClose()" />
                        </div>
                    @endif
                    @if (Request::get('country'))
                        <div class="icon-badge pl-3">
                            <x-website.company.filter-data-component filter="{{ Request::get('country') }}" title="Country"
                                onClick="countryClose()" />
                        </div>
                    @endif
                    @if (Request::get('industry_type'))
                        <div class="icon-badge pl-3">
                            <x-website.company.filter-data-component filter="{{ Request::get('industry_type') }}"
                                title="Industry Type" onClick="industry_typeClose()" />
                        </div>
                    @endif
                    @if (Request::get('organization_type'))
                        <div class="icon-badge pl-3">
                            <x-website.company.filter-data-component filter="{{ Request::get('organization_type') }}"
                                title="Organization Type" onClick="organization_typeClose()" />
                        </div>
                    @endif
                </div>
                <div class="col-lg-12 rt-mb-24">
                    <div class="joblist-left-content2 rt-pt-50">
                        <form id="formSubmitFilter" action="{{ route('website.company') }}">
                            <div class="d-flex flex-wrap">
                                <div class="flex-grow-1 rt-mb-24">
                                    <button type="button" class="btn btn-primary-50 toggole-colum-classes">
                                        <span class="button-content-wrapper ">
                                            <span class="button-icon align-icon-left">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 21V16" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M17 16H23" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M4 21V14" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M1 14H7" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12 21V12" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M9 8H15" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M20 12V3" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M12 8V3" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M4 10V3" stroke="{{ $setting->frontend_primary_color }}"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            <span class="button-text">
                                                {{ __('filter') }}
                                            </span>
                                        </span>
                                    </button>
                                </div>
                                <div class="flex-grow-0 rt-mb-24">
                                    <div class="joblist-fliter-gorup">
                                        <div class="left-content">
                                            <select class="rt-selectactive gap w-100-p" name="sortBy">
                                                <option value="latest">{{ __('latest') }}</option>
                                                @php
                                                    $sortBy = Request::get('sortBy');
                                                @endphp
                                                <option
                                                    @if (!empty(Request::get('sortBy'))) @if ($sortBy == 'oldest')
                                                selected @endif
                                                    @endif value="oldest">
                                                    {{ __('oldest') }}
                                                </option>
                                            </select>
                                            <select name="perpage" id="perpage" class="rt-selectactive w-100-p">
                                                <option {{ request('perpage') == '12' ? 'selected' : '' }} value="12">
                                                    12 {{ __('per_page') }}</option>
                                                <option {{ request('perpage') == '18' ? 'selected' : '' }} value="18">
                                                    18 {{ __('per_page') }}</option>
                                                <option {{ request('perpage') == '30' ? 'selected' : '' }} value="30">
                                                    30 {{ __('per_page') }}</option>
                                            </select>
                                        </div>
                                        <div class="right-content">
                                            <nav>
                                                <div class="nav" id="nav-tab" role="tablist">
                                                    <button class="nav-link active " id="nav-home-tab"
                                                        data-bs-toggle="tab" data-bs-target="#nav-home" type="button"
                                                        role="tab" aria-controls="nav-home" aria-selected="true"
                                                        onclick="styleSwitch('box')">
                                                        <x-svg.box-icon />
                                                    </button>
                                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                        data-bs-target="#nav-profile" type="button" role="tab"
                                                        aria-controls="nav-profile" aria-selected="false"
                                                        onclick="styleSwitch('list')">
                                                        <x-svg.list-icon />
                                                    </button>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="rt-spacer-10"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 @if (request('organization_type')) @else d-none @endif rt-mb-lg-30"
                    id="toggoleSidebar">
                    <div class="togglesidebr_widget">
                        <form id="form3" action="{{ route('website.company') }}">
                            <div class="sidetbar-widget">
                                <ul>
                                    <li class="d-block">
                                        <div class="jobwidget_tiitle">{{ __('organization_type') }}</div>
                                        <ul class="sub-catagory">
                                            @foreach ($organization_type as $type)
                                                <li class="d-block">
                                                    <div class="form-check from-radio-custom">
                                                        <input class="form-check-input" type="radio"
                                                            name="organization_type" value="{{ $type->name }}"
                                                            id="type{{ $type->id }}"
                                                            @if (request('organization_type') == $type->name) checked @endif>
                                                        <label class="form-check-label pointer text-gray-700 f-size-14"
                                                            for="type{{ $type->id }}">
                                                            {{ $type->name }}
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="@if (request('organization_type')) col-xl-8 @else col-xl-12 @endif" id="togglclass1">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
                                @if ($companies->count() > 0)
                                    @foreach ($companies as $company)
                                        <div
                                            class="@if (request('organization_type')) col-xl-6 @else col-xl-4 @endif col-md-6 fade-in-bottom  condition_class rt-mb-24">
                                            <div class="card jobcardStyle1">
                                                <div class="card-body">
                                                    <div class="rt-single-icon-box">
                                                        <div class="icon-thumb">
                                                            <img src="{{ url($company->logo_url) }}" alt=""
                                                                draggable="false">
                                                        </div>
                                                        <div class="iconbox-content">
                                                            <div class="body-font-1 rt-mb-12"><a
                                                                    href="{{ route('website.employe.details', $company->user->username) }}"
                                                                    class="text-gr2q  ay-900 hover:text-primary-500">{{ $company->user->name }}</a>
                                                            </div>
                                                            <span class="loacton text-gray-400 ">
                                                                <i class="ph-map-pin"></i>
                                                                {{ $company->full_address }}
                                                            </span>
                                                            @if ($company->activejobs !== 0)
                                                                <span class="loacton text-gray-400 ">
                                                                    <i class="ph-suitcase-simple"></i>
                                                                    {{ $company->activejobs }} - {{ __('open_job') }}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="post-info d-flex">
                                                        <div class="flex-grow-1">
                                                            @if ($company->activejobs == 0)
                                                                <button type="button"
                                                                    class="btn btn-primary2-50 d-block bg-secondary text-light">
                                                                    <div class="button-content-wrapper ">
                                                                        <span class="button-text">
                                                                            {{ __('no_open_position') }}
                                                                        </span>
                                                                    </div>
                                                                </button>
                                                            @else
                                                                <a
                                                                    href="{{ route('website.job', 'company=' . $company->user->username) }}">
                                                                    <button type="button"
                                                                        class="btn btn-primary2-50 d-block">
                                                                        <div class="button-content-wrapper ">
                                                                            <span class="button-icon align-icon-right">
                                                                                <i class="ph-arrow-right"></i>
                                                                            </span>
                                                                            <span class="button-text">
                                                                                {{ __('open_position') }}
                                                                            </span>
                                                                        </div>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <div class="card text-center">
                                            <x-not-found message="{{ __('no_data_found') }}" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="rt-pt-30">
                                <nav>
                                    {{ $companies->links('vendor.pagination.frontend') }}
                                </nav>
                            </div>
                        </div>
                        <div class="tab-pane" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            @if ($companies->count() > 0)
                                @foreach ($companies as $company)
                                    <div class="card jobcardStyle1 body-24 rt-mb-24">
                                        <div class="card-body">
                                            <div class="rt-single-icon-box ">
                                                <div class="icon-thumb">
                                                    <img src="{{ url($company->logo_url) }}" alt=""
                                                        draggable="false">
                                                </div>
                                                <div class="iconbox-content">
                                                    <div class="post-info2">
                                                        <div class="post-main-title"> <a
                                                                href="{{ route('website.employe.details', $company->user->username) }}">{{ $company->user->name }}</a>
                                                        </div>
                                                        <div class="body-font-4 text-gray-600 pt-2">
                                                            <span class="info-tools">
                                                                <svg width="22" height="22" viewBox="0 0 22 22"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M19.25 9.16699C19.25 15.5837 11 21.0837 11 21.0837C11 21.0837 2.75 15.5837 2.75 9.16699C2.75 6.97896 3.61919 4.88054 5.16637 3.33336C6.71354 1.78619 8.81196 0.916992 11 0.916992C13.188 0.916992 15.2865 1.78619 16.8336 3.33336C18.3808 4.88054 19.25 6.97896 19.25 9.16699Z"
                                                                        stroke="#C5C9D6" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path
                                                                        d="M11 11.917C12.5188 11.917 13.75 10.6858 13.75 9.16699C13.75 7.64821 12.5188 6.41699 11 6.41699C9.48122 6.41699 8.25 7.64821 8.25 9.16699C8.25 10.6858 9.48122 11.917 11 11.917Z"
                                                                        stroke="#C5C9D6" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>

                                                                {{ $company->full_address }}
                                                            </span>
                                                            <span class="info-tools">
                                                                <svg width="22" height="22" viewBox="0 0 22 22"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M18.563 6.1875H3.43799C3.05829 6.1875 2.75049 6.4953 2.75049 6.875V17.875C2.75049 18.2547 3.05829 18.5625 3.43799 18.5625H18.563C18.9427 18.5625 19.2505 18.2547 19.2505 17.875V6.875C19.2505 6.4953 18.9427 6.1875 18.563 6.1875Z"
                                                                        stroke="#C5C9D6" stroke-width="1.3"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path
                                                                        d="M14.4375 6.1875V4.8125C14.4375 4.44783 14.2926 4.09809 14.0348 3.84023C13.7769 3.58237 13.4272 3.4375 13.0625 3.4375H8.9375C8.57283 3.4375 8.22309 3.58237 7.96523 3.84023C7.70737 4.09809 7.5625 4.44783 7.5625 4.8125V6.1875"
                                                                        stroke="#C5C9D6" stroke-width="1.3"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path
                                                                        d="M19.2506 10.8545C16.7432 12.3052 13.8967 13.0669 10.9999 13.0623C8.10361 13.0669 5.25759 12.3054 2.75049 10.8552"
                                                                        stroke="#C5C9D6" stroke-width="1.3"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M9.96875 10.3125H12.0312" stroke="#C5C9D6"
                                                                        stroke-width="1.3" stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                </svg>

                                                                {{ $company->activejobs }} - {{ __('open_job') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="iconbox-extra align-self-center">
                                                    <div>
                                                        @if ($company->activejobs !== 0)
                                                            <a
                                                                href="{{ route('website.job', 'company=' . $company->user->username) }}">
                                                                <button type="button" class="btn btn-primary2-50">
                                                                    <div class="button-content-wrapper ">
                                                                        <span class="button-icon align-icon-right">
                                                                            <i class="ph-arrow-right"></i>
                                                                        </span>
                                                                        <span class="button-text">
                                                                            {{ __('open_position') }}
                                                                        </span>
                                                                    </div>
                                                                </button>
                                                            </a>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-primary2-50 bg-secondary text-light">
                                                                <div class="button-content-wrapper ">
                                                                    <span class="button-text">
                                                                        {{ __('no_open_position') }}
                                                                    </span>
                                                                </div>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <x-not-found message="{{ __('no_data_found') }}" />
                                    </div>
                                </div>
                            @endif
                            @if (request('perpage') != 'all')
                                <div class="rt-pt-30">
                                    <nav>
                                        {{ $companies->links('vendor.pagination.frontend') }}
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rt-spacer-100 rt-spacer-md-50"></div>

        {{-- Subscribe Newsletter --}}
        <x-website.subscribe-newsletter />
    @endsection

    @push('frontend_links')
        <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/style.css') }}">
    @endpush

    @push('frontend_scripts')
        <script>
            var style = localStorage.getItem("company_style") == null ? 'box' : localStorage.getItem("company_style");
            setStyle(style);

            function styleSwitch(companystyle) {
                localStorage.setItem("company_style", companystyle);
                setStyle(companystyle);
            }

            function setStyle(style) {
                if (style == 'box') {
                    $('#nav-home-tab').addClass('active');
                    $('#nav-home').addClass('show active');
                    $('#nav-profile-tab').removeClass('active');
                    $('#nav-profile').removeClass('show active');
                } else {
                    $('#nav-home-tab').removeClass('active');
                    $('#nav-home').removeClass('show active');
                    $('#nav-profile-tab').addClass('active');
                    $('#nav-profile').addClass('show active');
                }
            }
        </script>
        <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
        <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>

        <script>
            mapboxgl.accessToken = "{{ $setting->map_box_key }}";
            const geocoder = new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                types: 'country,region,place,postcode,locality,neighborhood'
            });
            geocoder.addTo('#geocoder');
            // Add geocoder result to container.
            geocoder.on('result', (e) => {
                console.log(e.result.center);
                var full_address = e.result.place_name;
                var words = full_address.split(",");
                var country = words.pop();
                var place = words.pop();
                const text = place + ',' + country;
                $('#insertlocation').val(text);
                $('#lat').val(e.result.center[1]);
                $('#long').val(e.result.center[0]);
            });
            // Clear results container when search is cleared.
            geocoder.on('clear', () => {
                results.innerText = '';
            });
        </script>
        <script>
            $('.mapboxgl-ctrl-geocoder--icon').hide();
            $('.mapboxgl-ctrl-geocoder--input').attr("placeholder", "Location");
            var oldLocation = "{!! $oldLocation !!}";
            if (oldLocation) {
                $('.mapboxgl-ctrl-geocoder--input').val(oldLocation);
            }
        </script>
        <!-- ============== gooogle map ========== -->
        <script>
            function initMap() {
                var token = "{{ $setting->google_map_key }}";
                var oldlat = {{ Session::has('location') ? Session::get('location')['lat'] : setting('default_lat') }};
                var oldlng = {{ Session::has('location') ? Session::get('location')['lng'] : setting('default_long') }};
                const map = new google.maps.Map(document.getElementById("google-map"), {
                    zoom: 7,
                    center: {
                        lat: oldlat,
                        lng: oldlng
                    },
                });
                // Search
                var input = document.getElementById('searchInput');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);
                var infowindow = new google.maps.InfoWindow();
                var marker = new google.maps.Marker({
                    map: map,
                    anchorPoint: new google.maps.Point(0, -29)
                });
                autocomplete.addListener('place_changed', function() {
                    infowindow.close();
                    marker.setVisible(false);
                    var place = autocomplete.getPlace();
                    const total = place.address_components.length;
                    let amount = '';
                    if (total > 1) {
                        amount = total - 2;
                    }
                    const result = place.address_components.slice(amount);
                    let country = '';
                    let region = '';
                    for (let index = 0; index < result.length; index++) {
                        const element = result[index];
                        if (element.types[0] == 'country') {
                            country = element.long_name;
                        }
                        if (element.types[0] == 'administrative_area_level_1') {
                            const str = element.long_name;
                            const first = str.split(',').shift()
                            region = first;
                        }
                    }
                    const text = region + ',' + country;
                    $('#insertlocation').val(text);
                    $('#lat').val(place.geometry.location.lat());
                    $('#long').val(place.geometry.location.lng());
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                });
            }
            window.initMap = initMap;
        </script>
        <script>
            @php
                $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
                $link2 = $setting->google_map_key;
                $Link3 = '&callback=initMap&libraries=places,geometry';
                $scr = $link1 . $link2 . $Link3;
            @endphp;
        </script>
        <script src="{{ $scr }}" async defer></script>
    @endpush
    @section('script')
        <script>
            $('#form3').on('change', function() {
                this.submit();
            });

            function keywordClose() {
                $('#keyword').val('');
                $('#formSubmit').submit();
            }

            function countryClose() {
                $('#country').find('option:selected').remove().end().filter('[value=""]')
                    .attr('selected', true);
                $('#formSubmit').submit();
            }

            function industry_typeClose() {
                $('#industry_type').find('option:selected').remove().end().filter('[value=""]')
                    .attr('selected', true);
                $('#formSubmit').submit();
            }

            function organization_typeClose() {
                $('#organization_type').find('option:selected').remove().end().filter('[value=""]')
                    .attr('selected', true);
                $('#formSubmit').submit();
            }

            $('#formSubmitFilter').on('change', function() {
                this.submit();
            });
        </script>
    @endsection
