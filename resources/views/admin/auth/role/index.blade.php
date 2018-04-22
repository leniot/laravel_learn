@extends('admin::layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            角色
            <small>列表</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> roles</a></li>
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

    <script type="text/javascript" charset="utf-8">
        $('.table-block').on('click', '.row-delete', function () {
            var id = $(this).data('id');
            swal({
                title: "确定删除此项？",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确 定",
                closeOnConfirm: false,
                cancelButtonText: "取 消"
            }, function(){
                $.ajax({
                    method: 'post',
                    url: '{{ admin_base_path('auth/roles') }}' + '/' + id,
                    data: {
                        _method:'delete',
                        _token:'{{ csrf_token() }}',
                    },
                    success: function (data) {
                        $.pjax.reload('#pjax-container');
                        if (typeof data === 'object') {
                            if (data.status) {
                                swal(data.message, '', 'success');
                            } else {
                                swal(data.message, '', 'error');
                            }
                        }
                    }
                });
            });
        });
    </script>

@endsection