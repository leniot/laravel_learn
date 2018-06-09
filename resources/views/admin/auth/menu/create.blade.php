@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            菜单
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
                        <a href="{{ admin_base_path('auth/menus') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返 回
                        </a>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/menus') }}" method="post">
                            @csrf

                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('pid') ? ' has-error' : '' }}">
                                    <label for="pid" class="col-sm-3 control-label">父 级 菜 单：</label>

                                    <div class="col-sm-8">
                                        <input id="pMenuName" class="form-control" placeholder="请选择父级（留空表示ROOT）" readonly/>
                                        <input id="pid" class="form-control hide" value="0"/>
                                    </div>

                                    <div class="col-sm-offset-3 col-sm-8">
                                        <div id="p_menuTreeView" class="hide" style="position: relative; z-index: 999;"></div>
                                    </div>
                                    @if ($errors->has('pid'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('pid') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title" class="col-sm-3 control-label">菜 单 标 题：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                               name="title" placeholder="输入菜单标题">
                                    </div>
                                    @if ($errors->has('title'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
                                    <label for="icon" class="col-sm-3 control-label">图 标：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="icon" value="{{ old('icon') }}"
                                               name="icon" placeholder="">
                                    </div>
                                    @if ($errors->has('icon'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('icon') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('route') ? ' has-error' : '' }}">
                                    <label for="route" class="col-sm-3 control-label">路 由：</label>

                                    <div class="col-sm-8">
                                        <select id="route" class="form-control select2" name="route" data-placeholder="选择菜单路由" style="width: 100%;">
                                            <option>-- 选择菜单路由 --</option>
                                            @foreach($permissionList as $m_route)
                                                <option value="{{ $m_route->route }}">{{ $m_route->route }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('route'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('route') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('uri') ? ' has-error' : '' }}">
                                    <label for="uri" class="col-sm-3 control-label">URI：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="uri" value="{{ old('uri') }}"
                                               name="uri" placeholder="输入菜单uri">
                                    </div>
                                    @if ($errors->has('uri'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('uri') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
                                    <label for="order" class="col-sm-3 control-label">排 序：</label>

                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="order" value="{{ old('order') }}"
                                               name="order" placeholder="输入排序号（数字）">
                                    </div>
                                    @if ($errors->has('order'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('order') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="role" class="col-sm-3 control-label">角 色：</label>

                                    <div class="col-sm-8">
                                        <select id="role" class="form-control select2" name="role[]" multiple style="width: 100%;"
                                                data-placeholder="选择角色（此菜单对何角色可见）">
                                            @foreach($roleList as $m_role)
                                                <option value="{{ $m_role->id }}">{{ $m_role->identifier.'['.$m_role->name.']' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('role'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('role') }}</strong>
                                            </span>
                                        </div>
                                    @endif
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
        </div>

    </section>
    <!-- /.content -->

    <script>
        $(function() {
            $('.select2').select2();

            var options = {
                bootstrap2: true,
                showTags: true,
                levels: 1,
                data: '{!! $menuTree !!}',
                onNodeSelected: function(event, node) {
                    $('#p_menuTreeView').addClass('hide');
                    $('#pMenuName').val(node.text);
                    $('#pid').val(node.id);
                },
            };

            $('#p_menuTreeView').treeview(options);

            $('#pMenuName').on('click', function () {
                $('#p_menuTreeView').removeClass('hide');
            });
        });
    </script>

@endsection