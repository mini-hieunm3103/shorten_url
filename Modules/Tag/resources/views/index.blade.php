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
        <a href="{{route('admin.tag.create')}}" class="btn btn-primary">Thêm mới</a>
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
                            <th>Description</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th>Total Urls </th>
                            <th width="5%">Watch</th>
                            <th width="5%">Edit</th>
                            <th width="5%">Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th>Total Clicks </th>
                            <th width="5%">Watch</th>
                            <th width="5%">Edit</th>
                            <th width="5%">Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($tags as $key => $tag)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{getLimitText($tag->title)}}</td>
                                <td>{{getLimitText($tag->description)}}</td>
                                <td>
                                    <a href="{{route('admin.user.show', $tag->user->id)}}">{{$tag->user->name}}</a>
                                </td>
                                <td>{{$tag->created_at}}</td>
                                <td>{{$tag->total_urls}}</td>
                                <td>
                                    <a href="{{route('admin.tag.show', $tag)}}" class="btn btn-primary">Xem</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.tag.edit', $tag)}}" class="btn btn-warning">Sửa</a>
                                </td>
                                <td>
                                    <a href="{{route('admin.tag.destroy', $tag)}}" class="btn btn-danger delete-action">Xóa</a>
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
                "columnDefs": [
                    { orderable: false, targets: 6 },
                    { orderable: false, targets: 7 },
                    { orderable: false, targets: 8 }
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

