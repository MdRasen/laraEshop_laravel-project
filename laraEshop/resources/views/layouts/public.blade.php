<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('assets/public/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/public/css/style.css')}}" type="text/css">

    <style>
        .user_type{
            width: 100% !important;
            margin-bottom: 10px !important;
            font-size: 20px !important;
        }
    </style>

</head>
<body>

    @include('layouts.inc.public-navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.inc.public-footer')

    <!-- Js Plugins -->
    <script src="{{asset('assets/public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/public/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/public/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/public/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('assets/public/js/mixitup.min.js')}}"></script>
    <script src="{{asset('assets/public/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/public/js/main.js')}}"></script>
    
</body>
</html>