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
                        <th>Nhóm</th>
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
                        <th>Nhóm</th>
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
                            <td>{{(!empty($user->group->name)) ? $user->group->name : 'Không có nhóm?'}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->total_urls}}</td>
                            <td>{{$user->total_clicks}}</td>
                            <td>
                                <a href="{{route('admin.user.show', $user)}}" class="btn btn-primary">Xem</a>
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
                "columnDefs" : [
                    // tắt tính năng sort
                    {"orderable": false, "targets": 7},
                    {"orderable": false, "targets": 8},
                    {"orderable": false, "targets": 9},
                ],
                "order": [[0, 'asc']],

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

