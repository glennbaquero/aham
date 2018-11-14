<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <base href="/" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AHAM | @yield('pageTitle')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/app.css') }}">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="app">
            <div class="wrapper">
            @include('admin.includes.header')      
            @yield('content')
            @include('admin.includes.sidebar')
            </div>
            @include('admin.includes.footer')     
        </div>
        
        @yield('js')
        
        <script type="text/javascript" src="{{ mix('assets/js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>