<script src="{{ asset('frontend') }}/assets/js/axios.min.js"></script>
<x-website.map.google-map-check/>

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

<script type="text/javascript">
    $(document).ready(function() {
        $("[data-toggle=tooltip]").tooltip()
    })
</script>
