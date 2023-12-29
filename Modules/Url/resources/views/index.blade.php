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
            <x-admin-btn module="url" type="primary" action="create" :data="null"  />
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
                        <th>User</th>
                        <th>Created At</th>
                        <th>Expired At</th>
                        <th width="5%">Archived</th>
                        <th width="5%">Clicks</th>
                        <th width="5%">Watch</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Delete</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Long URL</th>
                        <th>Back-Half</th>
                        <th>User</th>
                        <th>Created At</th>
                        <th>Expired At</th>
                        <th width="5%">Archived</th>
                        <th width="5%">Clicks</th>
                        <th width="5%">Watch</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Delete</th>
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
                                <a @can('show user') href="{{route('admin.user.show', $url->user->id)}}" @endcan>{{$url->user->name}}</a>
                            </td>
                            <td>{{$url->created_at}}</td>
                            <td>{{$url->expired_at}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-{{($url->archived) ? "info" : "secondary"}}" style="width: 100%;">{{($url->archived) ? "Active" : "Hidden"}}</button>
                            </td>
                            <td>{{$url->clicks}}</td>
                            <td>
                                <x-admin-btn module="url" type="success" action="show" :data="$url->id"  />
                            </td>
                            <td>
                                <x-admin-btn module="url" type="warning" action="edit" :data="$url->id"  />
                            </td>
                            <td>
                                <x-admin-btn module="url" type="danger" action="delete" :data="$url->id"  />
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
                    {"orderable": false, "targets": 9},
                    {"orderable": false, "targets": 10},
                    {"orderable": false, "targets": 11},
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

