<!DOCTYPE html>
<head>
    <title>注册</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('frontend/login/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/login/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/login/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/login/css/templatemo_style.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="templatemo-bg-gray">
<h1 class="margin-bottom-15">用户注册</h1>
<div class="container">
    <div class="col-md-12">
        <form class="form-horizontal templatemo-create-account templatemo-container" role="form" action="#" method="post">
            <div class="form-inner">

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="username" class="control-label">用户名</label>
                        <input type="text" class="form-control" id="first_name" placeholder="用户名">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="email" class="control-label">邮箱</label>
                        <input type="email" class="form-control" id="email" placeholder="邮箱">
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="control-label">手机号</label>
                        <input type="text" class="form-control" id="mobile" placeholder="手机号" min="11">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="password" class="control-label">密码</label>
                        <input type="password" class="form-control" id="password" placeholder="密码">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="control-label">确认密码</label>
                        <input type="password" class="form-control" id="password_confirm" placeholder="确认密码">
                    </div>
                </div>

                {{--<div class="form-group">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<label><input type="checkbox">I agree to the <a href="javascript:;" data-toggle="modal" data-target="#templatemo_modal">Terms of Service</a> and <a href="#">Privacy Policy.</a></label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" value="注册" class="btn btn-info">
                        <a href="login" class="pull-right">登录</a>
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
            </div>
        </form>
    </div>
</div>
{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="templatemo_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>--}}
                {{--<h4 class="modal-title" id="myModalLabel">Terms of Service</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--<p>This form is provided by <a rel="nofollow" href="http://www.cssmoban.com/page/1">Free HTML5 Templates</a> that can be used for your websites. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>--}}
                {{--<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla. Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>--}}
                {{--<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<script type="text/javascript" src="{{ asset('frontend/login/js/jquery-1.11.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/login/js/bootstrap.min.js') }}"></script>

</body>
</html>