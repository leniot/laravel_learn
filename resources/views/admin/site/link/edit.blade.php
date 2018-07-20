@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            链接
            <small>创建</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> links</a></li>
            <li class="active"> create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('site/links') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返回
                        </a>
                    </div>
                    <form class="form-horizontal" pjax-container action="{{ admin_base_path('site/links') }}" method="post">
                        @csrf
                        <div class="box-body">

                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $linkInfo->name }}" placeholder="链接名称...">
                                    </div>

                                    @if ($errors->has('name'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('site_address') ? ' has-error' : '' }}">
                                    <label for="site_address" class="col-sm-3 control-label">web 地 址：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="site_address" name="site_address" value="{{ $linkInfo->site_address }}" placeholder="链接地址（带http或https）...">
                                    </div>

                                    @if ($errors->has('site_address'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('site_address') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
                                    <label for="category" class="col-sm-3 control-label">分 类：</label>

                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="category">
                                            <option value="">-- 选 择 链 接 类 别 --</option>
                                            @foreach($categoryList as $category)
                                                <option value="{{ $category->id }}" @if($linkInfo->category_id == $category->id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if ($errors->has('category'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('category') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                                    <label for="logo" class="col-sm-3 control-label">图 标：</label>

                                    <div class="col-sm-8">
                                        <div class="fileinput @if($linkInfo->logo) fileinput-exists @else fileinput-new @endif" data-provides="fileinput">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                                <img alt="avatar" src="{{ asset($linkInfo->logo) }}" style="max-height: 140px;">
                                                <input type="hidden" name="avatar" value="{{ $linkInfo->logo }}">
                                            </div>
                                            <div>
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">上 传</span>
                                                <span class="fileinput-exists">更 换</span>
                                                <input type="file" name="avatar">
                                            </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">移 除</a>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($errors->has('logo'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('sort') ? ' has-error' : '' }}">
                                    <label for="sort" class="col-sm-3 control-label">排 序：</label>

                                    <div class="col-sm-8">
                                        <input type="number" id="sort" class="form-control" name="sort" value="{{ $linkInfo->sort }}"
                                               placeholder="输入数字...">
                                    </div>

                                    @if ($errors->has('sort'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('sort') }}</strong>
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="col-sm-3 control-label">状 态：</label>

                                    <div class="col-sm-8">
                                        <label class="margin-r-5">
                                            <input type="radio" name="status" class="minimal-red" value="1" checked> 启 用
                                        </label>

                                        <label class="margin-r-5">
                                            <input type="radio" name="status" class="minimal-red" value="0" @if ($linkInfo->status == 0) checked @endif> 禁 用
                                        </label>
                                    </div>

                                    @if ($errors->has('status'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('status') }}</strong>
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

    <script type="text/javascript" charset="UTF-8">
        $(function () {
            //select2
            $('.select2').select2();

            //Red color scheme for iCheck
            $('input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
        });
    </script>

@endsection