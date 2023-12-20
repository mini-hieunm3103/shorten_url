@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input readonly id="name" name="name" type="text" class="form-control"
                       value="{{ $group->name }}" autofocus placeholder="Tên Nhóm...">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Người Tạo</label>
                <input class="form-control" type="text" readonly value="{{$group->user_id ? $group->userCreate->name : false}}">
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>Danh Sách Thành Viên Nhóm:</b></h3>
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
                            <th width="5%">Xem</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>{{$user['created_at']}}</td>
                                <td>
                                    <a href="{{route('admin.user.show', $user['id'])}}" class="btn btn-primary">Xem</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.user.edit', $user['id'])}}" class="btn btn-warning">Sửa</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.user.destroy', $user['id'])}}" class="btn btn-danger delete-action">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('admin/parts/delete')
                </div>
            </div>
        </div>
        <div class="col-12">
            <a href="{{ route('admin.group.index') }}" class="btn btn-primary">Quay Lại</a>
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
                    {"orderable": false, "targets": 4},
                    {"orderable": false, "targets": 5},
                    {"orderable": false, "targets": 6},
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
