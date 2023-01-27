@extends('admin.layouts.app')
@section('title')
    {{ __('edit_candidate') }}
@endsection
@section('content')
    @if (userCan('candidate.create'))
        <div class="container-fluid">
            <form action="{{ route('candidate.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title line-height-36">{{ __('edit_candidate') }}</h4>
                        <button type="submit"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-sync"></i>&nbsp;
                            {{ __('save') }}
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                {{ __('account_details') }}
                            </div>
                            <div class="card-body row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <x-forms.label name="name" />
                                        <x-forms.input type="text" name="name" placeholder="name"
                                            value="{{ old('name', $user->name) }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-forms.label name="email" />
                                        <x-forms.input type="email" value="{{ old('email', $user->email) }}"
                                            name="email" placeholder="email" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <x-forms.label name="password" :required="false" />
                                            <x-forms.input type="password" name="password" placeholder="password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                {{ __('location') }}
                                <small class="h6">
                                    ({{ __('click_to_add_a_pointer') }})
                                </small>
                            </div>
                            <div class="card-body">
                                <x-website.map.map-warning/>
                                @php
                                    $map = setting('default_map');
                                @endphp
                                <div class="map mymap {{ $map == 'map-box' ? '' : 'd-none' }}" id='map-box'>
                                </div>
                                <div id="google-map-div" class="{{ $map == 'google-map' ? '' : 'd-none' }}">
                                    <input id="searchInput" class="mapClass" type="text" placeholder="Enter a location">
                                    <div class="map mymap" id="google-map"></div>
                                </div>
                                @error('location')
                                    <span class="ml-3 text-md text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                {{ __('image') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <x-forms.label name="image" />
                                        <input name="image" type="file" data-show-errors="true" data-width="100%"
                                            data-default-file="{{ asset($candidate->photo) }}" class="dropify">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                {{ __('files') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <x-forms.label name="cv" />
                                            <div class="custom-file">
                                                <input name="cv" type="file"
                                                    class="custom-file-input @error('cv') is-invalid @enderror">
                                                <label class="custom-file-label"
                                                    for="cvInputFile">{{ __('choose_cv') }}</label>
                                                @error('cv')
                                                    <span class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{ __('profile_details') }}
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="profession" />
                                            <select name="profession_id" id="profession"
                                                class="select2bs4 form-control @error('profession_id') is-invalid @enderror">
                                                @foreach ($professions as $profession)
                                                    <option
                                                        {{ $profession->id == old('profession_id', $candidate->profession_id) ? 'selected' : '' }}
                                                        value="{{ $profession->id }}">
                                                        {{ $profession->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('profession_id')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="experience" />
                                            <select name="experience" id="experience"
                                                class="form-control select2bs4 @error('experience') is-invalid @enderror">
                                                @foreach ($experiences as $experience)
                                                    <option
                                                        {{ old('experience', $candidate->experience_id) == $experience->id ? 'selected' : '' }}
                                                        value="{{ $experience->id }}">{{ $experience->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('experience')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="job_role" />
                                            <select name="role_id"
                                                class="form-control select2bs4 @error('role_id') is-invalid @enderror"
                                                id="role_id">
                                                <option value=""> {{ __('select_one') }}</option>
                                                @foreach ($job_roles as $role)
                                                    <option
                                                        {{ old('role_id', $candidate->role_id) == $role->id ? 'selected' : '' }}
                                                        value="{{ $role->id }}"> {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="education" />
                                            <select name="education" id="education"
                                                class="form-control select2bs4 @error('education') is-invalid @enderror">
                                                @foreach ($educations as $education)
                                                    <option
                                                        {{ $education->id == old('education_id', $candidate->education_id) ? 'selected' : '' }}
                                                        value="{{ $education->id }}"> {{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('education')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="gender" />
                                            <select name="gender" id="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="male"
                                                    {{ $candidate->gender == 'male' ? 'selected' : '' }}>
                                                    {{ __('male') }}</option>
                                                <option value="female"
                                                    {{ $candidate->gender == 'female' ? 'selected' : '' }}>
                                                    {{ __('female') }}</option>
                                                <option value="other"
                                                    {{ $candidate->gender == 'other' ? 'selected' : '' }}>
                                                    {{ __('other') }}</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <x-forms.label name="website" />
                                            <input type="text" id="website" name="website"
                                                value="{{ old('website', $candidate->website) }}"
                                                class="form-control @error('website') is-invalid @enderror"
                                                placeholder="{{ __('website') }}">
                                            @error('website')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <x-forms.label name="birth_date" />
                                            <input type="text"
                                                value="{{ date('d-m-Y', strtotime($candidate->birth_date)) }}"
                                                class="form-control @error('birth_date') is-invalid @enderror"
                                                name="birth_date" id="birth_date"
                                                placeholder="{{ __('birth_date') }}">
                                            @error('birth_date')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <x-forms.label name="marital_status" />
                                            <select id="marital_status" name="marital_status"
                                                class="form-control @error('marital_status') is-invalid @enderror">
                                                <option>{{ __('marital_status') }}</option>
                                                <option value="married" @if ($candidate->marital_status == 'married') selected @endif>
                                                    {{ __('married') }}</option>
                                                <option value="single" @if ($candidate->marital_status == 'single') selected @endif>
                                                    {{ __('single') }}</option>
                                            </select>
                                            @error('marital_status')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <x-forms.label name="bio" />
                                            <textarea name="bio" id="editor" placeholder="{{ __('bio') }}" value="{{ old('bio') }}"
                                                class="form-control @error('bio') is-invalid @enderror" id="bio" cols="1" rows="4">{!! $candidate->bio !!}</textarea>
                                            @error('bio')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
    <!-- >=>Mapbox<=< -->
    @include('map::links')
    <!-- >=>Mapbox<=< -->
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('#customFile').on('change', function(event) {
            $('#defaulthide').addClass('d-block')
            $('#defaulthide').removeClass('d-none')
        });
        // dropify image
        $('.dropify').dropify();
        //init datepicker
        $(document).ready(function() {
            $('#birth_date').datepicker({
                format: 'dd-mm-yyyy'
            });
        });
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        // states
        $(document).ready(function() {
            $('#country').on('change', function() {
                var idCountry = this.value;
                $.ajax({
                    url: "{{ route('candidate.state') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(states) {
                        $('#state').html('');
                        $.each(states, function(key, value) {

                            if (states.length > 0) {
                                $("#state").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            } else {
                                $('#state').html(
                                    '<option value="">No State Available !</option>'
                                );
                            }
                        });
                        if ($('#state').val() == null) {
                            $('#state').html('<option value="">Select State</option>');
                        }
                    }
                });
            });
        });
        // cities
        $(document).ready(function() {
            $('#state').on('change', function() {
                var idState = this.value;
                $.ajax({
                    url: "{{ route('candidate.city') }}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(cities) {
                        $('#city').html('');
                        $.each(cities, function(key, value) {

                            if (cities.length > 0) {
                                $("#city").append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            } else {
                                $('#city').html(
                                    '<option value="">No City Available !</option>');
                            }
                        });
                        if ($('#city').val() == null) {
                            $('#city').html('<option value="">Select City</option>');
                        }
                    }
                });
            });
        });

        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <!-- >=>Mapbox<=< -->
    @include('map::scripts')
    <!--=============== map box ===============-->
    <x-website.map.map-box-check/>

    <script>
        var token = "{{ $setting->map_box_key }}";
        mapboxgl.accessToken = token;
        const coordinates = document.getElementById('coordinates');

        var item = {!! $candidate !!};

        var oldlat = item.lat;
        var oldlng = item.long;

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
                mapboxgl: mapboxgl
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

            axios.get(
                    `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
                )
                .then((res) => {

                    var form = new FormData();
                    form.append('lat', lat);
                    form.append('lng', lng);

                    for (let i = 0; i < res.data.features.length; i++) {
                        form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                    }

                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                })
                .catch((e) => {
                    // toastr.error("Something Wrong", 'Error!');
                });
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
                axios.get(
                        `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?&types=address,neighborhood,locality,place,district,postcode,region,country&access_token=${token}`
                    )
                    .then((res) => {

                        var form = new FormData();
                        form.append('lat', lat);
                        form.append('lng', lng);

                        for (let i = 0; i < res.data.features.length; i++) {
                            form.append(res.data.features[i].place_type[0], res.data.features[i].text);
                        }

                        axios.post(
                                '/set/session', form
                            )
                            .then((res) => {
                                // console.log(res.data);
                                // toastr.success("Location Saved", 'Success!');
                            })
                            .catch((e) => {
                                toastr.error("Something Wrong", 'Error!');
                            });
                    })
                    .catch((e) => {
                        // toastr.error("Something Wrong", 'Error!');
                    });
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
    <!-- ============== map box ============= -->
    <!-- ============== google map ========= -->
    <x-website.map.google-map-check/>
    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";
            var oldlat = item.lat;
            var oldlng = item.long;

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
                    axios.post(
                        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
                    ).then((data) => {
                        if(data.data.error_message){
                            toastr.error(data.data.error_message, 'Error!');
                            toastr.error('Your location is not set because of a wrong API key.', 'Error!');
                        }

                        const total = data.data.results.length;
                        let amount = '';
                        if (total > 1) {
                            amount = total - 2;
                        }
                        const result = data.data.results.slice(amount);
                        let country = '';
                        let region = '';

                        for (let index = 0; index < result.length; index++) {
                            const element = result[index];


                            if (element.types[0] == 'country') {
                                country = element.formatted_address;
                            }
                            if (element.types[0] == 'administrative_area_level_1') {

                                const str = element.formatted_address;
                                const first = str.split(',').shift()
                                region = first;
                            }
                        }

                        var form = new FormData();
                        form.append('lat', lat);
                        form.append('lng', lng);

                        form.append('country', country);
                        form.append('region', region);

                        axios.post(
                                '/set/session', form
                            )
                            .then((res) => {
                                // console.log(res.data);
                                // toastr.success("Location Saved", 'Success!');
                            })
                            .catch((e) => {
                                toastr.error("Something Wrong", 'Error!');
                            });
                    })
                });

            google.maps.event.addListener(beachMarker, 'dragend',
                function() {
                    let lat = beachMarker.position.lat();
                    let lng = beachMarker.position.lng();
                    axios.post(
                        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${token}`
                    ).then((data) => {
                        if(data.data.error_message){
                            toastr.error(data.data.error_message, 'Error!');
                            toastr.error('Your location is not set because of a wrong API key.', 'Error!');
                        }

                        const total = data.data.results.length;
                        let amount = '';
                        if (total > 1) {
                            amount = total - 2;
                        }
                        const result = data.data.results.slice(amount);
                        let country = '';
                        let region = '';

                        for (let index = 0; index < result.length; index++) {
                            const element = result[index];


                            if (element.types[0] == 'country') {
                                country = element.formatted_address;
                            }
                            if (element.types[0] == 'administrative_area_level_1') {

                                const str = element.formatted_address;
                                const first = str.split(' ').shift()
                                region = first;
                            }
                        }

                        var form = new FormData();
                        form.append('lat', lat);
                        form.append('lng', lng);

                        form.append('country', country);
                        form.append('region', region);

                        axios.post(
                                '/set/session', form
                            )
                            .then((res) => {
                                // console.log(res.data);
                                // toastr.success("Location Saved", 'Success!');
                            })
                            .catch((e) => {
                                toastr.error("Something Wrong", 'Error!');
                            });
                    })
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
    <!-- =============== google map ========= -->
    <script type="text/javascript">
        $(document).ready(function() {
            $("[data-toggle=tooltip]").tooltip()
        })
    </script>
    <!-- >=>Mapbox<=< -->
@endsection
