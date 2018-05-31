@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            类别
            <small>列表</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> categories</a></li>
            <li class="active"> index</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-widget">
                    <div class="box-body table-block">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    {!! $dataTable->scripts() !!}

@endsection