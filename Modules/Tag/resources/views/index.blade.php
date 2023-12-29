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
        <x-admin-btn module="tag" type="primary" action="create" :data="null"  />
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh Sách Tags:</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
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
                                <td>
                                    <a @can('show user') href="{{route('admin.user.show', $tag->user->id)}}" @endcan>{{$tag->user->name}}</a>
                                </td>
                                <td>{{$tag->created_at}}</td>
                                <td>{{$tag->total_urls}}</td>
                                <td>
                                    <x-admin-btn module="tag" type="success" action="show" :data="$tag->id"  />
                                </td>
                                <td>
                                    <x-admin-btn module="tag" type="warning" action="edit" :data="$tag->id"  />
                                </td>
                                <td>
                                    <x-admin-btn module="tag" type="danger" action="delete" :data="$tag->id"  />
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
                    { orderable: false, targets: 5 },
                    { orderable: false, targets: 6 },
                    { orderable: false, targets: 7 }
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

