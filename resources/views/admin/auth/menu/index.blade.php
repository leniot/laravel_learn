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
                        <div id="treeview" class=""></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <script>
        function buildDomTree() {

            var defaultData = [
                {
                    text: 'Parent 1',
                    href: '#parent1',
                    icon: 'fa fa-user',
                    nodes: [
                        {
                            text: 'Child 1',
                            href: '#child1',
                            nodes: [
                                {
                                    text: 'Grandchild 1',
                                    href: '#grandchild1',
                                },
                                {
                                    text: 'Grandchild 2',
                                    href: '#grandchild2',
                                }
                            ]
                        },
                        {
                            text: 'Child 2',
                            href: '#child2',
                        }
                    ]
                },
                {
                    text: 'Parent 2',
                    href: '#parent2',
                },
                {
                    text: 'Parent 3',
                    href: '#parent3',
                },
                {
                    text: 'Parent 4',
                    href: '#parent4',
                },
                {
                    text: 'Parent 5',
                    href: '#parent5'  ,
                }
            ];
            return defaultData;
        }

        $(function() {

            var options = {
                bootstrap2: true,
                showTags: true,
                levels: 5,
                data: buildDomTree(),
                onNodeSelected: function(event, node) {
                    var nodeId = node.nodeId;
                    var base_path = '{{ admin_base_path('auth/menus/') }}/';
                    $('a.menu-edit').attr('href', base_path + nodeId + '/edit');
                    $('a.menu-del').attr('data-id', nodeId);
                },
            };

            $('#treeview').treeview(options);
        });
    </script>

@endsection