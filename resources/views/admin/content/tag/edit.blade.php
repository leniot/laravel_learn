@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            标签
            <small>编辑</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> articles</a></li>
            <li class="active"> edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                        <a href="{{ admin_base_path('content/tags') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> 返回
                        </a>
                    </div>
                    <form class="form-horizontal" action="{{ admin_base_path('content/tags').'/'.$tag->id }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="box-body">
                            <div class="fields-group">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-3 control-label">标 签 名 称：</label>

                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="标 签 名 称" value="{{ $tag->name }}">
                                    </div>

                                    @if ($errors->has('name'))
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <span class="invalid-feedback">
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
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