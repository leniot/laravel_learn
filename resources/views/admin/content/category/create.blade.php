@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            文章类别
            <small>创建</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> categories</a></li>
            <li class="active"> create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('content/articleCategories') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返回
                        </a>
                    </div>
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('content/articleCategories') }}" method="post">
                        @csrf
                        <div class="box-body">

                            <div class="fields-group">

                                <div class="form-group {{ $errors->has('pid') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">父 级 分 类：</label>

                                    <div class="col-sm-8">
                                        <input id="pCategoryName" class="form-control" placeholder="请选择父级分类（留空表示ROOT）" readonly data-toggle="modal" data-target="#pCategoryModal"/>
                                        <input id="pid" class="form-control hide" name="pid" value="0"/>
                                    </div>

                                    @if ($errors->has('pid'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('pid') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">类 别 名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="类别名称...">
                                    </div>

                                    @if ($errors->has('name'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('keywords') ? ' has-error' : '' }}">
                                    <label for="keywords" class="col-sm-3 control-label">关 键 词：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords') }}" placeholder="关键词...">
                                    </div>

                                    @if ($errors->has('keywords'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('keywords') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description" class="col-sm-3 control-label">描 述：</label>

                                    <div class="col-sm-8">
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="描述...">{{ old('description') }}</textarea>
                                    </div>

                                    @if ($errors->has('description'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-3 control-label">排 序：</label>

                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="sort" name="sort" placeholder="排序..." value="{{ old('sort') }}">
                                    </div>

                                    @if ($errors->has('sort'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('sort') }}</strong>
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
        <div class="modal fade" id="pCategoryModal" tabindex="-1" role="dialog" aria-labelledby="pCategoryModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="pCategoryModalLabel">请选择父级分类</h4>
                    </div>
                    <div class="modal-body">
                        <div id="p_categoryTreeView" class=""></div>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal-->

    <script>
        var options = {
            bootstrap2: true,
            showTags: true,
            levels: 1,
            data: '{!! $categoryTree !!}',
            onNodeSelected: function(event, node) {
                $('#pCategoryName').val(node.text);
                $('#pid').val(node.id);
                $('#pCategoryModal').modal('hide');
            },
        };

        $('#p_categoryTreeView').treeview(options);
    </script>

@endsection