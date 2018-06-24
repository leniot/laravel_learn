<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet'>

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/login/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}">
    {{--<link rel="apple-touch-icon" href="{{ asset('frontend/img/apple-touch-icon.png') }}">--}}
    {{--<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/img/apple-touch-icon-72x72.png') }}">--}}
    {{--<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/img/apple-touch-icon-114x114.png') }}">--}}

    <!-- Lazyload -->
    <script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>

</head>

<body class="bg-light">

<!-- Preloader -->
<div class="loader-mask">
    <div class="loader">
        <div></div>
    </div>
</div>

<!-- Bg Overlay -->
<div class="content-overlay"></div>

@include('frontend::partials.sideNav')

<main class="main oh" id="main">

    @include('frontend::partials.header')

    @yield('content')

    @include('frontend::partials.footer')

    <div id="back-to-top">
        <a href="#top" aria-label="Go to top"><i class="ui-arrow-up"></i></a>
    </div>

</main> <!-- end main-wrapper -->


<!-- jQuery Scripts -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/easing.min.js') }}"></script>
<script src="{{ asset('frontend/js/owl-carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/twitterFetcher_min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.newsTicker.min.js') }}"></script>
<script src="{{ asset('frontend/js/modernizr.min.js') }}"></script>
<script src="{{ asset('frontend/js/scripts.js') }}"></script>

</body>
</html>