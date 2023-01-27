@if ($setting->default_map == 'map-box')
<script>
    var map_box_key = "{{ $setting->map_box_key }}";
    axios.get(`https://api.mapbox.com/geocoding/v5/mapbox.places/dhaka.json?access_token=${map_box_key}`)
        .then((res) => {
            if (res.status != 200) {
                alert()
                toastr.error(res.data.error_message, 'Error!');
                $('#map_wrong_key_warning').removeClass('d-none');
                $('#map_wrong_key_warning').text("Invalid map box api key")
            }
        })
        .catch((e) => {
            toastr.error("Invalid map box api key", 'Error!');
            $('#map_wrong_key_warning').removeClass('d-none');
            $('#map_wrong_key_warning').text("Invalid map box api key")
        });
</script>
@endif
