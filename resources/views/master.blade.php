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
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
        <meta property="og:image" content="{{ asset('image/logo.png') }}">
        <meta property="og:title" content="TMG Loyalty">
        <meta property="og:description" content="TMG Loyalty">
        <meta property="og:url" content="">
        <meta property="og:site_name" content="TMG Loyalty">
        <meta property="og:type" content="website">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#1A1A18">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#1A1A18">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#1A1A18">
    
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

        <!-- Latest compiled and minified CSS -->

        <!-- Slick -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.3.15/slick.css"/>

        <!-- Bootstrap 4 -->
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}

        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.css">
        
        <!-- Remodal -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal-default-theme.min.css">

        <!-- Icons -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <!-- Ionicon -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Flatpickr  css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        
        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        @yield('styles')

        <!-- Fonts -->
        <link href="{{ asset('fonts/Lato/Bold/stylesheet.css') }}" rel="stylesheet">
        <link href="{{ asset('fonts/Lato/Regular/stylesheet.css') }}" rel="stylesheet">
        <link href="{{ asset('fonts/Helvetica/Regular/stylesheet.css') }}" rel="stylesheet">

        <!-- CSS -->
        {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> --}}

        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/css/vendor.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('assets/frontend/css/app.css') }}">

    </head>
    <body>
        
        @include('includes.header')
        <div id="app" class="main">
            
            @yield('content')
            
        </div>
        @include('includes.footer')

        <!-- Vars -->
        <script type="text/javascript">
            var pageID = '{{ \Request::route()->getName() }}',
                systemToken = '{{ csrf_token() }}'

                @yield('data')

                baseHref = '{{ url("/") }}',
                urlHref = '{{ \Request::url() }}',

                systemVars = {
                    status: {
                        title: '{{ session('status_title') }}',
                        message: '{{ session('status_message') }}',
                        type: '{{ session('status_type') }}',
                    },
                };
        </script>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <script>
            window.Laravel.userID = '{{ Auth::check() ? Auth::id() : '' }}'
        </script>
        
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- jQuery Validate -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> 
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <!-- Latest compiled JavaScript -->
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> --}}
        
        <!-- Slick -->
        <script src="//cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js"></script>
    
        <!-- Remodal -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>

        <!-- App -->
        {{-- <script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/vendor.js') }}"></script>        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> --}}
        
        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/sweetalert2/6.6.2/sweetalert2.min.js"></script>
                
        <!-- Flatpickr  js -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- TweenMax -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/plugins/ScrollToPlugin.min.js"></script>

         <!-- ScrollMagic -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/animation.gsap.js"></script>

        @yield('js')

        <!-- App -->
        <script type="text/javascript" src="{{ asset('assets/frontend/js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/js/app.js') }}"></script>
    </body>
</html>