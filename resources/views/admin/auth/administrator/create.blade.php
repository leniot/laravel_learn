@extends('admin::layouts.layout')@section('content')    <!-- Content Header (Page header) -->    <section class="content-header">        <h1>            管理员            <small>创建</small>        </h1>        <ol class="breadcrumb">            <li><a href="#"><i class="fa fa-home"></i> administrators</a></li>            <li class="active"> create</li>        </ol>    </section>    <!-- Main content -->    <section class="content container-fluid">        <div class="row">            <div class="col-sm-12">                <div class="box box-widget">                    <div class="box-header with-border">                        <a href="{{ admin_base_path('auth/administrators') }}" class="btn btn-default">                            <i class="fa fa-arrow-left"></i> 返回                        </a>                    </div>                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/administrators') }}" method="post">                        @csrf                        <div class="box-body">                            <div class="fields-group">                                <div class="form-group {{ $errors->has('login_name') ? ' has-error' : '' }}">                                    <label for="login_name" class="col-sm-3 control-label">登 录 名：</label>                                    <div class="col-sm-8">                                        <input type="text" class="form-control" id="login_name" name="login_name" value="{{ old('login_name') }}" placeholder="登 录 名">                                    </div>                                    @if ($errors->has('login_name'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('login_name') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="fields-group">                                <div class="form-group {{ $errors->has('display_name') ? ' has-error' : '' }}">                                    <label for="display_name" class="col-sm-3 control-label">显 示 名：</label>                                    <div class="col-sm-8">                                        <input type="text" class="form-control" id="display_name" name="display_name" value="{{ old('display_name') }}" placeholder="显 示 名">                                    </div>                                    @if ($errors->has('display_name'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('display_name') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }}">                                <label class="col-sm-3 control-label">头 像：</label>                                <div class="col-sm-8">                                    <div class="bs-example">                                        <div class="fileinput fileinput-new" data-provides="fileinput">                                            {{--<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">--}}                                            {{--<img data-src="holder.js/100%x100%" alt="cover_image">--}}                                            {{--</div>--}}                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>                                            <div>                                                <span class="btn btn-default btn-file">                                                    <span class="fileinput-new">上 传</span>                                                    <span class="fileinput-exists">更 换</span>                                                    <input type="file" name="avatar">                                                </span>                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移 除</a>                                            </div>                                        </div>                                    </div>                                </div>                                @if ($errors->has('avatar'))                                    <div class="col-sm-offset-3 col-sm-8">                                        <span class="invalid-feedback">                                            <strong class="text-danger">{{ $errors->first('avatar') }}</strong>                                        </span>                                    </div>                                @endif                            </div>                            <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">                                <label for="method" class="col-sm-3 control-label">角 色：</label>                                <div class="col-sm-8">                                    <select class="form-control select2" style="width: 100%;" name="roles[]" multiple>                                        @foreach ($roleList as $role)                                            <option value="{{ $role->id }}">                                                {{ $role->identifier.' ['.$role->name.']' }}                                            </option>                                        @endforeach                                    </select>                                </div>                                @if ($errors->has('roles'))                                    <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('permissions') }}</strong>                                            </span>                                    </div>                                @endif                            </div>                            <div class="fields-group">                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">                                    <label for="password" class="col-sm-3 control-label">密 码：</label>                                    <div class="col-sm-8">                                        <input type="password" class="form-control" id="password" name="password" placeholder="登 录 密 码">                                    </div>                                    @if ($errors->has('password'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="fields-group">                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">                                    <label for="password_confirmation" class="col-sm-3 control-label">确 认 密 码：</label>                                    <div class="col-sm-8">                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="确 认 密 码">                                    </div>                                    @if ($errors->has('password_confirmation'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                        </div>                        <div class="box-footer">                            <div class="col-sm-offset-3 col-sm-8">                                <button type="reset" class="btn btn-warning pull-left">                                    <i class="fa fa-rotate-left"></i> 撤 销                                </button>                                <button type="submit" class="btn btn-primary pull-right">                                    <i class="fa fa-save"></i> 提 交                                </button>                            </div>                        </div>                    </form>                </div>            </div>        </div>    </section>    <!-- /.content -->    <script>        $('.select2').select2()    </script>@endsection