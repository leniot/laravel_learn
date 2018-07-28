<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--style.css--}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    {{--font-awesome--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <title>Laravel-login</title>
</head>
<body>
    <div class="container">
        <form class="form-signin" method="post" action="{{ route('login') }}">
            @csrf
            <div class="text-center">
                <a href="{{ url('/') }}">
                    <img class="" src="{{ asset('frontend/assets/images/laravel.jpg') }}" alt="laravel" width="108" height="72">
                </a>
                <h1 class="h3 font-weight-normal">Laravel</h1>
                <p>求知 探索...</p>
            </div>

            <div class="form-label-group">
                <label for="inputName" class="sr-only">用户名</label>
                <input type="text" id="inputName" class="form-control" name="name" placeholder="用户名" required="" autofocus="">
            </div>

            <div class="form-label-group">
                <label for="inputPassword" class="sr-only">密码</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required="">
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>

            <p class="redirect-register">没有账号？ <a class="" href="{{ url('register') }}">注 册</a></p>
        </form>
        <hr>
        <div class="social-login text-center">
            <h5 class="social-title">其他账号登录</h5>
            <a id="qq_login" class="btn btn-outline" href="{{ url('login/qq') }}">
                <i class="fa fa-qq"></i> QQ
            </a>

            <a id="weixin_login" class="btn btn-outline" href="{{ url('login/weixin') }}">
                <i class="fa fa-weixin"></i> 微信
            </a>

            <a id="weixin_login" class="btn btn-outline" href="{{ url('login/github') }}">
                <i class="fa fa-github"></i> github
            </a>
        </div>
    </div>
</body>
</html>