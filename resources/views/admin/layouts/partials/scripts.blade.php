<script src="{{ asset('backend/js/vendor.min.js') }}"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}", 'Success!')
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif

    // toast config
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Navbar Collapse Toggle
    var isNavCollapse = JSON.parse(localStorage.getItem("sidebar_collapse"))
    isNavCollapse ? $('body').addClass('sidebar-collapse') : null;

    $('#nav_collapse').on('click', function() {
        localStorage.setItem("sidebar_collapse", isNavCollapse == true ? false : true);
    });
</script>
<!-- Custom Script -->
<script>
    function ReadNotification() {
        $.ajax({
            url: "{{ route('admin.notification.read') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(data) {
                $('#unNotifications').html('');
            }
        });
    }

    $('[data-toggle="tooltip"]').tooltip();

</script>
@yield('script')
{!! $setting->body_script !!}
