@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            菜单
            <small>编辑</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> menus</a></li>
            <li class="active"> edit</li>
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
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('auth/menus').'/'.$menu->id }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="box-body">

                            <div class="fields-group">

                                <div class="form-group {{ $errors->has('pid') ? ' has-error' : '' }}">
                                    <label for="pid" class="col-sm-3 control-label">父 级 菜 单：</label>

                                    <div class="col-sm-8">
                                        <input id="pMenuName" class="form-control" placeholder="请选择父级（留空表示ROOT）" readonly data-toggle="modal" data-target="#pMenuModal" value="@if($menu->pid == 0) ROOT(根菜单) @else {{ $pmenu->title }} @endif"/>
                                        <input id="pid" class="form-control hide" name="pid" value="{{ $menu->pid }}"/>
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
                                        <input type="text" class="form-control" id="title" value="{{ $menu->title }}"
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
                                        <button id="menu_icon_picker" class="btn btn-default" data-iconset="fontawesome" data-icon="{{ $menu->icon }}" role="iconpicker" data-rows="3" data-cols="8"></button>
                                        <input type="hidden" class="form-control" id="icon" value="{{ $menu->icon }}"
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

                                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                    <label for="type" class="col-sm-3 control-label">类 型：</label>

                                    <div class="col-sm-8">
                                        <label>
                                            <input type="radio" id="type_node" name="type" class="menu-type" value="0" @if($menu->type == 0) checked @endif>
                                            节点
                                        </label>

                                        <label>
                                            <input type="radio" id="type_uri" name="type" class="menu-type" value="1" @if($menu->type == 1) checked @endif>
                                            uri
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
                                <div class="uri-block {{ $menu->type == 0 ? 'hide' : 'show' }}">

                                    <div class="form-group {{ $errors->has('uri') ? ' has-error' : '' }}">
                                        <label for="uri" class="col-sm-3 control-label">URI：</label>

                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="uri" value="{{ $menu->uri }}"
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

                                </div>

                                <div class="form-group {{ $errors->has('order') ? ' has-error' : '' }}">
                                    <label for="order" class="col-sm-3 control-label">排 序：</label>

                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="order" value="{{ $menu->order }}"
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
    <div class="modal fade" id="pMenuModal" tabindex="-1" role="dialog" aria-labelledby="pMenuModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="pMenuModalLabel">请选择父级菜单</h4>
                </div>
                <div class="modal-body">
                    <div id="p_menuTreeView" class=""></div>
                </div>
                {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

    <script>

        $('input[type="radio"].menu-type').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        });

        $('.menu-type').on('ifChecked', function (event) {
            if ($(this).val() == 1) {
                $('.uri-block').removeClass('hide');
            }else{
                $('.uri-block').addClass('hide');
            }
        });

        var options = {
            bootstrap2: true,
            showTags: true,
            levels: 1,
            data: '{!! $menuTree !!}',
            onNodeSelected: function(event, node) {
                // alert(node.text);
                $('#pMenuName').val(node.text);
                $('#pid').val(node.id);
                $('#pMenuModal').modal('hide');
            },
        };

        $('#p_menuTreeView').treeview(options);

        $('#menu_icon_picker').iconpicker().on('change', function (e) {
            $('#icon').val(e.icon);
        });
    </script>

@endsection