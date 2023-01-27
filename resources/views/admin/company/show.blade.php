@extends('admin.layouts.app')
@section('title')
    {{ __($company->user->name) }}
@endsection

@section('content')

    @php
    $userr = auth()->user();
    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ $company->user->name }}'s
                            {{ __('details') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="row m-2">
                            <div class="col-md-4 col-sm-3">
                                <img src="{{ asset($company->logo_url) }}" alt="image" class="image-fluid mr-2 object-fit-cover"
                                    height="340px" width="340px">
                            </div>
                            <div class="col-md-8">
                                <table id="datatable-responsive"
                                    class="ml-1 table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                    width="100%">
                                    <tbody>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('name') }}</th>
                                            <td width="80%">{{ $company->user->name }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('username') }}</th>
                                            <td width="80%">{{ $company->user->username }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('email') }}</th>
                                            <td width="80%">{{ $company->user->email }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('organization_type') }}</th>
                                            <td width="80%">
                                                {{ $company->organization ? $company->organization->name : '' }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('nationality') }}</th>
                                            <td width="80%">
                                                {{ $company->nationality ? $company->nationality->name : '' }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('establishment_date') }}</th>
                                            <td width="80%">
                                                {{ $company->establishment_date ? date('j F, Y', strtotime($company->establishment_date)):'' }}
                                            </td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('team_size') }}</th>
                                            <td width="80%">{{ $company->team_size ? $company->team_size->name : '' }}
                                            </td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('industry_type') }}</th>
                                            <td width="80%">{{ $company->industry ? $company->industry->name : '' }}
                                            </td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('address') }}</th>
                                            <td width="80%"><a
                                                    href="{{ $company->user->contactInfo->map_address }}">{{ $company->user->contactInfo->address }}</a>
                                            </td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('contact_email') }}</th>
                                            <td width="80%">{{ $company->user->contactInfo->email }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('phone') }}</th>
                                            <td width="80%">{{ $company->user->contactInfo->phone }}</td>
                                        </tr>
                                        <tr class="mb-5">
                                            <th width="20%">{{ __('social_profile') }}</th>
                                            <td width="80%">
                                                @if (!empty($company->user->socialInfo->facebook) && $company->user->socialInfo->facebook !== null)
                                                    <a class="d-inline-block m-2"
                                                        href="{{ url($company->user->socialInfo->facebook) }}">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                @endif
                                                @if (!empty($company->user->socialInfo->twitter) && $company->user->socialInfo->twitter !== null)
                                                    <a class="d-inline-block m-2"
                                                        href="{{ url($company->user->socialInfo->twitter) }}">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                @endif
                                                @if (!empty($company->user->socialInfo->instagram) && $company->user->socialInfo->instagram !== null)
                                                    <a class="d-inline-block m-2"
                                                        href="{{ url($company->user->socialInfo->instagram) }}">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                @endif
                                                @if (!empty($company->user->socialInfo->youtube) && $company->user->socialInfo->youtube !== null)
                                                    <a class="d-inline-block m-2"
                                                        href="{{ url($company->user->socialInfo->youtube) }}">
                                                        <i class="fab fa-youtube"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="text-center text-bold">
                                {{ __('description') }}
                            </div>
                        </div>
                        <hr>
                        <div class="col-10 m-auto pb-4">
                            {!! nl2br($company->bio) !!}
                        </div>
                        <div class="col-12">
                            <div class="text-center text-bold">
                                {{ __('vision') }}
                            </div>
                        </div>
                        <hr>
                        <div class="col-10 m-auto pb-4">
                            {!! nl2br($company->vision) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('location') }}</h3>
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
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('company_joblist') }}</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="2%">#</th>
                                            <th width="5%">{{ __('title') }}</th>
                                            <th width="10%">{{ __('experience') }}</th>
                                            <th width="10%">{{ __('job_type') }}</th>
                                            <th width="10%">{{ __('deadline') }}</th>
                                            <th width="10%">{{ __('status') }}</th>
                                            @if ($userr->can('job_category.edit') || $userr->can('job_category.delete'))
                                                <th width="10%">{{ __('action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($company->jobs->count() > 0)
                                            @foreach ($company->jobs as $job)
                                                <tr>
                                                    <td class="text-center" tabindex="0">
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td class="text-center" tabindex="0">
                                                        {{ $job->title }}
                                                    </td>
                                                    <td class="text-center" tabindex="0">
                                                        {{ $job->experience ? $job->experience->name : '' }}
                                                    </td>
                                                    <td class="text-center" tabindex="0">
                                                        {{ $job->job_type ? $job->job_type->name : '' }}
                                                    </td>
                                                    <td class="text-center" tabindex="0">
                                                        {{ date('j F, Y', strtotime($job->deadline)) }}
                                                    </td>
                                                    <td class="text-center" tabindex="0">
                                                        <div class="d-flex justify-content-center input-group-prepend">
                                                            <button type="button"
                                                                class="btn-sm btn-{{ $job->status == 'active' ? 'success' : ($job->status == 'pending' ? 'info' : 'danger') }} dropdown-toggle"
                                                                data-toggle="dropdown">
                                                                {{ __($job->status) }}
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="active">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('active') }}</span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="pending">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('pending') }}</span>
                                                                    </button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="status" value="expired">
                                                                    <button type="submit"
                                                                        class="btn bg-white text-left w-100-p"><span
                                                                            class="text-primary">{{ __('expired') }}</span>
                                                                    </button>
                                                                </form>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('job.show', $job->id) }}"
                                                            class="btn bg-info ml-1"><i class="fas fa-eye"></i></a>

                                                        <a href="{{ route('job.edit', $job->id) }}"
                                                            class="btn bg-info ml-1"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('job.destroy', $job->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('Are you sure you want to delete this item?');"
                                                                class="btn bg-danger ml-1"><i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">{{ __('no_data_found') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    @include('map::links')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            validate();
            $('#title').keyup(validate);
        });

        function validate() {
            if (
                $('#title').val().length > 0) {
                $('#crossB').removeClass('d-none');
            } else {
                $('#crossB').addClass('d-none');
            }
        }

        function RemoveFilter(id) {
            $('#' + id).val('');
            $('#formSubmit').submit();
        }
    </script>
    <!-- >=>Mapbox<=< -->
    @include('map::scripts')
    <!-- >=>Mapbox<=< -->
    <!-- ================ mapbox map ============== -->
    <x-website.map.map-box-check/>

    <script>
        mapboxgl.accessToken = "{{ $setting->map_box_key }}";
        const coordinates = document.getElementById('coordinates');

        var oldlat = {!! $company->lat ? $company->lat : setting('default_lat') !!};
        var oldlng = {!! $company->long ? $company->long : setting('default_long') !!};

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

            var oldlat = {!! $company->lat ? $company->lat : setting('default_lat') !!};
            var oldlng = {!! $company->long ? $company->long : setting('default_long') !!};

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
