<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic Page Needs==================================================-->
    <title>Online Mariners | Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="public/assets/img/mariners-favicon.png" type="image/gif" sizes="16x16">
    <!-- CSS==================================================-->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/plugins.css') }}">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('public/assets/css/colors/green-style.css') }}">
    <!-- Js Jquery basic-->
    <script type="text/javascript" src="{{ asset('public/assets/plugins/js/jquery.min.js') }}"></script> 
</head>

<body>
    <div class="Loader"></div>
    <!--- Hearder -->
    <div class="wrapper">
        @include('includes.navbar')
        
        @yield('content')

        @include('includes.footer')
        <!-- Extra js -->
        @yield('custom_js_usertype')
        
    </div>


</body>
</html>