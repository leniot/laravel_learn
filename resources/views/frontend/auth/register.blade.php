<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/form-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/js/html5shiv.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/respond.min.js') }}" type="text/javascript"></script>
    <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/assets/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/assets/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/assets/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/assets/ico/apple-touch-icon-57-precomposed.png') }}">

</head>

<body>

<!-- Top content -->
<div class="top-content">

    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 form-box">
                    <div class="form-top">
                        <div class="form-top-left">
                            <a href="{{ url('/') }}"><img src="{{ asset('frontend/images/laravel.jpg') }}" width="64"></a>
                            <h3>Laravel</h3>
                            <p>发现更大的世界...</p>
                        </div>
                        <div class="form-top-right">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <div class="form-bottom">
                        <form role="form" action="{{ route('register') }}" method="POST" class="login-form">

                            @csrf

                            <div class="form-group">
                                <label class="sr-only" for="form-username">用户名</label>
                                <input type="text" name="name" placeholder="用户名..."
                                       class="form-username form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="form-username" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-password">密码</label>
                                <input type="password" name="password" placeholder="密码..."
                                       class="form-password form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="form-password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="password-confirmation">确认密码</label>
                                <input type="password" name="password_confirmation" placeholder="确认密码..."
                                       class="form-password form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password-confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="sr-only" for="form-email">邮箱</label>
                                <input type="email" name="email" placeholder="邮箱（用于密码找回）..."
                                       class="form-email form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="form-email" value="" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn">注册</button>
                        </form>

                        <hr>
                        <div class="form-bottom-center" style="text-align: center;">
                            <p>已有账号？<a href="{{ url('/login') }}">登录</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Javascript -->
<script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('frontend/assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.backstretch.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

<!--[if lt IE 10]>
<script src="{{ asset('frontend/assets/js/placeholder.js') }}"></script>
<![endif]-->

</body>

</html>