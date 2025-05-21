<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', '=PayRoll Management') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/css/buttons.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

    <!-- Style css -->
    <link class="main-css" href="{{ asset('css/style.css') }}" rel="stylesheet">


    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased duration-1000">
    @inertia



    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/chart-js/chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script> --}}

    <!-- Dashboard 1 -->
    {{-- <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script> --}}
    <script src="{{ asset('vendor/draggable/draggable.js') }}"></script>
    <script src="{{ asset('vendor/swiper/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/js/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Vectormap -->
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    {{-- <script src="{{ asset('js/my.js') }}"></script> --}}
    <script src="{{ asset('js/deznav-init.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                dzSettingsOptions.version = 'light';
                new dzSettings(dzSettingsOptions);

                setCookie('version', 'light');
            }, 1500);
        });
    </script>



</body>

</html>
