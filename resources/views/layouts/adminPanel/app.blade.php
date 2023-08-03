<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Jay Mahakal Pharma &mdash; @yield('admintitle')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- CSS Libraries DataTable -->
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

    {{-- SELECT 2 LINK --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

@stack('style')

<body>

    <body>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">

                @include('layouts.adminPanel.header')
                @include('layouts.adminPanel.sidebar')
                @yield('admin_content')

                @include('layouts.adminPanel.footer')

            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('backend/assets/js/page/index-0.js') }}"></script>

        <!-- Template JS File -->
        <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
        <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

        <!-- JS Libraies -->
        <script src="{{ asset('backend/assets/modules/prism/prism.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('backend/assets/js/page/bootstrap-modal.js') }}"></script>

        {{-- dataTables --}}

        <!-- JS Libraies -->
        <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
        </script>
        <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
        <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- jQuery library -->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

        <!-- jQuery UI library -->
        {{-- <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script> --}}

        <!-- Include jQuery UI library -->
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

        <!-- Include jQuery UI CSS -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        {{-- Select 2 CDN --}}
       
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @stack('script')

    </body>

</html>
