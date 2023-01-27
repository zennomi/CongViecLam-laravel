<script src="{{ mix('frontend/vendor.min.js') }}"></script>
<script src="{{ mix('frontend/app.min.js') }}"></script>
<script src="https://unpkg.com/phosphor-icons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js" integrity="sha512-zYXldzJsDrNKV+odAwFYiDXV2Cy37cwizT+NkuiPGsa9X1dOz04eHvUWVuxaJ299GvcJT31ug2zO4itXBjFx4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $('#global_search').keypress(function (e) {
        var key = e.which;

        if (key == 13) {
            $('#search-form').submit();
        }
    });

    $("#searchIcon").click(function () {
        $(".togglesearch").toggle();
        $("input[type='text']").focus();
    });

    $("#mblSearchIcon").click(function () {
        $(".mblTogglesearch").toggle();
        $("input[type='text']").focus();
    });


    $('button.effect1').on('click', function () {
        $(this).find('span').toggleClass('active');
    });

    $('.rt-mobile-menu-overlay').on('click', function () {
        $('button.effect1').find('span').removeClass('active');
    });

    //image upload scripts
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input.className)

            var reader = new FileReader();

            reader.onload = function (e) {
                if(input.className === 'profile-file-upload-input'){
                    $('.profile-image-upload-wrap').hide();
                    $('.profile-file-upload-image').attr('src', e.target.result);
                    $('.profile-file-upload-content').show();

                    // $('.image-title').html(input.files[0].name);
                }
                if(input.className === 'banner-file-upload-input'){
                    $('.banner-image-upload-wrap').hide();

                    $('.banner-file-upload-image').attr('src', e.target.result);
                    $('.banner-file-upload-content').show();

                    // $('.image-title').html(input.files[0].name);
                }
                if(input.className === 'resume-file-upload-input'){
                    $('.cv-image-upload-wrap').hide();
                    $('.resume-file-upload-content.none').show();
                }
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            $('.profile-remove-image').on('click', function(){
                console.log(this.className)
                $('.profile-file-upload-input').replaceWith($('.profile-file-upload-input').clone());
                $('.profile-file-upload-content').hide();
                $('.profile-file-upload-image').attr('src', '');
                $('.profile-image-upload-wrap').show();
            })
            $('.banner-remove-image').on('click', function(){
                console.log(this.className)
                $('.banner-file-upload-input').replaceWith($('.banner-file-upload-input').clone());
                $('.banner-file-upload-content').hide();
                $('.banner-file-upload-image').attr('src', '');
                $('.banner-image-upload-wrap').show();
            })
        }
    }
    $('.profile-remove-image').on('click', function(){
        console.log(this.className)
        $('.profile-file-upload-input').replaceWith($('.profile-file-upload-input').clone());
        $('.profile-file-upload-content').hide();
        $('.profile-image-upload-wrap').show();
    })
    $('.banner-remove-image').on('click', function(){
        console.log(this.className)
        $('.banner-file-upload-input').replaceWith($('.banner-file-upload-input').clone());
        $('.banner-file-upload-content').hide();
        $('.banner-image-upload-wrap').show();
    })
    $('.cv-remove-image').on('click', function(){
        $('.resume-file-upload-input').replaceWith($('.resume-file-upload-input').clone());
        $('.resume-file-upload-content').hide();
        $('.cv-image-upload-wrap').show();
    })

    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
</script>
@stack('frontend_scripts')
@yield('frontend_scripts')

<script>
    @if(request('verified'))
    Swal.fire({
        title: "{{ __('email_verified') }}",
        text: "{{ __('your_email_has_been_verified') }}",
        icon: "success",
    })
    @endif

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

    $('.login_required').on('click', function (event) {
        event.preventDefault();

        Swal.fire({
            title: "{{ __('unauthenticated') }}",
            text: "{{ __('if_you_perform_this_action_you_need_to_login_your_account_first_do_you_want_to_login_now') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('yes_want_to_login') }}",
            cancelButtonText: "{{ __('cancel') }}",
        }).then((result) => {
            if (result.value) {
                window.location.href = route('login');
            }
        })
    });
    $('.no_permission').on('click', function (event) {
        event.preventDefault();
        Swal.fire({
            title: "{{ __('unauthorized_access') }}",
            text: "{{ __('you_dont_have_permission_to_perform_this_action') }}",
            icon: "warning",
            dangerMode: true,
        })
    });

    $('[data-toggle="tooltip"]').tooltip();

    $(".notification-icon a").off("click").on('click', function (e) {
        e.stopImmediatePropagation();
        return true;
    });

</script>

<script>
    function ReadNotification() {
        $.ajax({
            url: "{{ route('user.notification.read') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (data) {
                $('#unNotifications').hide();
            }
        });
    }

    function readSingleNotification(url, id) {
        $.ajax({
            url: "{{ route('website.markread.notification') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function (data) {
                window.location.href = url;
            }
        });

    }



</script>
