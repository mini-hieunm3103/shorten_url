@extends('admin.layouts.master')
@section('content')
    @if($errors->any())
        <div class="alert-danger alert text-center font-weight-bold"
             style="
                color:#c4434f;background-color:#f8d7da;border-color:#f5c6cb
             "
        >Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="{{route('admin.tag.store')}}" method="post" id="formHandle">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Title</label>
                    <input id="title" name="title" type="text" class="form-control
                    @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" autofocus placeholder="">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">User</label>
                    <select name="user_id" id=""
                            class="form-control form-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                        <option value="0">Select User</option>
                        @if($users->count())
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if(old('user_id') ?? request()->user_id ?? auth()->user()->id == $user->id) {{'selected'}} @endif>{{$user->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('user_id')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Description <small style="font-size: 16px"> (optional)</small></label>
                    <textarea id="description" name="description" type="text" class="form-control
                    @error('description') is-invalid @enderror"
                           value="{{ old('description') }}" autofocus placeholder=""></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Select the url(s) you want to add</strong></h3>
                    </div>
                    @can('view urls')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Long URL</th>
                                <th>Back-Half</th>
                                <th>Người Đăng</th>
                                <th>Thời Gian</th>
                                <th>Hết Hạn</th>
                                <th width="5%">Clicks</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Long URL</th>
                                <th>Back-Half</th>
                                <th>Người Đăng</th>
                                <th>Thời Gian</th>
                                <th>Hết Hạn</th>
                                <th width="5%">Clicks</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($urls as $key => $url)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="urls[]" value="{{$url->id}}" id="checkbox{{$key+1}}" {{!empty(old('urls')) && in_array( $url->id , old('urls')) || request()->query('url_id') == $url->id ? 'checked' : false}}>
                                    </td>
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
                                    <td>{{$url->clicks}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endcan
                    <x-cannot permission="view urls" />
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <a href="{{ route('admin.tag.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>
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
                "columnDefs" : [
                    // tắt tính năng sort
                    {
                        "orderable": false,
                        "targets": 0
                    }
                ],
                "order": [[5, 'asc']]
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
