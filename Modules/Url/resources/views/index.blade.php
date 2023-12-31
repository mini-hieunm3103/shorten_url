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
                        <th width="5%">Custom</th>
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
                        <th width="5%">Custom</th>
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
                            <td>
                                <button type="button" class="btn btn-outline-{{($url->is_custom) ? "success" : "secondary"}}" style="width: 100%;">
                                    @if($url->is_custom)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                        </svg>
                                    @endif
                                </button>
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

