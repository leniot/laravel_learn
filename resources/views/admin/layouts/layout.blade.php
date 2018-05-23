<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js_expand/dataTables.buttons/buttons.dataTables.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/skins/skin-blue.min.css') }}">

    <!-- nprogress -->
    <link rel="stylesheet" href="{{ asset('js_expand/nprogress/nprogress.css') }}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{ asset('js_expand/toastr/build/toastr.min.css') }}">
    <!-- sweetalert -->
    <link rel="stylesheet" href="{{ asset('js_expand/sweetalert/dist/sweetalert.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    <script src="{{ asset('AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery 2 -->
    <script src="{{ asset('js_expand/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- dataTables -->
    <script src="{{ asset('AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js_expand/dataTables.lan.js') }}"></script>
    <script src="{{ asset('js_expand/dataTables.buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    @include('admin::partials.header')

    <!-- Left side column. contains the logo and sidebar -->
    @include('admin::partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content container-fluid" id="pjax-container">

            @yield('content')

            @if(Session::has('toastr'))
                @php
                    $toastr     = Session::get('toastr');
                    $type       = array_get($toastr->get('type'), 0, 'success');
                    $message    = array_get($toastr->get('message'), 0, '');
                    $options    = json_encode($toastr->get('options', []));
                @endphp
                <script>
                    $(function () {
                        toastr.{{$type}}('{!!  $message  !!}', null, {!! $options !!});
                    });
                </script>
            @endif
            
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    @include('admin::partials.control')
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin::partials.footer')
</div>
<!-- ./wrapper -->

<script>
    var csrf_token = '{{ csrf_token() }}';
</script>

<!-- nprogress -->
<script src="{{ asset('js_expand/nprogress/nprogress.js') }}"></script>
<!-- pjax -->
<script src="{{ asset('js_expand/jquery-pjax/jquery.pjax.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('js_expand/toastr/build/toastr.min.js') }}"></script>
<!-- sweetalert -->
<script src="{{ asset('js_expand/sweetalert/dist/sweetalert.min.js') }}"></script>
<!-- admin.base -->
<script src="{{ asset('js_expand/laravel-admin/admin.base.js') }}"></script>
<!-- custom script-->
<script>
    var selectedMenu = "{!! $requestUri !!}";
</script>
</body>
</html>