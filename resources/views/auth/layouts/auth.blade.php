<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <meta name="description" content="@yield('description')">
    <meta property="og:image" content="@yield('og:image')">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            z-index: 1;
            /* Sit on top */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            -webkit-animation-name: fadeIn;
            /* Fade in the background */
            -webkit-animation-duration: 0.4s;
            animation-name: fadeIn;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes slideIn {
            from {
                bottom: -300px;
                opacity: 0
            }

            to {
                bottom: 0;
                opacity: 1
            }
        }

        @keyframes slideIn {
            from {
                bottom: -300px;
                opacity: 0
            }

            to {
                bottom: 0;
                opacity: 1
            }
        }

        @-webkit-keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

    </style>
    {{-- Style --}}
    @include('website.partials.links')
</head>
<body class="" dir="{{ langDirection() }}">
    <header class="site-header rt-fixed-top auth-header">
        <div class="main-header">
            <div class="navbar">
                <div class="container container-full-xxl">
                    <a href="/" class="brand-logo"><img src="{{ $setting->dark_logo_url }}" alt=""></a>
                </div><!-- /.container -->
            </div><!-- /.navbar -->
        </div><!-- /.main-header -->
    </header>
        @yield('content')

    <!-- scripts -->
    @include('website.partials.scripts')
    @yield('script')
</body>

</html>
