<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/app.css') }}">
    </head>
    <body>
    
        <div id="app" class="wrapper">
    
            @yield('content')

        </div>

        <script type="text/javascript" src="{{ mix('assets/js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>