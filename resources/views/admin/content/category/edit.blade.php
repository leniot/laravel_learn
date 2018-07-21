@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            类别
            <small>编辑</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> categories</a></li>
            <li class="active"> edit</li>
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
                    <form class="form-horizontal" action="{{ admin_base_path('content/articleCategories').'/'.$category->id }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('pid') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">父 级 分 类：</label>

                                    <div class="col-sm-8">
                                        <input id="pCategoryName" class="form-control" placeholder="请选择父级分类（留空表示ROOT）" readonly data-toggle="modal" data-target="#pCategoryModal" value="@if($category->pid) {{ $pCategory->name }} @endif"/>
                                        <input id="pid" class="form-control hide" name="pid" value="{{ $category->pid }}"/>
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
                                        <input type="text" class="form-control" id="name" name="name" placeholder="类 别 名 称" value="{{ $category->name }}">
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
                                        <input type="text" class="form-control" id="keywords" name="keywords" placeholder="关 键 词" value="{{ $category->keywords }}">
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
                                        <textarea type="text" class="form-control" id="description" name="description" placeholder="类 别 描 述">{{ $category->description }}</textarea>
                                    </div>

                                    @if ($errors->has('keywords'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('keywords') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-3 control-label">排 序：</label>

                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="sort" name="sort" placeholder="排序..." value="{{ $category->sort }}">
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

@endsection