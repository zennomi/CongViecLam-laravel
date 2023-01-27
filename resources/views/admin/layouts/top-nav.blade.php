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

<body class="hold-transition sidebar-collapse layout-top-nav {{ $setting->dark_mode ? 'dark-mode' : '' }}">
    @php
        $user = auth()->user();
    @endphp
    <div class="wrapper">
        <!-- Navbar -->
        <nav id="nav"
            class="main-header navbar navbar-expand-md {{ $setting->dark_mode ? 'navbar-dark navbar-dark' : 'navbar-white navbar-light' }}"
            style="background-color:{{ $setting->dark_mode ? '' : $setting->nav_color }}">
            <div class="container">
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                    <img src="{{ $setting->dark_logo_url }}" alt="{{ __('logo') }}" class="brand-image">
                    <span class="brand-text font-weight-light">{{ $setting->name }}</span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a id="nav_collapse" class="nav-link" data-widget="pushmenu" href="#" role="button">
                                <i class="fas fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    @include('admin.layouts.partials.top-right-nav')
                </ul>
            </div>
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
                <div class="container">
                    <x-admin.app-mode-alert />
                    @yield('breadcrumbs')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('admin.layouts.partials.footer')

    </div>
    <!-- ./wrapper -->

    @include('admin.layouts.partials.scripts')
</body>

</html>
