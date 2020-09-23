<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic Page Needs==================================================-->
    <title>Online Mariners | Homepage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!-- Menu Navigation list -->
        @include('includes.navbar')
        <!-- BG image Home page -->
        @include('includes.header')

        @yield('content')

        @include('includes.footer')
    </div>


</body>
</html>