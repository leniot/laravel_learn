@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            角色
            <small>创建</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> roles</a></li>
            <li class="active"> create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('auth/roles') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返 回
                        </a>
                    </div>
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/roles') }}" method="post">
                        @csrf
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('identifier') ? ' has-error' : '' }}">
                                    <label for="identifier" class="col-sm-3 control-label">角 色 标 识：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="identifier" value="{{ old('identifier') }}"
                                               name="identifier" placeholder="输入角色唯一标识">
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
                                    <label for="name" class="col-sm-3 control-label">中 文 名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" value="{{ old('name') }}"
                                               name="name" placeholder="输入角色中文名称">
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('policies') ? ' has-error' : '' }}">
                                    <label for="method" class="col-sm-3 control-label">权 限 策 略：</label>

                                    <div class="col-sm-8">
                                        <select multiple="multiple" size="10" name="policies[]">
                                            @foreach ($policyList as $policy)
                                                <option value="{{ $policy->id }}">
                                                {{ $policy->identifier.' ['.$policy->name.']' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('policies'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('policies') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('menus') ? ' has-error' : '' }}">
                                    <label for="menus" class="col-sm-3 control-label">可 见 菜 单：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control hide" id="menus" name="menus">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#roleMenuModal">设 置</a>
                                    </div>

                                    @if ($errors->has('menus'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('menus') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                                    <label for="desc" class="col-sm-3 control-label">角 色 描 述：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('desc') }}"
                                               id="desc" name="desc" placeholder="角 色 描 述">
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

    <!-- Modal -->
    <div class="modal fade" id="roleMenuModal" tabindex="-1" role="dialog" aria-labelledby="roleMenuModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="roleMenuModalLabel">可 见 菜 单</h4>
                </div>
                <div class="modal-body">
                    <div id="roleMenuTreeView" class=""></div>
                </div>
            </div>
        </div>
    </div>

    <script>

        var menuTree = '{!! $menuTree !!}';
        $.getScript('{{ asset('js_expand/views-script/role/role-create.js') }}');

    </script>

@endsection