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
        <a href="{{route('admin.group.create')}}" class="btn btn-primary">Thêm mới</a>
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
                            <th>Tên Nhóm</th>
                            <th>Người Tạo</th>
                            <th>Thời Gian</th>
                            <th width="5%">Xem</th>
                            <th width="9%">Phân Quyền</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên Nhóm</th>
                            <th>Người Tạo</th>
                            <th>Thời Gian</th>
                            <th width="5%">Xem</th>
                            <th width="9%">Phân Quyền</th>
                            <th width="5%">Sửa</th>
                            <th width="5%">Xóa</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($groups as $key => $group)
                            <tr class="">
                                <td>{{$key+1}}</td>
                                <td>{{$group->name}}</td>
                                @if($group->user_id)
                                    <td>
                                        <a href="{{route('admin.user.show', $group->userCreate->id)}}">{{$group->userCreate->name}}</a>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{$group->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.group.show', $group)}}" class="btn btn-primary">Xem</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.group.permission', $group)}}" class=" btn btn-secondary">Phân Quyền</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.group.edit', $group)}}" class="btn btn-warning">Sửa</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.group.destroy', $group)}}" class="btn btn-danger delete-action">Xóa</a>
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
                    {"orderable": false, "targets": 4},
                    {"orderable": false, "targets": 5},
                    {"orderable": false, "targets": 6},
                    {"orderable": false, "targets": 7}
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
