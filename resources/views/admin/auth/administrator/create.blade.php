@extends('admin::layouts.layout')@section('content')    <!-- Content Header (Page header) -->    <section class="content-header">        <h1>            管理员            <small>创建</small>        </h1>        <ol class="breadcrumb">            <li><a href="#"><i class="fa fa-home"></i> administrators</a></li>            <li class="active"> create</li>        </ol>    </section>    <!-- Main content -->    <section class="content container-fluid">        <div class="row">            <div class="col-sm-12">                <div class="box box-widget">                    <div class="box-header with-border">                        <a href="{{ admin_base_path('auth/administrators') }}" class="btn btn-default">                            <i class="fa fa-arrow-left"></i> 返回                        </a>                    </div>                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/administrators') }}" method="post">                        @csrf                        <div class="box-body">                            <div class="fields-group">                                <div class="form-group">                                    <label for="login_name" class="col-sm-3 control-label">登 录 名：</label>                                    <div class="col-sm-8">                                        <input type="text" class="form-control" id="login_name" name="login_name" value="{{ old('login_name') }}" placeholder="登 录 名">                                    </div>                                    @if ($errors->has('login_name'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('login_name') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="fields-group">                                <div class="form-group">                                    <label for="display_name" class="col-sm-3 control-label">显 示 名：</label>                                    <div class="col-sm-8">                                        <input type="text" class="form-control" id="display_name" name="display_name" value="{{ old('display_name') }}" placeholder="显 示 名">                                    </div>                                    @if ($errors->has('display_name'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('display_name') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="form-group {{ $errors->has('roles') ? ' has-error' : '' }}">                                <label for="method" class="col-sm-3 control-label">权 限：</label>                                <div class="col-sm-8">                                    <select class="form-control select2" style="width: 100%;" name="roles[]" multiple>                                        @foreach ($roleList as $role)                                            <option value="{{ $role->id }}">                                                {{ $role->route.' ['.$permission->desc.']' }}                                            </option>                                        @endforeach                                    </select>                                </div>                                @if ($errors->has('permissions'))                                    <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('permissions') }}</strong>                                            </span>                                    </div>                                @endif                            </div>                            {{--<div class="fields-group">--}}                                {{--<div class="form-group">--}}                                    {{--<label for="avatar" class="col-sm-3 control-label">头 像：</label>--}}                                    {{--<div class="col-sm-8">--}}                                        {{--<input type="text" class="form-control" id="avatar" name="avatar" placeholder="选 择 头 像">--}}                                    {{--</div>--}}                                {{--</div>--}}                            {{--</div>--}}                            <div class="fields-group">                                <div class="form-group">                                    <label for="password" class="col-sm-3 control-label">密 码：</label>                                    <div class="col-sm-8">                                        <input type="password" class="form-control" id="password" name="password" placeholder="登 录 密 码">                                    </div>                                    @if ($errors->has('password'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                            <div class="fields-group">                                <div class="form-group">                                    <label for="password_confirmation" class="col-sm-3 control-label">确 认 密 码：</label>                                    <div class="col-sm-8">                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="确 认 密 码">                                    </div>                                    @if ($errors->has('password_confirmation'))                                        <div class="col-sm-offset-3 col-sm-8">                                            <span class="invalid-feedback">                                                <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>                                            </span>                                        </div>                                    @endif                                </div>                            </div>                        </div>                        <div class="box-footer">                            <div class="col-sm-offset-3 col-sm-8">                                <button type="reset" class="btn btn-warning pull-left">                                    <i class="fa fa-rotate-left"></i> 撤 销                                </button>                                <button type="submit" class="btn btn-primary pull-right">                                    <i class="fa fa-save"></i> 提 交                                </button>                            </div>                        </div>                    </form>                </div>            </div>        </div>    </section>    <!-- /.content -->@endsection