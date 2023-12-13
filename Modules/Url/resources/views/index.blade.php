@extends('admin.layouts.master')
@section('content')
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <div class="mb-3">
        <a href="{{route('admin.url.create')}}" class="btn btn-primary">Thêm mới</a>
    </div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Long URL</th>
                        <th>Back-Half</th>
                        <th>Người Đăng</th>
                        <th>Thời Gian</th>
                        <th>Hết Hạn</th>
                        <th width="5%">Clicks</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Long URL</th>
                        <th>Back-Half</th>
                        <th>Người Đăng</th>
                        <th>Thời Gian</th>
                        <th>Hết Hạn</th>
                        <th width="5%">Clicks</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($urls as $key => $url)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{getLimitText($url->title)}}</td>
                            <td>
                                <a class="limited-url" href="{{$url->long_url}}">{{getLimitUrl($url->long_url)}}</a>
                            </td>
                            <td>
                                <a class="limited-url" href="{{request()->root().'/'.$url->back_half}}">{{$url->back_half}}</a>
                            </td>
                            <td>
                                <a href="{{route('admin.user-urls.show', $url->user->id)}}">{{$url->user->name}}</a>

                            </td>
                            <td>{{$url->created_at}}</td>
                            <td>{{$url->expired_at}}</td>
                            <td>{{$url->clicks}}</td>
                            <td>
                                <a href="{{route('admin.url.edit', $url)}}" class="btn btn-warning">Sửa</a>
                            </td>
                            <td>
                                <a href="{{route('admin.url.destroy', $url)}}" class="btn btn-danger delete-action">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @include('admin/parts/delete')
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

{{--    Sweet Alert--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
@section('stylesheet')
    <style>
        #dataTable_wrapper .row:first-child {
            margin-bottom: 16px;
        }
        .limited-url::after {
            content: attr(href);
            display: none;
        }

        .limited-url:hover::after {
            display: inline-block;
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            padding: 5px;
            z-index: 1;
        }
    </style>
@endsection

