<div class="right-content">
    <nav>
        <div class="nav" id="nav-tab" role="tablist">
            <button class="nav-link active " id="nav-home-tab" data-bs-toggle="tab"
                data-bs-target="#nav-home" type="button" role="tab"
                aria-controls="nav-home" aria-selected="true" onclick="styleSwitch('box')">
                <x-svg.box-icon/>
            </button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                data-bs-target="#nav-profile" type="button" role="tab"
                aria-controls="nav-profile" aria-selected="false" onclick="styleSwitch('list')">
                <x-svg.list-icon/>
            </button>
        </div>
    </nav>
</div>

@push('frontend_scripts')
<script>
    var style = localStorage.getItem("job_style")  == null ? 'box' : localStorage.getItem("job_style");
    setStyle(style);

    function styleSwitch(jobstyle){
        localStorage.setItem("job_style", jobstyle);
        setStyle(jobstyle);
    }

    function setStyle(style){
        if (style == 'box') {
            $('#nav-home-tab').addClass('active');
            $('#nav-home').addClass('show active');
            $('#nav-profile-tab').removeClass('active');
            $('#nav-profile').removeClass('show active');
        } else {
            $('#nav-home-tab').removeClass('active');
            $('#nav-home').removeClass('show active');
            $('#nav-profile-tab').addClass('active');
            $('#nav-profile').addClass('show active');
        }
    }
</script>
@endpush
