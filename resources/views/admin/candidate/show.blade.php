@extends('admin.layouts.app')
@section('title')
    {{ $user->name }} {{ __('details') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">
                        {{ __('details') }}
                    </h3>
                    <a href="{{ route('candidate.index') }}"
                        class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-arrow-left"></i>
                        &nbsp; {{ __('back') }}
                    </a>
                </div>
                <div class="row m-2">
                    <div class="col-md-4">
                        <img src="{{ asset($candidate->photo) }}" alt="image" class="image-fluid" height="350px"
                            width="350px">
                    </div>
                    <div class="col-md-8">
                        <table id="datatable-responsive"
                            class="ml-1 table table-striped     table-bordered dt-responsive nowrap" cellspacing="0"
                            width="100%">
                            <tbody>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('name') }}</th>
                                    <td width="80%">{{ $user->name }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('username') }}</th>
                                    <td width="80%">{{ $user->username }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('email') }}</th>
                                    <td width="80%">{{ $user->email }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('profession') }}</th>
                                    <td width="80%">{{ $candidate->profession ? $candidate->profession->name : '' }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('job_role') }}</th>
                                    <td width="80%">{{ $candidate->jobRole ? $candidate->jobRole->name : '' }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('experience') }}</th>
                                    <td width="80%">{{ $candidate->experience ? $candidate->experience->name : '' }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('education') }}</th>
                                    <td width="80%">{{ $candidate->education ? $candidate->education->name : '' }}
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('gender') }}</th>
                                    <td width="80%">{{ ucfirst($candidate->gender) }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('website') }}</th>
                                    <td width="80%"><a href="{{ $candidate->website }}">{{ $candidate->website }}</a>
                                    </td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{!! __('bio') !!}</th>
                                    <td width="80%">{{ $candidate->bio }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('marital_status') }}</th>
                                    <td width="80%">{{ __($candidate->marital_status) }}</td>
                                </tr>
                                <tr class="mb-5">
                                    <th width="20%">{{ __('birth_date') }}</th>
                                    <td width="80%">{{ date('D, d M Y', strtotime($candidate->birth_date)) }}</td>
                                </tr>
                                @if ($candidate->country)
                                    <tr class="mb-5">
                                        <th width="20%">{{ __('country') }}</th>
                                        <td width="80%">
                                            {{ $candidate->country }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title line-height-36">
                        {{ __('location') }}
                    </h3>
                </div>
                <div class="card-body">
                    <x-website.map.map-warning/>

                    @php
                        $map = setting('default_map');
                    @endphp
                    @if ($map == 'map-box')
                        <div class="map mymap" id='map-box'></div>
                    @endif
                    @if ($map == 'google-map')
                        <div class="map mymap" id="google-map"></div>
                    @endif
                </div>
            </div>
            <x-admin.candidate.card-component title="{{ __('applied_jobs') }}" :jobs="$appliedJobs"
                link="website.job.apply" />
            <x-admin.candidate.card-component title="{{ __('bookmark_jobs') }}" :jobs="$bookmarkJobs"
                link="website.job.bookmark" />
        </div>
    </div>
@endsection

@section('style')
    @include('map::links')
@endsection
@section('script')
    <!-- >=>Mapbox<=< -->
    @include('map::scripts')
    <!-- >=>Mapbox<=< -->
    <!-- ================ mapbox map ============== -->
    <x-website.map.map-box-check/>
    <script>
        mapboxgl.accessToken = "{{ $setting->map_box_key }}";
        const coordinates = document.getElementById('coordinates');

        var oldlat = {!! $candidate->lat ? $candidate->lat : setting('default_lat') !!};
        var oldlng = {!! $candidate->long ? $candidate->long : setting('default_long') !!};

        const map = new mapboxgl.Map({
            container: 'map-box',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [oldlng, oldlat],
            zoom: 6
        });

        var marker = new mapboxgl.Marker({
                draggable: false
            }).setLngLat([oldlng, oldlat])
            .addTo(map);

        function onDragEnd() {
            const lngLat = marker.getLngLat();
            let lat = lngLat.lat;
            let lng = lngLat.lng;
            $('#lat').val(lat);
            $('#lng').val(lng);
            document.getElementById('form').submit();
        }

        function add_marker(event) {
            var coordinates = event.lngLat;
            marker.setLngLat(coordinates).addTo(map);

        }
    </script>
    <script>
        $('.mapboxgl-ctrl-logo').addClass('d-none');
        $('.mapboxgl-ctrl-attrib-inner').addClass('d-none');
    </script>
    <!-- ================ mapbox map ============== -->
    <!-- ================ google map ============== -->
    <x-website.map.google-map-check/>
    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";

            var oldlat = {!! $candidate->lat ? $candidate->lat : setting('default_lat') !!};
            var oldlng = {!! $candidate->long ? $candidate->long : setting('default_long') !!};

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

                draggable: false,
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
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
    <!-- ================ google map ============== -->
@endsection
