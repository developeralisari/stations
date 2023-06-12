<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('csrf')
    <title>@yield('title')</title>
    <link rel='shortcut icon' href="{{ url('images/favicon.png') }}" type='image/x-icon'>
    <link rel="stylesheet" href="{{ url('modul/bootstrap-5.2.2-dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ url('modul/fontawesome-free-6.2.1-web/css/all.css') }}" />
    <link rel="stylesheet" href="{{ url('modul/popup/sweetalert2.css') }}">
    <link href="{{ url('modul/poppins/poppins.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('my.css') }}" />
    <link href="{{ url('modul/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ url('modul/bootstrap-multiselect/bootstrap-multiselect.css') }}" rel="stylesheet" />

    <style>
        .mb19 {
            margin-bottom: 19px !important;
        }
    </style>
    @yield('stil')
</head>

<body>
    @include('loading')
    @include('profile')
    @yield('content')

    <script src="{{ url('modul/jquery-3.6.0.js') }}"></script>
    <!--<script src="{{ url('modul/bootstrap-5.2.2-dist/js/bootstrap.js') }}"></script> -->
    <script src="{{ url('modul/bootstrap-5.2.2-dist/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ url('modul/popup/sweetalert2.js') }}"></script>
    <script src="{{ url('modul/select2/select2.min.js') }}"></script>
    <script src="{{ url('modul/jquery.mask.js') }}"></script>
    <script src="{{ url('modul/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>

    @yield('script')
    <script>
        $(window).on('load', function() {
            $("#loading").fadeOut();
        });

        $(window).on('unload', function() {
            $("#loading").fadeOut();
        });

        $(window).on('beforeunload', function(event) {
            $("#loading").fadeIn();
        });
    </script>
</body>

</html>
