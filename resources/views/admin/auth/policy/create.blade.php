@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            权限策略
            <small>创建</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> policies</a></li>
            <li class="active"> create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('auth/policies') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返 回
                        </a>
                    </div>
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/policies') }}" method="post">
                        @csrf
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('identifier') ? ' has-error' : '' }}">
                                    <label for="identifier" class="col-sm-3 control-label">策 略 标 识：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="identifier" value="{{ old('identifier') }}"
                                               name="identifier" placeholder="输入策略标识">
                                    </div>
                                    @if ($errors->has('identifier'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('identifier') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">策 略 名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                               name="name" placeholder="输入策略名称">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('permissions') ? ' has-error' : '' }}">
                                    <label for="method" class="col-sm-3 control-label">权 限：</label>

                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="permissions[]" multiple>
                                            @foreach ($permissionList as $permission)
                                                <option value="{{ $permission->id }}" @if(in_array($permission->id, old('permissions', []))) selected @endif>
                                                    {{ $permission->route.' ['.$permission->desc.']' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('permissions'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('permissions') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                                    <label for="desc" class="col-sm-3 control-label">策 略 描 述：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('desc') }}"
                                               id="desc" name="desc" placeholder="策 略 描 述">
                                    </div>

                                    @if ($errors->has('desc'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('desc') }}</strong>
                                            </span>
                                        </div>
                                    @endif
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