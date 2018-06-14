@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            权限路由
            <small>编辑</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> permissions</a></li>
            <li class="active"> create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('auth/permissions') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返回
                        </a>
                    </div>
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/permissions'.'/'.$permission->id) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('route') ? ' has-error' : '' }}">
                                    <label for="route" class="col-sm-3 control-label">路 由 名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="route" value="{{ $permission->route }}"
                                               name="route" placeholder="填入路由名称(路由别名)">
                                    </div>
                                    @if ($errors->has('route'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('route') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('method') ? ' has-error' : '' }}">
                                    <label for="method" class="col-sm-3 control-label">请 求 方 式：</label>

                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="method">
                                            <option value="GET" {{ $permission->method == 'GET' ? ' selected' : '' }}>GET</option>
                                            <option value="POST" {{ $permission->method == 'POST' ? ' selected' : '' }}>POST</option>
                                            <option value="PUT/PATCH" {{ $permission->method == 'PUT/PATCH' ? ' selected' : '' }}>PUT/PATCH</option>
                                            <option value="DELETE" {{ $permission->method == 'DELETE' ? ' selected' : '' }}>DELETE</option>
                                        </select>
                                    </div>

                                    @if ($errors->has('method'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('method') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                                    <label for="desc" class="col-sm-3 control-label">描 述：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ $permission->desc }}"
                                               id="desc" name="desc" placeholder="权 限 描 述">
                                    </div>

                                    @if ($errors->has('desc'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('desc') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type_menu" class="col-sm-3 control-label">类 型：</label>

                                    <div class="col-sm-8">
                                        <div class="radio">
                                            <label class="margin-r-5">
                                                <input type="radio" name="type" id="type_normal" value="0" checked="" {{ $permission->type == 0 ? ' checked' : '' }}>
                                                普 通
                                            </label>
                                            <label class="margin-r-5">
                                                <input type="radio" name="type" id="type_menu" value="1" {{ $permission->type == 1 ? ' checked' : '' }}>
                                                菜 单
                                            </label>
                                        </div>

                                        @if ($errors->has('type'))
                                            <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('type') }}</strong>
                                            </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="reset" class="btn btn-warning pull-left">
                                    <i class="fa fa-rotate-left"></i> 撤 销
                                </button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-save"></i> 提 交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->

    <script>
        $('.select2').select2()
    </script>

@endsection