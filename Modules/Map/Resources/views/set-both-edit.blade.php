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
 <!-- >=>Mapbox<=< -->
 <script src="{{ asset('frontend') }}/js/axios.min.js"></script>
 <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.min.js') }}"></script>
 <script src="{{ asset('frontend/plugins/mapbox/mapbox-gl.js') }}"></script>
 <!--=============== map box ===============-->
 <script>
     var token = "{{ $setting->map_box_key }}";
     mapboxgl.accessToken = token;
     const coordinates = document.getElementById('coordinates');

     var item = {!! $ad !!};

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
