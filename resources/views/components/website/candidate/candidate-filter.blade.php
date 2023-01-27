@props(['countries', 'professions', 'experiences', 'educations'])

<form id="form" action="{{ route('website.candidate') }}" method="GET">
    <div class="breadcrumbs style-two">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-12 position-relative ">
                    <div class="breadcrumb-menu mb-4">
                        <h6 class="f-size-18 m-0">{{ __('find_candidates') }}</h6>
                        <ul>
                            <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                            <li>/</li>
                            <li>{{ __('candidates') }}</li>
                        </ul>
                    </div>
                    <div class="jobsearchBox  bg-gray-10 input-transparent height-auto-lg">
                        <div class="top-content d-flex flex-column flex-lg-row align-items-center">
                            <div class="inputbox_1 fromGroup has-icon">
                                <input type="text"
                                    @if (request('keyword')) value="{{ request('keyword') }}" @endif
                                    name="keyword" placeholder="{{ __('job_title_keyword') }}">
                                <div class="icon-badge">
                                    <x-svg.search-icon stroke="{{ $setting->frontend_primary_color }}" width="24"
                                        height="24" />
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
                            <div class="flex-grow-3 fromGroup has-icon banner-select">
                                <select class="rt-selectactive w-100-p" name="profession">
                                    <option value="" class="d-none">{{ __('select_profession') }}</option>
                                    @foreach ($professions as $profession)
                                        <option {{ $profession->name == request('profession') ? 'selected' : '' }}
                                            value="{{ $profession->name }}">
                                            {{ $profession->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="icon-badge category-icon">
                                    <x-svg.layer-icon stroke="{{ $setting->frontend_primary_color }}" width="24"
                                        height="24" />
                                </div>
                            </div>
                            <div class="flex-grow-0 rt-pt-md-20">
                                <button
                                    class="btn btn-primary d-block d-md-inline-block ">{{ __('find_job') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="candidate-content">
        <div class="container">
            <!-- ============ Filter Old Data ==========  -->
            <div class="d-flex w-100-p">
                @if (Request::get('keyword'))
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Keyword" filter="{{ request('keyword') }}" />
                    </div>
                @endif
                @if (Request::get('country'))
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Country" filter="{{ request('country') }}" />
                    </div>
                @endif
                @if (Request::get('sortby') && Request::get('sortby') != 'latest')
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Sortby" filter="{{ request('sortby') }}" />
                    </div>
                @endif
                @if (Request::get('profession') && Request::get('profession') != null)
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Profession"
                            filter="{{ request('profession') }}" />
                    </div>
                @endif
                @if (Request::get('experience') && Request::get('experience') != 'all')
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Experience"
                            filter="{{ request('experience') }}" />
                    </div>
                @endif
                @if (Request::get('gender') && Request::get('gender') != 'all')
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Gender" filter="{{ request('gender') }}" />
                    </div>
                @endif
                @if (Request::get('education') && Request::get('education') != 'all')
                    <div class="rt-mr-2 icon-badge mt-3">
                        <x-website.candidate.filter-data-component title="Education"
                            filter="{{ request('education') }}" />
                    </div>
                @endif
            </div>
            <!-- ============ Filter Old Data End ==========  -->
            <div class="row">
                <div class="col-lg-12 rt-mb-24">
                    <div class="joblist-left-content2 rt-pt-50">
                        <div class="d-flex flex-column flex-md-row">
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
                                        <select name="sortby" id="sortby" class="rt-selectactive gap w-100-p">
                                            <option value="latest">{{ __('latest') }}</option>
                                            <option {{ request('sortby') == 'oldest' ? 'selected' : '' }}
                                                value="oldest">{{ __('oldest') }}</option>
                                        </select>
                                        {{-- <select name="perpage" id="perpage" class="rt-selectactive w-100-p">
                                            <option {{ request('perpage') == '12' ? 'selected' : '' }} value="12">
                                                12
                                                {{ __('per_page') }}
                                            </option>
                                            <option {{ request('perpage') == '18' ? 'selected' : '' }} value="18">
                                                18
                                                {{ __('per_page') }}
                                            </option>
                                            <option {{ request('perpage') == '30' ? 'selected' : '' }} value="30">
                                                30
                                                {{ __('per_page') }}
                                            </option>
                                        </select> --}}
                                    </div>
                                    <div class="right-content">
                                        <nav>
                                            <div class="nav" id="nav-tab" role="tablist">
                                                <button onclick="styleSwitch('box')" class="nav-link active "
                                                    id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                                                    type="button" role="tab" aria-controls="nav-home"
                                                    aria-selected="true">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8 3H4C3.44772 3 3 3.44772 3 4V8C3 8.55228 3.44772 9 4 9H8C8.55228 9 9 8.55228 9 8V4C9 3.44772 8.55228 3 8 3Z"
                                                            fill="#191F33" />
                                                        <path
                                                            d="M16 3H12C11.4477 3 11 3.44772 11 4V8C11 8.55228 11.4477 9 12 9H16C16.5523 9 17 8.55228 17 8V4C17 3.44772 16.5523 3 16 3Z"
                                                            fill="#191F33" />
                                                        <path
                                                            d="M16 11H12C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            fill="#191F33" />
                                                        <path
                                                            d="M8 11H4C3.44772 11 3 11.4477 3 12V16C3 16.5523 3.44772 17 4 17H8C8.55228 17 9 16.5523 9 16V12C9 11.4477 8.55228 11 8 11Z"
                                                            fill="#191F33" />
                                                    </svg>
                                                </button>
                                                <button onclick="styleSwitch('list')" class="nav-link"
                                                    id="nav-profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#nav-profile" type="button" role="tab"
                                                    aria-controls="nav-profile" aria-selected="false">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16 3H4C3.44772 3 3 3.44772 3 4V8C3 8.55228 3.44772 9 4 9H16C16.5523 9 17 8.55228 17 8V4C17 3.44772 16.5523 3 16 3Z"
                                                            fill="#939AAD" />
                                                        <path
                                                            d="M16 3H12C11.4477 3 11 3.44772 11 4V8C11 8.55228 11.4477 9 12 9H16C16.5523 9 17 8.55228 17 8V4C17 3.44772 16.5523 3 16 3Z"
                                                            fill="#939AAD" />
                                                        <path
                                                            d="M16 11H12C11.4477 11 11 11.4477 11 12V16C11 16.5523 11.4477 17 12 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            fill="#939AAD" />
                                                        <path
                                                            d="M16 11H4C3.44772 11 3 11.4477 3 12V16C3 16.5523 3.44772 17 4 17H16C16.5523 17 17 16.5523 17 16V12C17 11.4477 16.5523 11 16 11Z"
                                                            fill="#939AAD" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="rt-spacer-10"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 @if (request('education') || request('gender') || request('experience')) @else d-none @endif rt-mb-lg-30"
                    id="toggoleSidebar">
                    <div class="togglesidebr_widget">
                        <div class="sidetbar-widget">
                            <ul>
                                <li class="d-block has-children open">
                                    <div class="jobwidget_tiitle">{{ __('experience') }}</div>
                                    <ul class="sub-catagory">
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input id="experienceall" class="form-check-input"
                                                    {{ request('experience') == 'all' ? 'checked' : '' }}
                                                    type="radio" name="experience" value="all">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="experienceall">
                                                    {{ __('all') }}
                                                </label>
                                            </div>
                                        </li>
                                        @foreach ($experiences as $experience)
                                            <li class="d-block">
                                                <div class="form-check from-radio-custom">
                                                    <input class="form-check-input"
                                                        {{ request('experience') == $experience->name ? 'checked' : '' }}
                                                        type="radio" name="experience"
                                                        value="{{ $experience->name }}"
                                                        id="{{ $experience->slug }}">
                                                    <label class="form-check-label pointer text-gray-700 f-size-14"
                                                        for="{{ $experience->slug }}">
                                                        {{ $experience->name }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="d-block has-children open">
                                    <div class="jobwidget_tiitle">{{ __('education') }}</div>
                                    <ul class="sub-catagory">
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input {{ request('education') == 'all' ? 'checked' : '' }}
                                                    name="education" class="form-check-input" type="radio"
                                                    value="all" id="educationall">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="educationall">
                                                    {{ __('all') }}
                                                </label>
                                            </div>
                                        </li>
                                        @foreach ($educations as $education)
                                            <li class="d-block">
                                                <div class="form-check from-radio-custom">
                                                    <input
                                                        {{ request('education') == $education->name ? 'checked' : '' }}
                                                        name="education" class="form-check-input" type="radio"
                                                        value="{{ $education->name }}" id="{{ $education->slug }}">
                                                    <label class="form-check-label pointer text-gray-700 f-size-14"
                                                        for="{{ $education->slug }}">
                                                        {{ $education->name }}
                                                    </label>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="d-block has-children open">
                                    <div class="jobwidget_tiitle">{{ __('gender') }}</div>
                                    <ul class="sub-catagory">
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input {{ request('gender') == 'male' ? 'checked' : '' }}
                                                    name="gender" class="form-check-input" value="male"
                                                    type="radio" id="gender1">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="gender1">
                                                    {{ __('male') }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input {{ request('gender') == 'female' ? 'checked' : '' }}
                                                    name="gender" class="form-check-input" value="female"
                                                    type="radio" id="gender2">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="gender2">
                                                    {{ __('female') }}
                                                </label>
                                            </div>
                                        </li>
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input {{ request('gender') == 'other' ? 'checked' : '' }}
                                                    name="gender" class="form-check-input" value="other"
                                                    type="radio" id="gender3">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="gender3">
                                                    {{ __('others') }}
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
</form>

@section('frontend_links')
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/style.css') }}">
@endsection

@section('frontend_scripts')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $('input[type=radio]').on('change', function() {
            $('#form').submit();
        });
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
@endsection
