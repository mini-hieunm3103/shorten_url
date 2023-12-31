<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('front-end/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('front-end/plugins/datatables-select/css/select.bootstrap4.min.css')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('client/plugins/chosen/css/chosen.min.css')}}">
    @yield('stylesheet')
    <link rel="stylesheet" href="{{asset('client/dist/css/style.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
    @include('client/parts/header')

    @include('client/parts/sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="{{asset('front-end/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('front-end/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('front-end/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!--  Bootstrap 4 -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

<script src="{{asset('front-end/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('front-end/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('front-end/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('front-end/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('front-end/dist/js/adminlte.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('front-end/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('front-end/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('front-end/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('front-end/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('front-end/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

{{--    DataTable Checkbox--}}
<script src="{{asset('front-end/plugins/datatables-select/js/dataTables.select.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="{{asset('client/plugins/chosen/js/chosen.proto.min.js')}}"></script>
<script type="text/javascript" src="{{asset('client/plugins/chosen/js/chosen.jquery.min.js')}}"></script>
@yield('scripts')
<script src="{{asset('client/dist/js/custom.js')}}"></script>
</body>
</html>
