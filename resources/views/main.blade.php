<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="SLR" />
    <meta name="keywords" content="SLR" />
    <meta name="author" content="permanaeko74@gmail.com" />
    <link rel="icon" href="{{ asset('assets/images/logo/slr-logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/slr-logo.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/custom.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link id="color" rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-1.css') }}"
        media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />

    <style>
        @media only screen and (max-width: 600px) {
            .breadcrumb-parent {
                display: none;
            }
        }
    </style>
    @yield('css')

</head>

<body>
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('layout.header')
        <div class="page-body-wrapper">
            @include('layout.sidebar.sidebar')
            @yield('content')
            @include('layout.footer')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/popover-custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            var currentUrl = window.location.href;
            var dashboardUrl = "{{ route('dashboard.index') }}";
            var manageMUrl = "{{ route('management.member.index') }}";
            var managePUrl = "{{ Auth::user()->role_id == 1 ? route('management.project.index') : route('project.index') }}";
            var master = "{{ Auth::user()->role_id == 1 ? route('review.master.index') : route('master.index') }}";
            var ieeeUrl = "{{ Auth::user()->role_id == 1 ? route('review.ieee.index') : route('ieee.index') }}";
            var acm = "{{ Auth::user()->role_id == 1 ? route('review.acm.index') : route('acm.index') }}";
            var springer = "{{ Auth::user()->role_id == 1 ? route('review.springer.index') : route('springer.index')}}";
            var recycleMUrl = "{{ route('recycle.member') }}";
            var recyclePUrl = "{{ route('recycle.project') }}";
            var profileUrl = "{{ route('profile.index') }}";

            if (currentUrl === dashboardUrl) {
                $('#dash-lead').addClass('active');
            } else if (currentUrl === manageMUrl) {
                $('#manage').addClass('active');
                $('.sidebar-submenu-m').css('display', 'block');
                $('#m-member').addClass('text-primary');
            } else if (currentUrl === managePUrl) {
                $('#manage').addClass('active');
                $('.sidebar-submenu-m').css('display', 'block');
                $('#m-project').addClass('text-primary');
            } else if (currentUrl === recycleMUrl) {
                $('#recycles').addClass('active');
                $('.sidebar-submenu-r').css('display', 'block');
                $('#r-member').addClass('text-primary');
            } else if (currentUrl === recyclePUrl) {
                $('#recycles').addClass('active');
                $('.sidebar-submenu-r').css('display', 'block');
                $('#r-project').addClass('text-primary');
            } else if (currentUrl === profileUrl) {
                $('#pro-lead').addClass('active');
            } else if (currentUrl === master) {
                $('#scrape').addClass('active');
                $('.sidebar-submenu-s').css('display', 'block');
                $('#s-master').addClass('text-primary');
            } else if (currentUrl === ieeeUrl) {
                $('#scrape').addClass('active');
                $('.sidebar-submenu-s').css('display', 'block');
                $('.sub-c').css('display', 'block');
                $('#s-ieee').addClass('text-primary');
            } else if (currentUrl === acm) {
                $('#scrape').addClass('active');
                $('.sidebar-submenu-s').css('display', 'block');
                $('.sub-c').css('display', 'block');
                $('#s-acm').addClass('text-primary');
            } else if (currentUrl === springer) {
                $('#scrape').addClass('active');
                $('.sidebar-submenu-s').css('display', 'block');
                $('.sub-c').css('display', 'block');
                $('#s-springer').addClass('text-primary');
            }
        });
    </script>
    @yield('darkLayoutScript')
    @stack('js')
</body>

</html>
