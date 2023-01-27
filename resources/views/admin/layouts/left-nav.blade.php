<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') - {{ config('app.name') }} </title>
    @include('admin.layouts.partials.styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed {{ $setting->dark_mode ? 'dark-mode' : '' }}">
    @php
        $user = auth()->user();
    @endphp
    <div class="wrapper">
        <!-- Navbar -->
        <nav id="nav"
            class="main-header navbar navbar-expand {{ $setting->dark_mode ? 'navbar-dark navbar-dark' : 'navbar-white navbar-light' }}">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="nav_collapse" class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a title="{{ __('browse_website') }}" target="_blank" class="nav-link" href="{{ url('/') }}"
                        class="btn btn-primary mt-4 mx-3 text-white">
                        <i class="fas fa-globe fa-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a title="{{ __('clear_cache') }}" class="nav-link" href="{{ route('app.optimize-clear') }}"
                        class="btn btn-primary mt-4 mx-3 text-white">
                        <i class="fas fa-broom"></i>
                    </a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @include('admin.layouts.partials.top-right-nav')
            </ul>
        </nav>

        <!-- Support Menu -->
        @if(!config('app.hide_helper'))
        <x-help-widget></x-help-widget>
        @endif

        <!-- Main Sidebar Container -->
        @if (request()->is('admin/settings/*'))
            @include('admin.layouts.partials.setting-sidebar')
        @else
            @include('admin.layouts.partials.default-sidebar')
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <x-admin.app-mode-alert />
                    @yield('breadcrumbs')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
    </div>
    <!-- ./wrapper -->
    @include('admin.layouts.partials.footer')

    @include('admin.layouts.partials.scripts')
    <script>
        Validate();

        $('#search').keyup(Validate);

        function Validate() {
            $('#searchIcon').addClass('d-none');
            $('#searchRemove').removeClass('d-none');
        }

        function RemoveHistory() {
            location.reload();
        }

        $('#search').keyup(function() {

            $('#searchcontainer').addClass('sidebar-search-open');

            $.ajax({
                url: "{{ route('admin.search') }}",
                type: "POST",
                data: {
                    data: $('#search').val(),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    $('#result').html('');
                    if (result.pages.length > 0) {

                        $.each(result.pages, function(key, page) {
                            $('#result').append('<a href="' + page.url +
                                '" class="list-group-item p-2"><div class="search-title">' +
                                page.page_title + '</div></a>');
                        });

                    } else {

                        $('#result').html(
                            '<span class="list-group-item"><div class="search-title text-center p-1"><strong>No Page</strong></div><div class="search-path"></div></span>'
                        )
                    }
                }
            });
        });
    </script>
</body>

</html>
