<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Laravel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--font-awesome--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    {{--nprogress--}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/js/nprogress/nprogress.css') }}">
    {{--style.css--}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    @stack('stylesheets')

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    {{--header--}}
    @include('frontend::partials.header')
    {{--content--}}
    <div class="container" id="container">
        @yield('content')
    </div>
    {{--footer--}}
    @include('frontend::partials.footer')

    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--nprogress--}}
    <script src="{{ asset('frontend/assets/js/nprogress/nprogress.js') }}"></script>
    {{--jquery-ias--}}
    <script src="{{ asset('frontend/assets/js/jquery-ias.min.js') }}"></script>

    @stack('scripts')
</body>
</html>