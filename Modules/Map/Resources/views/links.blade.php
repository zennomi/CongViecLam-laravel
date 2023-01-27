<!-- >=>Mapbox<=< -->
<link rel="stylesheet" href="{{ asset('frontend/plugins/mapbox/mapbox-gl-geocoder.css') }}" type="text/css">
<link href="{{ asset('frontend/plugins/mapbox/mapbox-gl.css') }}" rel="stylesheet">
<style>
    .mymap {
        width: 100%;
        min-height: 300px;
        /* border-radius: 12px; */
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
