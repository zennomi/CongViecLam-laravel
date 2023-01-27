@props(['countries', 'categories', 'jobRoles', 'min_salary', 'max_salary', 'experiences', 'educations', 'jobTypes'])

<div class="breadcrumbs style-two">
    <div class="container">
        <div class="row align-items-center ">
            <div class="col-12 position-relative ">
                <div class="breadcrumb-menu mb-4">
                    <h6 class="f-size-18 m-0">{{ __('find_job') }}</h6>
                    <ul>
                        <li><a href="{{ route('website.home') }}">{{ __('home') }}</a></li>
                        <li>/</li>
                        <li>{{ __('find_job') }}</li>
                    </ul>
                </div>
            </div>

            <div class="col-12 position-relative ">
                <div class="jobsearchBox  bg-gray-10 input-transparent with-advanced-filter height-auto-xl">
                    <div class="top-content d-flex flex-column flex-xl-row">
                        <div class="left-content">
                            <div class="search-col-4 fromGroup has-icon position-relative">
                                <input id="search" name="keyword" type="text"
                                    placeholder="{{ __('job_title_keyword') }}" value="{{ request('keyword') }}"
                                    autocomplete="off">
                                <div class="icon-badge">
                                    <x-svg.search-icon />
                                </div>
                                <span id="autocomplete_job_results"></span>
                            </div>

                            <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}">
                            <input type="hidden" name="long" id="long" value="{{ request('long') }}">
                            @php
                                $oldLocation = request('location');
                                $map = setting('default_map');
                            @endphp
                            @if ($map == 'map-box')
                                <input type="hidden" name="location" id="insertlocation"
                                    value="{{ request('location') }}">
                                <div class="search-col fromGroup has-icon banner-select no-border">
                                    <span id="geocoder"></span>
                                    <div class="icon-badge">
                                        <x-svg.location-icon width="24" height="24"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </div>
                                </div>
                            @endif
                            @if ($map == 'google-map')
                                <div class="search-col fromGroup has-icon banner-select no-border">
                                    <input type="text" id="searchInput" placeholder="Enter a location..."
                                        name="location" value="{{ request('location') }}" />

                                    <div id="google-map" class="d-none"></div>
                                    <div class="icon-badge">
                                        <x-svg.location-icon width="24" height="24"
                                            stroke="{{ $setting->frontend_primary_color }}" />
                                    </div>
                                </div>
                            @endif

                            <div class="search-col fromGroup has-icon banner-select no-border">
                                <select class="rt-selectactive" name="category">
                                    <option {{ request('category') ? '' : 'selected' }} value="">
                                        {{ __('all_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option {{ request('category') == $category->name ? 'selected' : '' }}
                                            value="{{ $category->name }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="icon-badge">
                                    <x-svg.layer-icon />

                                </div>
                            </div>
                            <div class="search-col fromGroup has-icon banner-select no-border">
                                <select class="rt-selectactive" name="job_role">
                                    <option {{ request('job_role') ? '' : 'selected' }} value="">
                                        {{ __('job_role') }}</option>
                                    @foreach ($jobRoles as $role)
                                        <option {{ request('job_role') == $role->name ? 'selected' : '' }}
                                            value="{{ $role->name }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="icon-badge">
                                    <x-svg.layer-icon />
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow-0">
                            <button type="submit"
                                class="btn btn-primary d-block d-md-inline-block ">{{ __('find_job') }}</button>
                        </div>
                    </div>

                    <div class="advance-hidden-filter-menu">
                        <ul>
                            <li class="d-block ">
                                <div class="jobwidget_tiitle2">{{ __('experience') }}</div>
                                <ul class="sub-catagory2">
                                    <li class="d-block">
                                        <div class="form-check from-radio-custom">
                                            <input {{ request('experience') ? '' : 'checked' }} value=""
                                                class="form-check-input" type="radio" name="experience"
                                                id="cr_1">
                                            <label class="form-check-label pointer text-gray-700 f-size-14"
                                                for="cr_1">
                                                {{ __('all') }}
                                            </label>
                                        </div>
                                    </li>
                                    @foreach ($experiences as $experience)
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input
                                                    {{ request('experience') == $experience->name ? 'checked' : '' }}
                                                    value="{{ $experience->name }}" class="form-check-input"
                                                    type="radio" name="experience" id="{{ $experience->slug }}">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="{{ $experience->slug }}">
                                                    {{ $experience->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="d-block ">
                                <div class="jobwidget_tiitle2">{{ __('salary') }}</div>
                                <ul class="sub-catagory2">
                                    <input type="hidden" name="price_min" id="price_min">
                                    <input type="hidden" name="price_max" id="price_max">
                                    <div id="priceCollapse" class="accordion-collapse collapse show mt-2"
                                        aria-labelledby="priceTag" data-bs-parent="#accordionGroup">
                                        <div class="accordion-body list-sidebar__accordion-body">
                                            <div class="price-range-slider">
                                                <div id="priceRangeSlider"></div>
                                            </div>
                                        </div>
                                    </div>

                                </ul>
                            </li>
                            <li class="d-block ">
                                <div class="jobwidget_tiitle2">{{ __('education') }}</div>
                                <ul class="sub-catagory2">
                                    <li class="d-block">
                                        <div class="form-check from-radio-custom">
                                            <input {{ request('education') ? '' : 'checked' }}
                                                class="form-check-input" type="radio" value=""
                                                id="edu01" name="education">
                                            <label class="form-check-label pointer text-gray-700 f-size-14"
                                                for="edu01">
                                                {{ __('all') }}
                                            </label>
                                        </div>
                                    </li>
                                    @foreach ($educations as $education)
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input
                                                    {{ request('education') == $education->name ? 'checked' : '' }}
                                                    class="form-check-input" type="radio"
                                                    value="{{ $education->name }}" name="education"
                                                    id="{{ $education->slug }}">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="{{ $education->slug }}">
                                                    {{ $education->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="d-block ">
                                <div class="jobwidget_tiitle2 mt-2">{{ __('job_type') }}</div>
                                <ul class="sub-catagory2">
                                    <li class="d-block">
                                        <div class="form-check from-radio-custom">
                                            <input {{ request('job_type') ? '' : 'checked' }}
                                                class="form-check-input" type="radio" value=""
                                                name="job_type" id="ck01">
                                            <label class="form-check-label pointer text-gray-700 f-size-14"
                                                for="ck01">
                                                {{ __('all') }}
                                            </label>
                                        </div>
                                    </li>
                                    @foreach ($jobTypes as $type)
                                        <li class="d-block">
                                            <div class="form-check from-radio-custom">
                                                <input {{ request('job_type') == $type->slug ? 'checked' : '' }}
                                                    class="form-check-input" type="radio"
                                                    value="{{ $type->name }}" name="job_type"
                                                    id="{{ $type->name }}">
                                                <label class="form-check-label pointer text-gray-700 f-size-14"
                                                    for="{{ $type->name }}">
                                                    {{ $type->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="d-block ">
                                <div class="jobwidget_tiitle2">{{ __('work_type') }}</div>
                                <ul class="sub-catagory2">
                                    <li class="d-block">
                                        <div class="form-check from-chekbox-custom">
                                            <input {{ request('is_remote') == 1 ? 'checked' : '' }}
                                                class="form-check-input" type="checkbox" value="1"
                                                name="is_remote" id="ck01">
                                            <label class="form-check-label pointer text-gray-700 f-size-14"
                                                for="ck01">
                                                {{ __('remote') }}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('frontend_links')
    <link rel="stylesheet" href="{{ asset('frontend') }}/plugins/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/style.css') }}">
    <style>
        span.select2-container--default .select2-selection--single {
            border: none !important;
        }

        span.select2-selection.select2-selection--single {
            outline: none;
        }

        .noUi-connect {
            background: #0066ff;
        }

        #priceRangeSlider {
            height: 280px;
        }

        .noUi-horizontal .noUi-handle {
            height: 20px;
            width: 20px;
            top: -10px;
            border-radius: 50%;
            border: 2px solid #0066ff;
        }

        .mapboxgl-ctrl {
            z-index: 2 !important;
        }
    </style>
@endpush

@push('frontend_scripts')
    <script src="{{ asset('frontend/plugins/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/nouislider/wNumb.min.js') }}"></script>
    <script>
        // autocomplete
        var path = "{{ route('website.job.autocomplete') }}";

        $('#search').keyup(function(e) {
            var keyword = $(this).val();

            if (keyword != '') {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: keyword
                    },
                    success: function(data) {
                        $('#autocomplete_job_results').fadeIn();
                        $('#autocomplete_job_results').html(data);
                    }
                });
            } else {
                $('#autocomplete_job_results').fadeOut();
            }
        });

        function changeFilter() {
            const slider = document.getElementById('priceRangeSlider')
            const value = slider.noUiSlider.get(true);
            document.getElementById('price_min').value = value[0]
            document.getElementById('price_max').value = value[1]
            const form = $('#job_search_form')
            const data = form.serializeArray();
            $('#job_search_form').submit()
        }

        function setDefaultPriceRangeValue() {
            const slider = document.getElementById('priceRangeSlider')
            slider.noUiSlider.set([{{ request('price_min') }}, {{ request('price_max') }}]);
        }

        $(document).ready(function() {
            const slider = document.getElementById('priceRangeSlider')
            let maxRange = Number.parseInt("{{ $maxSalary ?? 500 }}")
            let minPrice = 0;
            let maxPrice = maxRange;
            @if (request()->has('price_min') && request()->has('price_max'))
                minPrice = Number.parseInt("{{ request('price_min', 0) }}")
                maxPrice = Number.parseInt("{{ request('price_max', 500) }}")
            @endif
            noUiSlider.create(slider, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    min: [0],
                    max: [maxRange],
                },
                format: wNumb({
                    decimals: 2,
                    thousand: ',',
                    suffix: ' ({{ $currency_symbol }})',
                }),
                tooltips: true,
                orientation: 'vertical',
            });

            slider.noUiSlider.on('change', function() {
                changeFilter();
            });

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
            // console.log(e.result.center);
            var full_address = e.result.place_name;
            var words = full_address.split(",");
            var country = words.pop();
            var place = words.pop();
            const text = place + ',' + country;

            $('#insertlocation').val(full_address);
            $('#lat').val(e.result.center[1]);
            $('#long').val(e.result.center[0]);
        });
    </script>
    <script>
        $('.mapboxgl-ctrl-geocoder--icon').hide();
        $('.mapboxgl-ctrl-geocoder--input').attr("placeholder", "Location");
        var oldLocation = "{!! $oldLocation !!}";
        if (oldLocation) {
            $('.mapboxgl-ctrl-geocoder--input').val(oldLocation);
        }

        $(".mapboxgl-ctrl-geocoder--input").change(function() {
            if ($(this).val().length > 0) {
                // ('#insertlocation').val($(this).val());
            } else {
                $('#insertlocation').val($(this).val());
                $('#lat').val('');
                $('#long').val('');
            }
        })
        $("#searchInput").change(function() {
            if ($(this).val().length > 0) {
                // ('#insertlocation').val($(this).val());
            } else {
                $('#insertlocation').val($(this).val());
                $('#lat').val('');
                $('#long').val('');
            }
        })
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
