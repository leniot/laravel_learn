<!DOCTYPE html>
<html>
<head lang="{{ app()->getLocale() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta name="renderer" content="webkit">
    <meta name="baidu-site-verification" content="R9XA5lWxu2" />
    <meta name="author" content="虎嗅网">
    <meta name="keywords" content="科技资讯,商业评论,明星公司,动态,宏观,趋势,创业,精选,有料,干货,有用,细节,内幕">
    <meta name="description" content="聚合优质的创新信息与人群，捕获精选|深度|犀利的商业科技资讯。在虎嗅，不错过互联网的每个重要时刻。">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/build.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/activity.css') }}">
    <link href="{{ asset('frontend/css/login.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('frontend/css/zzsc.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('frontend/css/dlzc.css') }}" rel="stylesheet" type="text/css"/>
    <script language="javascript" type="text/javascript" src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('frontend/js/popwin.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nanoscroller.css') }}">


</head>

<body>

@include('frontend::partials.header')

@yield('content')

@include('frontend::partials.footer')

<script type="text/javascript" src="{{ asset('frontend/js/mouse.js') }}"></script>

</body>

</html>
