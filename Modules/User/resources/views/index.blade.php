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
        <a href="{{route('admin.user.create')}}" class="btn btn-primary">Thêm mới</a>
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
                        <th>Họ Và Tên</th>
                        <th>Email</th>
                        <th>Thời Gian</th>
                        <th width="10%">Shorten URLs</th>
                        <th width="10%">Total Clicks</th>
                        <th width="5%">Xem</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Họ Và Tên</th>
                        <th>Email</th>
                        <th>Thời Gian</th>
                        <th width="10%">Shorten URLs</th>
                        <th width="10%">Total Clicks</th>
                        <th width="5%">Xem</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->total_urls}}</td>
                            <td>{{$user->total_clicks}}</td>
                            <td>
                                <a href="{{route('admin.user-urls.show', $user->id)}}" class="btn btn-primary">Xem</a>
                            </td>
                            <td>
                                <a href="{{route('admin.user.edit', $user)}}" class="btn btn-warning">Sửa</a>
                            </td>
                            <td>
                                <a href="{{route('admin.user.destroy', $user)}}" class="btn btn-danger delete-action">Xóa</a>
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
    </style>
@endsection

