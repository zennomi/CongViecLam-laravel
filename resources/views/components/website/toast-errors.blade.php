<script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error )
            toastr.error(" {{ $error }} ", 'Error',[toastr.options = {
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
            }]);
        @endforeach
    @endif
</script>
