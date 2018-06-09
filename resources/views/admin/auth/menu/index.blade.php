@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            菜单
            <small>列表</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> menus</a></li>
            <li class="active"> index</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header">
                        <a class="btn btn-default" href="{{ admin_base_path('auth/menus/create') }}">
                            <span>
                                <i class="fa fa-plus"></i>
                                 添 加
                            </span>
                        </a>
                        <a class="btn btn-default menu-edit">
                            <span>
                                <i class="fa fa-edit"></i>
                                 编 辑
                            </span>
                        </a>
                        <a class="btn btn-default menu-del">
                            <span>
                                <i class="fa fa-trash"></i>
                                 删 除
                            </span>
                        </a>
                    </div>
                    <div class="box-body">
                        <div id="menuTreeView" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <script charset="utf-8">
        $(function() {

            var options = {
                bootstrap2: true,
                showTags: true,
                levels: 1,
                data: '{!! $menuTree !!}',
                onNodeSelected: function(event, node) {
                    var menuId = node.id;
                    var base_path = '{{ admin_base_path('auth/menus/') }}/';
                    $('a.menu-edit').attr('href', base_path + menuId + '/edit');
                    $('a.menu-del').attr('data-id', menuId);
                },
            };

            $('#menuTreeView').treeview(options);
        });
    </script>

@endsection