@if ($setting->default_map == 'google-map')
<script>
    var google_map_key = "{{ $setting->google_map_key }}";
    axios.get(`https://maps.googleapis.com/maps/api/geocode/json?key=${google_map_key}&address=Dhaka`)
    .then((res) => {
        if (res.data.status != 'OK') {
            toastr.error(res.data.error_message, 'Error!');
            $('#map_wrong_key_warning').removeClass('d-none');
            $('#map_wrong_key_warning').text(res.data.error_message)
        }
    })
    .catch((e) => {
        toastr.error("Something Wrong", 'Error!');
    });
</script>
@endif
