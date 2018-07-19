<!doctype html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nprogress.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/favicon.ico') }}">
        <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">

        <script src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
        <script src="{{ asset('frontend/js/nprogress.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.lazyload.min.js') }}"></script>
        <!--[if gte IE 9]>
        <script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend/js/html5shiv.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend/js/respond.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('frontend/js/selectivizr-min.js') }}" type="text/javascript"></script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script>window.location.href='upgrade-browser.html';</script>
        <![endif]-->
    </head>

    <body class="user-select">

    @include('frontend::partials.header')

    @yield('content')

    @include('frontend::partials.footer')

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.ias.js') }}"></script>
    <script src="{{ asset('frontend/js/scripts.js') }}"></script>
    </body>
</html>
