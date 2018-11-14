<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/app.css') }}">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    
            @include('admin.includes.header')      
            @include('admin.includes.sidebar')      
        <div id="app" class="wrapper">
        </div>

        <script type="text/javascript" src="{{ mix('assets/js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>