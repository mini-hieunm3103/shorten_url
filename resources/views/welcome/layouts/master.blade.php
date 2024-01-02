<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Top Navigation</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('front-end/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('front-end/dist/css/adminlte.min.css')}}">
    @yield('stylesheet')
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

@include('welcome.parts.sidebar')
{{--    Content--}}
    <div class="content-wrapper">
        @include('welcome.parts.header')
        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
@include('welcome.parts.footer')
</div>
    <!-- jQuery -->
    <script src="{{asset('front-end/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('front-end/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('front-end/dist/js/adminlte.min.js')}}"></script>
</div>
</body>
</html>
