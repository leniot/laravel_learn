<!DOCTYPE html>
<html>
    <head>
        <title>登录</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="{{ asset('frontend/login/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend/login/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('frontend/login/css/templatemo_style.css') }}" rel="stylesheet" type="text/css">
    </head>

    <body class="templatemo-bg-gray">

        <div class="container">

            <div class="col-md-12">
                <a href="/"><h1>laravel</h1></a>
                <h1 class="margin-bottom-15">用户登录</h1>

                <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="login" method="post">
                    @csrf

                    @if($errors->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>错误!</strong>{{ $errors->first('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="name" class="control-label">用户名</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="用户名" required value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="password" class="control-label">密码</label>
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="密码" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> 记住我
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="submit" value="登 录" class="btn btn-info">
                            <a href="forgot-password.html" class="text-right pull-right">忘记密码?</a>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>第三方登录：</label>
                            <div class="inline-block">
                                <a href="#"><i class="fa fa-qq login-with"></i></a>
                                <a href="#"><i class="fa fa-weixin login-with"></i></a>
                                <a href="#"><i class="fa fa-github login-with"></i></a>
                            </div>
                        </div>
                    </div>

                </form>

                <div class="text-center">
                    <a href="register" class="templatemo-create-new">注册 <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>

            </div>
        </div>

        <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/login/js/bootstrap.min.js') }}"></script>
    </body>

</html>