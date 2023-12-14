@extends('admin.layouts.master')
@section('content')
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="">Destination</label>
                    <input readonly id="long_url" name="long_url" type="text" class="form-control"
                           value="{{ $url->long_url }}" autofocus placeholder="https://example.com/my-long-url">
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="">Clicks</label>
                    <input readonly id="back_half" name="back_half" type="text" class="form-control"
                           value="{{ ($url->clicks)}}" autofocus placeholder="">
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="">Total Tags</label>
                    <input readonly id="back_half" name="back_half" type="text" class="form-control"
                           value="{{ count($urlTags) }}" autofocus placeholder="">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Title <small style="font-size: 16px"> (optional)</small></label>
                    <input readonly id="title" name="title" type="text" class="form-control"
                           value="{{$url->title }}" autofocus placeholder="">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Back-half</label>
                    <input readonly id="back_half" name="back_half" type="text" class="form-control"
                           value="{{$url->back_half }}" autofocus placeholder="">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">User</label>
                    <select disabled name="user_id" id=""
                            class="form-control form-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                        <option value="0">{{$url->user->name}}</option>
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tags: </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Created At</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($urlTags as $key => $tag)
                                <tr >
                                    <td>{{$key+1}}</td>
                                    <td>{{getLimitText($tag->title)}}</td>
                                    <td>{{getLimitText($tag->description)}}</td>
                                    <td>
                                        <a href="{{route('admin.user-urls.show', $tag->user->id)}}">{{$tag->user->name}}</a>
                                    </td>
                                    <td>{{$tag->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mb-3 ml-2">
                <a href="{{route('admin.url.edit', compact('url'))}}" class="btn btn-warning">Chỉnh sửa URL rút gọn</a>
                <a href="{{route('admin.tag.create')}}" class="btn btn-primary">Thêm Mới Nhãn Dán</a>
                <a href="{{route('admin.url.index')}}" class="btn btn-secondary">Quay về</a>
            </div>
        </div>
@endsection
@section('scripts')
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
                "order": [[1, 'asc']]
            });
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
        tr.selected a {
            color: #FFFFFF !important;
        }
        input[type="checkbox"] {
            transform: scale(1.4); /* Phóng to 2 lần kích thước */
        }
    </style>
@endsection
