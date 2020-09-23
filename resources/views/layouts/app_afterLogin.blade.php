<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Basic Page Needs==================================================-->
    <title>Online Mariners | Homepage</title>
    <link rel="icon" href="public/assets/img/mariners-favicon.png" type="image/gif" sizes="16x16">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS==================================================-->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/css/plugins.css') }}">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">    
    <link type="text/css" rel="stylesheet" id="jssDefault" href="{{ asset('public/assets/css/colors/green-style.css') }}"> 
    <!-- Custom css -->
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet">
    <!-- Js Jquery basic-->
    <script type="text/javascript" src="{{ asset('public/assets/plugins/js/jquery.min.js') }}"></script> 
    <!-- Data Table plugin -->
    <script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/jquery.dataTables.min.css') }}"> 
    <!-- Jquery Date Picker -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/jquery-ui.css') }}" >
    <link rel="stylesheet" href="/resources/demos/style.css">    
    <script src="{{ asset('public/assets/js/jquery-ui.js') }}"></script>
    </head>
<body>
    <div class="Loader"></div>
    <!--- Hearder -->
    <div class="wrapper">
        <!-- Menu Navigation list -->
        @include('includes.navbar2')
        <!-- BG image Home page -->
        
        @yield('content')

        @include('includes.footer')

        @yield('datepicker')
    </div>


</body>
</html>