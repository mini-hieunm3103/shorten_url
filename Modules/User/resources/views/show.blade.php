@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input id="name" name="name" type="text" class="form-control"
                       value="{{ $user->name }}" readonly autofocus>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input id="email" name="email" type="email" readonly
                       class="form-control" value="{{ $user->email }}">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Nhóm</label>
                <select disabled name="group_id" class="form-control @error('group_id') is-invalid @enderror">
                    <option value="{{$user->group->id}}">{{$user->group->name}}</option>
                </select>
            </div>
        </div>

        <div class="col-2">
            <div class="mb-3">
                <label for="">Total Urls</label>
                <input readonly class="form-control" value="{{count($urls)}}">
            </div>
        </div>
        <div class="col-2">
            <div class="mb-3">
                <label for="">Total Clicks Urls</label>
                <input readonly class="form-control" value="{{$user->count_clicks}}">
            </div>
        </div>
        <div class="col-2">
            <div class="mb-3">
                <label for="">Total Tags</label>
                <input readonly class="form-control" value="{{count($tags)}}">
            </div>
        </div>
    </div>
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <div class="mb-3 ml-2">
        <a href="{{route('admin.user.edit', compact('user'))}}" class="btn btn-warning" style="color: #ffffff">Chỉnh sửa người dùng</a>
        <a href="{{route('admin.user.index')}}" class="btn btn-secondary">Quay về</a>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Shorten URL  Created By {{$user->name}}</h3>
            </div>
            @can('view urls')
            <!-- /.card-header -->
            <div class="card-body">
                <table id="urlsTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Title</th>
                        <th>Long URL</th>
                        <th>Back-Half</th>
                        <th>Created At</th>
                        <th>Expired At</th>
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
                        <th>Created At</th>
                        <th>Expired At</th>
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
            @endcan
            <x-cannot permission="view urls"/>
        </div>
    </div>
    @can('create url')
    <div class="mb-3 ml-2">
        <a href="{{route('admin.url.create', ['user_id' => $user->id])}}" class="btn btn-primary">Thêm Mới URL Rút Gọn</a>
    </div>
    @endcan
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tags Created By {{$user->name}} </h3>
            </div>
            <!-- /.card-header -->
            @can('view tags')
            <div class="card-body">
                <table id="tagsTable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Title Tag</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Delete</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>STT</th>
                        <th>Title Tag</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th width="5%">Edit</th>
                        <th width="5%">Delete</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($tags as $key => $tag)
                        <tr >
                            <td>{{$key+1}}</td>
                            <td>{{getLimitText($tag->title)}}</td>
                            <td>{{getLimitText($tag->description)}}</td>
                            <td>{{$tag->created_at}}</td>
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
            </div>
            @endcan
            <x-cannot permission="view tags"/>
        </div>
    </div>
    @can('create tag')
        <div class="mb-3 ml-2">
            <a href="{{route('admin.tag.create', ['user_id' => $user->id])}}" class="btn btn-primary">Thêm Mới Nhãn Dán</a>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            $('#urlsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [
                    { orderable: false, targets: 7 },
                    { orderable: false, targets: 8 },
                ],
                "order": [[0, 'asc']],
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#urlsTable_wrapper .col-md-6:eq(0)');
            $('#tagsTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [
                    { orderable: false, targets: 4 },
                    { orderable: false, targets: 5 }
                ],
                "order": [[0, 'asc']],
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#tagsTable_wrapper .col-md-6:eq(0)');
        });

    </script>
@endsection
@section('stylesheet')
    <style>
        #urlsTable_wrapper .row:first-child {
            margin-bottom: 16px;
        }
        #tagsTable_wrapper .row:first-child {
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
