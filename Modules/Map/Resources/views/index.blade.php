@extends('admin.layouts.app')
@section('title')
    {{ __('map') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- MAp -->
                <div class="card">
                    <form id="" class="form-horizontal" action="{{ route('module.map.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="line-height: 36px;">{{ __('map') }}
                                </h3>
                            </div>
                        </div>
                        @php
                            $map = setting('default_map');
                        @endphp
                        <!-- ============== for map =============== -->
                        <div class="card-body">
                            <x-website.map.map-warning/>
                            <div id="text-card" class="card-body">
                                <div class="form-group row text-left d-flex justify-content-center align-items-left">
                                    @foreach ($errors->all() as $error)
                                        <div class="col-sm-12 col-md-6 text-left text-md-center">
                                            <div class="text-left alert alert-danger alert-dismissible">
                                                {{ $error }}<br />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group row text-center d-flex align-items-center">
                                    <div class="col-sm-12 col-md-6 text-left text-md-center">
                                        <x-forms.label name="map_type" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <select name="map_type" class="form-control @error('map_type') is-invalid @enderror"
                                            id="">
                                            <option {{ setting('default_map') == 'map-box' ? 'selected' : '' }}
                                                value="map-box">
                                                {{ __('map-box') }}
                                            </option>
                                            <option {{ setting('default_map') == 'google-map' ? 'selected' : '' }}
                                                value="google-map">
                                                {{ __('google-map') }}
                                            </option>
                                        </select>
                                        @error('map_type')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- long -->
                                <div class="d-none">
                                    <div class="col-sm-12 col-md-6 text-left text-md-center">
                                        <x-forms.label name="default_long" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <input value="{{ setting('default_long') }}" name="default_long" type="text"
                                            class="form-control @error('default_long') is-invalid @enderror"
                                            autocomplete="off" placeholder="{{ __('default_long') }}">
                                        @error('default_long')
                                            <span class="text-left invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Lat  -->
                                <div class="d-none">
                                    <div class="col-sm-12 col-md-6">
                                        <x-forms.label name="default_lat" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6 text-left text-md-center">
                                        <input value="{{ setting('default_lat') }}" name="default_lat" type="text"
                                            class="form-control @error('default_lat') is-invalid @enderror"
                                            autocomplete="off" placeholder="{{ __('default_lat') }}">
                                        @error('default_lat')
                                            <span class="text-left invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- map-box key  -->
                                <div id="mapbox_key" class="{{ $map == 'map-box' ? '' : 'd-none' }} ">
                                    <div class="pt-4 form-group row text-center d-flex align-items-center">
                                        <div class="col-sm-12 col-md-6">
                                            <x-forms.label name="your_map_box_key" class="" />
                                        </div>
                                        <div class="col-sm-12 col-md-6 text-left text-md-center">
                                            <input value="{{ $setting->map_box_key }}" name="map_box_key" type="text"
                                                class="form-control @error('map_box_key') is-invalid @enderror"
                                                autocomplete="off" placeholder="{{ __('your_map_box_key') }}">
                                            @error('map_box_key')
                                                <span class="text-left invalid-feedback"
                                                    role="alert"><span>{{ $message }}</span></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- google map key  -->
                                <div id="googlemap_key" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                    <div class="pt-4 form-group row text-center d-flex align-items-center">
                                        <div class="col-sm-12 col-md-6">
                                            <x-forms.label name="your_google_map_key" class="" />
                                        </div>
                                        <div class="col-sm-12 col-md-6 text-left text-md-center">
                                            <input value="{{ $setting->google_map_key }}" name="google_map_key"
                                                type="text"
                                                class="form-control @error('google_map_key') is-invalid @enderror"
                                                autocomplete="off" placeholder="{{ __('your_google_map_key') }}">
                                            @error('google_map_key')
                                                <span class="text-left invalid-feedback"
                                                    role="alert"><span>{{ $message }}</span></span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- example map  -->
                                <div class="pt-4 form-group row text-center d-flex align-items-center">
                                    <div class="col-sm-12 col-md-6 text-left text-md-center">
                                        <x-forms.label name="example_map" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}" id='map-box'>
                                        </div>
                                        <div id="google-map-div" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                            <input id="searchInput" class="mapClass" type="text"
                                                placeholder="Enter a location">
                                            <div class="map mymap" id="google-map"></div>
                                        </div>
                                        @error('location')
                                            <span class="text-md text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row pb-3">
                                <div class="offset-sm-5 col-sm-7">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- >=>Mapbox<=< -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
    <link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
    <style>
        .mymap {
            width: 100%;
            min-height: 300px;
            border-radius: 12px;
        }

        .p-half {
            padding: 1px;
        }

        .mapClass {
            border: 1px solid transparent;
            margin-top: 15px;
            border-radius: 4px 0 0 4px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 35px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #searchInput {
            font-family: 'Roboto';
            background-color: #fff;
            font-size: 16px;
            text-overflow: ellipsis;
            margin-left: 16px;
            font-weight: 400;
            width: 30%;
            padding: 0 11px 0 13px;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }
    </style>
    <!-- >=>Mapbox<=< -->
@endsection

@section('script')
    <!-- >=>Mapbox<=< -->
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
    <script src="{{ asset('frontend') }}/assets/js/axios.min.js"></script>

    <!-- >=>Mapbox<=< -->
    <x-website.map.map-box-check/>
    <script>
        var token = "{{ $setting->map_box_key }}";
        mapboxgl.accessToken = token;
        const coordinates = document.getElementById('coordinates');

        var oldlat = {{ setting('default_lat') }};
        var oldlng = {{ setting('default_long') }};

        const map = new mapboxgl.Map({
            container: 'map-box',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [oldlng, oldlat],
            zoom: 6
        });
        // Add the control to the map.
        map.addControl(
            new MapboxGeocoder({
                accessToken: mapboxgl.accessToken,
                mapboxgl: mapboxgl,
                marker: false,
            })
        );
        // Add the control to the map.
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            marker: {
                color: 'orange',
                draggable: true
            },
            mapboxgl: mapboxgl
        });
        var marker = new mapboxgl.Marker({
                draggable: true
            }).setLngLat([oldlng, oldlat])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            let lat = lngLat.lat;
            let lng = lngLat.lng;
            $('input[name="default_lat"]').val(lat);
            $('input[name="default_long"]').val(lng);

        }

        function add_marker(event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);

        }
        map.on('style.load', function() {
            map.on('click', function(e) {
                var coordinates = e.lngLat;
                let lat = parseFloat(coordinates.lat);
                let lng = parseFloat(coordinates.lng);
                $('input[name="default_lat"]').val(lat);
                $('input[name="default_long"]').val(lng);

            });
        });
        map.on('click', add_marker);
        marker.on('dragend', onDragEnd);
    </script>
    <script>
        $('.mapboxgl-ctrl-logo').addClass('d-none');
        $('.mapboxgl-compact').addClass('d-none');
        $('.mapboxgl-ctrl-attrib-inner').addClass('d-none');
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle=tooltip]").tooltip()
        })
        $('.suggestions').addClass('text-left');
    </script>
    <!-- =============== google map ========== -->
    <x-website.map.google-map-check/>
    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";
            var oldlat = {{ setting('default_lat') }};
            var oldlng = {{ setting('default_long') }};

            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 7,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });

            const image =
                "https://gisgeography.com/wp-content/uploads/2018/01/map-marker-3-116x200.png";
            const beachMarker = new google.maps.Marker({

                draggable: true,
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
            });

            google.maps.event.addListener(map, 'click',
                function(event) {
                    pos = event.latLng
                    beachMarker.setPosition(pos);
                    let lat = beachMarker.position.lat();
                    let lng = beachMarker.position.lng();

                    $('input[name="default_lat"]').val(lat);
                    $('input[name="default_long"]').val(lng);
                });

            google.maps.event.addListener(beachMarker, 'dragend',
                function() {
                    let lat = beachMarker.position.lat();
                    let lng = beachMarker.position.lng();

                    $('input[name="default_lat"]').val(lat);
                    $('input[name="default_long"]').val(lng);
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
    <script>
        $('select[name="map_type"]').on('change', function() {
            var value = $(this).val();
            if (value == 'google-map') {
                $('#google-map-div').removeClass('d-none');
                $('#googlemap_key').removeClass('d-none');
                $('#map-box').addClass('d-none');
                $('#mapbox_key').addClass('d-none');
            } else {
                $('#map-box').removeClass('d-none');
                $('#mapbox_key').removeClass('d-none');
                setTimeout(() => {
                    map.resize();
                }, 200);
                $('#google-map-div').addClass('d-none');
                $('#googlemap_key').addClass('d-none');
            }
        })
    </script>
@endsection
