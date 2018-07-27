<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img class="mb-4" src="{{ asset('frontend/assets/images/laravel.jpg') }}" alt="" width="108" height="72">
                </a>
                <h1 class="h3 mb-3 font-weight-normal">Laravel</h1>
                <p>求知 探索...</p>
            </div>

            <div class="form-label-group">
                <input type="text" id="inputUsername" class="form-control" name="name" placeholder="用户名" required>
                <label for="inputUsername">用户名</label>
            </div>

            <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="密码" required>
                <label for="inputPassword">密 码</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">登 录</button>

            <p class="mt-3">没有账号？ <a class="" href="{{ url('register') }}">注 册</a></p>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>