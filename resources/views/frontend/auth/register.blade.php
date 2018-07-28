<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--style.css--}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    {{--font-awesome--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <title>Laravel-login</title>
</head>
<body>
    <div class="container">
        <form class="form-signin" action="{{ route('register') }}" method="post">
            @csrf
            <div class="text-center mb-4">
                <a href="{{ url('/') }}">
                    <img class="mb-4" src="{{ asset('frontend/assets/images/laravel.jpg') }}" alt="logo" width="108" height="72">
                </a>
                <h1 class="h3 mb-3 font-weight-normal">Laravel</h1>
                <p>求知 探索...</p>
            </div>

            <div class="form-label-group">
                <label for="inputUsername" class="sr-only">用户名</label>
                <input type="text" id="inputUsername" class="form-control" name="name" placeholder="用户名" required="" autofocus="">
            </div>

            <div class="form-label-group">
                <label for="inputPassword" class="sr-only">密码</label>
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="密码" required="">
            </div>

            <div class="form-label-group">
                <label for="password_confirmation" class="sr-only">确认密码</label>
                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="确认密码" required="">
            </div>

            <div class="form-label-group">
                <label for="inputEmail" class="sr-only">邮箱</label>
                <input type="email" id="inputEmail" class="form-control" name="email" placeholder="邮箱" required="">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">注 册</button>

            <p class="redirect-login">已有账号？ <a class="" href="{{ url('login') }}">登 录</a></p>
        </form>
    </div>
</body>
</html>