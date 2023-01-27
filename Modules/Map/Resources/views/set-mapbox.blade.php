<script src="{{ asset('frontend') }}/assets/js/axios.min.js"></script>
<x-website.map.map-box-check/>

<!-- >=>Mapbox<=< -->
@include('map::scripts')
<!-- >=>Mapbox<=< -->
<script>
    var token = "{{ $setting->map_box_key }}";
    mapboxgl.accessToken = token;
    const coordinates = document.getElementById('coordinates');

    var oldlat = {{ Session::has('location') ? Session::get('location')['lat'] : setting('default_lat') }};
    var oldlng = {{ Session::has('location') ? Session::get('location')['lng'] : setting('default_long') }};

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
<script type="text/javascript">
    $(document).ready(function() {
        $("[data-toggle=tooltip]").tooltip()
    })
</script>
