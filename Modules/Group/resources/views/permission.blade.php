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
            <form action="{{route('admin.group.permission-handle', ['id' => $group->id])}}" method="post">
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><b>Phân Quyền Cho Nhóm: {{$group->name}} </b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Modules</th>
                                        <th style="text-align: center" width=7%">View All</th>
                                        <th style="text-align: center" width=7%">Show Detail</th>
                                        <th style="text-align: center" width=7%">Create</th>
                                        <th style="text-align: center" width=7%">Edit</th>
                                        <th style="text-align: center" width=7%">Delete</th>
                                        <th style="text-align: center" width=7%">Permission</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Modules</th>
                                    <th style="text-align: center" width=7%">View All</th>
                                    <th style="text-align: center" width=7%">Show Detail</th>
                                    <th style="text-align: center" width=7%">Create</th>
                                    <th style="text-align: center" width=7%">Edit</th>
                                    <th style="text-align: center" width=7%">Delete</th>
                                    <th style="text-align: center" width=7%">Permission</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($modules as $module)
                                    <tr>
                                        <td>{{$module->title}}</td>
                                        <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        @if($module->name == 'group')
                                            <td style="text-align: center"><input class="" type="checkbox" name="" id=""></td>
                                        @else
                                            <td style="text-align: center"><input disabled class="" type="checkbox" name="" id=""></td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Lưu lại</button>
                    <a href="{{ route('admin.group.index') }}" class="btn btn-primary">Quay Lại</a>
                </div>
            </form>
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
                "ordering": false,
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
        input[type=checkbox] {
            transform: scale(1.6);
            border-radius: 50%;
        }
    </style>
@endsection
