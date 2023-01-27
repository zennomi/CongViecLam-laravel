@extends('admin.layouts.app')
@section('title')
    {{ __('update') }} {{ __('employee') }}
@endsection

@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" action="{{ route('company.update', $company->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title line-height-36">{{ __('update') }} {{ __('employee') }}</h4>
                    <button type="submit"
                        class="btn bg-success float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-sync mr-1"></i>
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
                        <div class="card-body">
                            <div class="form-group">
                                <x-forms.label name="employer_name" :required="false"/>
                                <x-forms.input type="text" name="name" placeholder="name"
                                    value="{{ old('name', $user->name) }}" />
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="username" :required="false"/>
                                    <x-forms.input type="text" name="username" placeholder="username"
                                        value="{{ old('username', $user->username) }}" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="email" />
                                    <x-forms.input type="email" name="email" placeholder="email"
                                        value="{{ old('email', $user->email) }}" />
                                </div>

                            </div>
                            <div class="form-group">
                                <x-forms.label name="change_password" />
                                <x-forms.input type="password" name="password" placeholder="password" />
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
                    <div class="card">
                        <div class="card-header">
                            {{ __('contact') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="phone" />
                                    <x-forms.input type="text" name="contact_phone" placeholder="phone"
                                        value="{{ old('contact_phone', $user->contactInfo->phone) }}" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="email" />
                                    <x-forms.input type="email" name="contact_email" placeholder="email"
                                        value="{{ old('contact_email', $user->contactInfo->email) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            {{ __('images') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-4">
                                    <x-forms.label name="logo" :required="false" />
                                    <input name="logo" type="file" data-show-errors="true" data-width="50%"
                                        class="dropify" data-default-file="{{ $company->logo_url }}">
                                </div>
                                <div class="form-group col-8">
                                    <x-forms.label name="banner" :required="false" />
                                    <input name="image" type="file" data-show-errors="true" data-width="100%"
                                        data-default-file="{{ $company->banner_url }}" class="dropify">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            {{ __('social_details') }}
                        </div>
                        <div class="card-body">
                            <div id="multiple_feature_part">
                                <div class="row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <select class="form-control @error('social_media') border-danger @enderror"
                                            name="social_media[]">
                                            <option value="" class="d-none" disabled>{{ __('select_one') }}
                                            </option>
                                            <option {{ old('social_media') == 'facebook' ? 'selected' : '' }}
                                                value="facebook">{{ __('facebook') }}</option>
                                            <option {{ old('social_media') == 'twitter' ? 'selected' : '' }}
                                                value="twitter">{{ __('twitter') }}</option>
                                            <option {{ old('social_media') == 'instagram' ? 'selected' : '' }}
                                                value="instagram">{{ __('instagram') }}
                                            </option>
                                            <option {{ old('social_media') == 'youtube' ? 'selected' : '' }}
                                                value="youtube">{{ __('youtube') }}</option>
                                            <option {{ old('social_media') == 'linkedin' ? 'selected' : '' }}
                                                value="linkedin">{{ __('linkedin') }}</option>
                                            <option {{ old('social_media') == 'pinterest' ? 'selected' : '' }}
                                                value="pinterest">{{ __('pinterest') }}
                                            </option>
                                            <option {{ old('social_media') == 'reddit' ? 'selected' : '' }}
                                                value="reddit">{{ __('reddit') }}</option>
                                            <option {{ old('social_media') == 'github' ? 'selected' : '' }}
                                                value="github">{{ __('github') }}</option>
                                            <option {{ old('social_media') == 'other' ? 'selected' : '' }} value="other">
                                                {{ __('other') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="url" name="url[]" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a role="button" onclick="add_features_field()"
                                            class="btn bg-primary text-light"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                                @forelse($socials as $social)
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-4">
                                            <select class="form-control @error('social_media') border-danger @enderror"
                                                name="social_media[]">
                                                <option value="" class="d-none" disabled>{{ __('select_one') }}
                                                </option>
                                                <option {{ $social->social_media == 'facebook' ? 'selected' : '' }}
                                                    value="facebook">{{ __('facebook') }}</option>
                                                <option {{ $social->social_media == 'twitter' ? 'selected' : '' }}
                                                    value="twitter">{{ __('twitter') }}</option>
                                                <option {{ $social->social_media == 'instagram' ? 'selected' : '' }}
                                                    value="instagram">{{ __('instagram') }}
                                                </option>
                                                <option {{ $social->social_media == 'youtube' ? 'selected' : '' }}
                                                    value="youtube">{{ __('youtube') }}</option>
                                                <option {{ $social->social_media == 'linkedin' ? 'selected' : '' }}
                                                    value="linkedin">{{ __('linkedin') }}</option>
                                                <option {{ $social->social_media == 'pinterest' ? 'selected' : '' }}
                                                    value="pinterest">{{ __('pinterest') }}
                                                </option>
                                                <option {{ $social->social_media == 'reddit' ? 'selected' : '' }}
                                                    value="reddit">{{ __('reddit') }}</option>
                                                <option {{ $social->social_media == 'github' ? 'selected' : '' }}
                                                    value="github">{{ __('github') }}</option>
                                                <option {{ $social->social_media == 'other' ? 'selected' : '' }}
                                                    value="other">
                                                    {{ __('other') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="url" name="url[]" class="form-control"
                                                value="{{ $social->url }}" placeholder="{{ __('url') }}">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <a role="button" id="remove_item" class="btn bg-danger text-light"><i
                                                    class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                @endforeach
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
                                <div class="form-group col-6">
                                    <x-forms.label name="organization_type" />
                                    <select name="organization_type_id"
                                        class="form-control select2bs4 {{ error('organization_type_id') }}"
                                        id="organization_type_id">
                                        @foreach ($organization_types as $type)
                                            <option
                                                {{ $type->id == old('organization_type_id', $company->organization_type_id) ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="organization_type_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="industry_type" />
                                    <select name="industry_type_id"
                                        class="form-control select2bs4 {{ error('industry_type_id') }}"
                                        id="organization_type_id">
                                        <option value="" class="d-none">
                                            {{ __('select_one') }}
                                        </option>
                                        @foreach ($industry_types as $type)
                                            <option
                                                {{ $type->id == old('industry_type_id', $company->industry_type_id) ? 'selected' : '' }}
                                                value="{{ $type->id }}">
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="industry_type_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="team_size" :required="false"/>
                                    <select name="team_size_id" class="form-control {{ error('team_size_id') }}"
                                        id="organization_type_id">
                                        <option value="" class="d-none">
                                            {{ __('select_one') }}
                                        </option>
                                        @foreach ($team_sizes as $size)
                                            <option
                                                {{ $size->id == old('team_size_id', $company->team_size_id) ? 'selected' : '' }}
                                                value="{{ $size->id }}">
                                                {{ $size->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="team_size_id" />
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="nationality" />
                                    <select name="nationality_id"
                                        class="form-control select2bs4 {{ error('nationality_id') }}"
                                        id="nationality_id">
                                        <option value="" class="d-none">
                                            {{ __('nationality') }}
                                        </option>
                                        @foreach ($nationalities as $nationality)
                                            <option
                                                {{ $nationality->id == old('nationality_id', $company->nationality_id) ? 'selected' : '' }}
                                                value="{{ $nationality->id }}">
                                                {{ $nationality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error name="nationality_id" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group datepicker col-4">
                                    <x-forms.label name="website" :required="false"/>
                                    <x-forms.input type="text" name="website" placeholder="website"
                                        value="{{ old('website', $company->website) }}" />
                                    <x-forms.error name="establishment_date" />
                                </div>
                                <div class="form-group datepicker col-4">
                                    <x-forms.label name="establishment_date" :required="false" />
                                    <x-forms.input type="text" name="establishment_date" placeholder="select_one"
                                        id="establishment_date"
                                        value="{{ old('establishment_date', formatTime($company->establishment_date, 'd-m-Y')) }}" />
                                    <x-forms.error name="establishment_date" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <x-forms.label name="bio" :required="false" />
                                    <textarea id="editor" rows="8" name="bio" placeholder="{{ __('bio') }}" class="form-control">{{ old('bio', $company->bio) }}</textarea>
                                </div>
                                <div class="form-group col-6">
                                    <x-forms.label name="vision" :required="false" />
                                    <textarea id="editor2" rows="8" name="vision" placeholder="{{ __('vision') }}" class="form-control">{{ old('vision', $company->vision) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css">

    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">

    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
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
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
        $('.dropify').dropify();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //init datepicker
        $(document).ready(function() {
            $('#establishment_date').datepicker({
                format: 'dd-mm-yyyy'
            });
        });
        // view state by country
        $(document).ready(function() {
            $('#country_id').on('change', function() {
                var country_id = this.value;
                $.ajax({
                    url: "{{ route('admin.getStateByCountry') }}",
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state_id').html(
                                '<option value="">{{ __('select_one') }}</option>')
                            .removeAttr(
                                'disabled');
                        $.each(result.states, function(key, value) {
                            $("#state_id").append('<option value="' +
                                value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });

            });
        });
        // view cities by state
        $(document).ready(function() {
            $('#state_id').on('change', function() {
                var state_id = this.value;
                $.ajax({
                    url: "{{ route('admin.getCityByCountry') }}",
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#city_id').html(
                                '<option value="">{{ __('select_one') }}</option>')
                            .removeAttr(
                                'disabled');
                        $.each(result.cities, function(key, value) {
                            $("#city_id").append('<option value="' +
                                value.id + '">' + value.name +
                                '</option>');
                        });
                    }
                });

            });
        });

        $(document).on("click", "#remove_item", function() {
            $(this).parent().parent('div').remove();
        });

        function add_features_field() {
            $("#multiple_feature_part").append(`
            <div class="row justify-content-center">
                <div class="form-group col-md-4">
                    <select class="form-control @error('social_media') border-danger @enderror"
                        name="social_media[]">
                        <option value="" class="d-none" disabled>{{ __('select_one') }}
                        </option>
                        <option {{ old('social_media') == 'facebook' ? 'selected' : '' }}
                            value="facebook">{{ __('facebook') }}</option>
                        <option {{ old('social_media') == 'twitter' ? 'selected' : '' }}
                            value="twitter">{{ __('twitter') }}</option>
                        <option {{ old('social_media') == 'instagram' ? 'selected' : '' }}
                            value="instagram">{{ __('instagram') }}
                        </option>
                        <option {{ old('social_media') == 'youtube' ? 'selected' : '' }}
                            value="youtube">{{ __('youtube') }}</option>
                        <option {{ old('social_media') == 'linkedin' ? 'selected' : '' }}
                            value="linkedin">{{ __('linkedin') }}</option>
                        <option {{ old('social_media') == 'pinterest' ? 'selected' : '' }}
                            value="pinterest">{{ __('pinterest') }}
                        </option>
                        <option {{ old('social_media') == 'reddit' ? 'selected' : '' }}
                            value="reddit">{{ __('reddit') }}</option>
                        <option {{ old('social_media') == 'github' ? 'selected' : '' }}
                            value="github">{{ __('github') }}</option>
                        <option {{ old('social_media') == 'other' ? 'selected' : '' }} value="other">
                            {{ __('other') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="url" name="url[]" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <a role="button" id="remove_item"
                        class="btn bg-danger text-light"><i class="fas fa-times"></i></a>
                </div>
            </div>
            `);
        }
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#vision'))
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

        var item = {!! $company !!};

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
