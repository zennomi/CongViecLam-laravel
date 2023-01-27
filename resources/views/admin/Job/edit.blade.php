@extends('admin.layouts.app')
@section('title')
    {{ __('edit') }} {{ __('job') }}
@endsection
@section('content')
    <div class="container-fluid">
        <form class="form-horizontal" action="{{ route('job.update', $job->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title line-height-36">{{ __('edit') }} {{ __('job') }}</h4>
                    <button type="submit"
                        class="btn bg-success float-right d-flex align-items-center justify-content-center">
                        <i class="fas fa-sync mr-1"></i> {{ __('save') }}
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('job_details') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-12">
                                    <label for="title">
                                        {{ __('title') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <input id="title" type="text" name="title"
                                        value="{{ old('title', $job->title) }}" placeholder="{{ __('title') }}"
                                        class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="company_id">
                                        {{ __('company') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="company_id"
                                        class="form-control select2bs4 @error('company_id') is-invalid @enderror"
                                        id="company_id">
                                        <option value=""> {{ __('company') }}</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"
                                                {{ $company->id == $job->company_id ? 'selected' : '' }}>
                                                {{ $company->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="category_id">
                                        {{ __('category') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="category_id"
                                        class="form-control select2bs4 @error('category_id') is-invalid @enderror"
                                        id="category_id">
                                        <option value=""> {{ __('category') }}</option>
                                        @foreach ($job_category as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $job->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="vacancies" for="vacancies" :required="true" />
                                    <input id="vacancies" type="text" name="vacancies"
                                        value="{{ old('vacancies', $job->vacancies) }}"
                                        placeholder="{{ __('enter_vacancies') }}"
                                        class="form-control @error('vacancies') is-invalid @enderror">
                                    @error('vacancies')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="deadline">
                                        {{ __('deadline') }}
                                    </label>
                                    <input id="deadline" type="text" name="deadline" placeholder="MM/DD/YYYY"
                                        value="{{ old('deadline', $job->deadline) }}"
                                        class="form-control @error('deadline') is-invalid @enderror">
                                    @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                {{ __('location') }}
                                <small class="h6">
                                    ({{ __('click_to_add_a_pointer') }})
                                </small>
                            </div>
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
                            <div class="card-title">{{ __('salary_details') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="salary_type">
                                        {{ __('salary_type') }}
                                        <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <select name="salary_type"
                                        class="form-control select2bs4 @error('salary_type') is-invalid @enderror"
                                        id="salary_type">
                                        @foreach ($salary_types as $salary_type)
                                            <option {{ $salary_type->id == $job->salary_type_id ? 'selected' : '' }}
                                                value="{{ $salary_type->id }}"> {{ $salary_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('salary_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="min_salary">
                                        {{ __('min_salary') }}
                                        <span class="text-red font-weight-bold">*</span>
                                    </label>
                                    <input id="min_salary" type="number" name="min_salary"
                                        placeholder="{{ __('min_salary') }}"
                                        value="{{ old('min_salary', $job->min_salary) }}"
                                        class="form-control @error('min_salary') is-invalid @enderror">
                                    @error('min_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label for="max_salary">
                                        {{ __('max_salary') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <input id="max_salary" type="number" name="max_salary"
                                        placeholder="{{ __('max_salary') }}"
                                        value="{{ old('max_salary', $job->max_salary) }}"
                                        class="form-control @error('max_salary') is-invalid @enderror">
                                    @error('max_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('applicant_options') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-12">
                                    <x-forms.label name="receive_applications" for="apply_on" :required="true" />
                                    <select name="apply_on" class="form-control @error('apply_on') is-invalid @enderror"
                                        id="apply_on">
                                        <option value="" {{ $job->apply_on === '' ? 'selected' : '' }}>
                                            {{ __('select_one') }}</option>
                                        <option value="app" {{ $job->apply_on === 'app' ? 'selected' : '' }}>
                                            {{ __('on_our_platform') }}</option>
                                        <option value="email" {{ $job->apply_on === 'email' ? 'selected' : '' }}>
                                            {{ __('on_your_email_address') }}</option>
                                        <option value="custom_url"
                                            {{ $job->apply_on === 'custom_url' ? 'selected' : '' }}>
                                            {{ __('on_a_custom_url') }}</option>
                                    </select>
                                    @error('apply_on')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-12 {{ $job->apply_on === 'email' ? '' : 'd-none' }}"
                                    id="apply_email_div">
                                    <x-forms.label name="apply_email" for="apply_email" :required="true" />
                                    <input id="apply_email" type="email" name="apply_email"
                                        placeholder="{{ __('apply_email') }}" value="{{ $job->apply_email }}"
                                        class="form-control @error('apply_email') is-invalid @enderror">
                                    @error('apply_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-12 {{ $job->apply_on == 'custom_url' ? '' : 'd-none' }}"
                                    id="apply_url_div">
                                    <x-forms.label name="apply_url" for="apply_url" :required="true" />
                                    <input id="apply_url" type="url" name="apply_url"
                                        placeholder="{{ __('apply_url') }}" value="{{ $job->apply_url }}"
                                        class="form-control @error('apply_url') is-invalid @enderror">
                                    @error('apply_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('others') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row p-4">
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="featured" name="badge" type="radio" class="form-check-input"
                                            id="featured" {{ $job->featured ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5"
                                            for="featured">{{ __('featured') }}</label>
                                    </div>
                                    @error('featured')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="highlight" name="badge" type="radio" class="form-check-input"
                                            id="highlight" {{ $job->highlight ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5"
                                            for="highlight">{{ __('highlight') }}</label>
                                    </div>
                                    @error('highlight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-check">
                                    <div class="icheck-success d-inline">
                                        <input value="1" name="is_remote" type="checkbox" class="form-check-input"
                                            id="is_remote" {{ $job->is_remote ? 'checked' : '' }}>
                                        <label class="form-check-label mr-5" for="is_remote">{{ __('remote') }}</label>
                                    </div>
                                    @error('is_remote')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ __('description') }}</div>
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="experience">
                                        {{ __('experience') }}
                                    </label>
                                    <select name="experience"
                                        class="form-control select2bs4 @error('experience') is-invalid @enderror"
                                        id="experience">
                                        @foreach ($experiences as $experience)
                                            <option {{ $experience->id == $job->experience_id ? 'selected' : '' }}
                                                value="{{ $experience->id }}"> {{ $experience->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('experience')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="role_id">
                                        {{ __('job_role') }}
                                        <span class="text-red font-weight-bold">*</span></label>
                                    <select name="role_id"
                                        class="form-control select2bs4 @error('role_id') is-invalid @enderror"
                                        id="role_id">
                                        <option value=""> {{ __('job_role') }}</option>
                                        @foreach ($job_roles as $role)
                                            <option value="{{ $role->id }}"
                                                @if ($job->role_id == $role->id) selected @endif> {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    <label for="education">
                                        {{ __('education') }}
                                    </label>
                                    <select id="education" name="education"
                                        class="form-control select2bs4 @error('education') is-invalid @enderror">
                                        @foreach ($educations as $education)
                                            <option {{ $education->id == $job->education_id ? 'selected' : '' }}
                                                value="{{ $education->id }}">{{ $education->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('education')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="job_type">
                                        {{ __('job_type') }}
                                    </label>
                                    <select name="job_type"
                                        class="form-control select2bs4 @error('job_type') is-invalid @enderror"
                                        id="job_type">
                                        @foreach ($job_types as $job_type)
                                            <option {{ $job_type->id == $job->job_type_id ? 'selected' : '' }}
                                                value="{{ $job_type->id }}">{{ $job_type->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('job_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="description" class="pt-2">{{ __('description') }}<span
                                            class="text-red font-weight-bold">*</span></label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="30" rows="10">{{ old('description', $job->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ __($message) }}</strong>
                                        </span>
                                    @enderror
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
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap-datepicker.min.css">

    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
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
    <script src="{{ asset('frontend/assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //init datepicker
        $(document).ready(function() {
            var dateToday = new Date();
            $('#deadline').datepicker({
                format: "yyyy-mm-dd",
                minDate: dateToday,
                startDate: dateToday,
                todayHighlight: true,
            });
        });



        $(document).ready(function() {
            $('#tags').select2({
                theme: 'bootstrap4',
                tags: true,
                tokenSeparators: [',', ' ']
            }).val('[{{ $job->tags }}]').trigger('change');
        });

        // condidtion based apply on show hide
        $('#apply_on').on('change', function() {
            var applyOn = $('#apply_on').val();
            var applyEmail = $('#apply_email_div');
            var applyUrl = $('#apply_url_div');
            applyOn == 'email' ? applyEmail.removeClass("d-none") : applyEmail.addClass("d-none");
            applyOn == 'custom_url' ? applyUrl.removeClass("d-none") : applyUrl.addClass("d-none");
        });

        ClassicEditor
            .create(document.querySelector('#description'))
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

        var item = {!! $job !!};

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
