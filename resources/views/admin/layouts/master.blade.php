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
    @yield('stylesheet')
    <link rel="stylesheet" href="{{asset('admin/dist/css/style.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @php
    $moduleArr = DB::table('modules')->get();
    $modules = [];
    foreach ($moduleArr as $module) {
        $modules[$module->name]['title'] = $module->title;
        $modules[$module->name]['icon'] = !empty($module->icon) ? $module->icon : $module->name;
    }
        $actionArr = [
            'index' => 'Danh Sách',
            'create' => 'Thêm Mới',
            'edit' => 'Cập Nhật',
            'show' => 'Thông Tin Chi Tiết',
            'permission' => 'Phân Quyền'
        ];
    @endphp
    @include('admin/parts/header')

    @include('admin/parts/sidebar', compact('modules'))
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
            @include('admin/parts/title', compact('modules', 'actionArr'))
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin/parts/footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('front-end/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('front-end/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
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
<!-- AdminLTE App -->
<script src="{{asset('front-end/dist/js/adminlte.min.js')}}"></script>
@yield('scripts')
<script src="{{asset('admin/dist/js/custom.js')}}"></script>
</body>
</html>
