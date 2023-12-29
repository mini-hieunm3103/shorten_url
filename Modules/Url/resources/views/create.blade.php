@extends('admin.layouts.master')
@section('content')
    @if($errors->any())
        <div class="alert-danger alert text-center font-weight-bold"
             style="
                color:#c4434f;background-color:#f8d7da;border-color:#f5c6cb
             "
        >Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="{{route('admin.url.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-10">
                <div class="mb-3">
                    <label for="">Destination</label>
                    <input id="long_url" name="long_url" type="text" class="form-control
                    @error('long_url') is-invalid @enderror"
                           value="{{ old('long_url') }}" autofocus placeholder="https://example.com/my-long-url">
                    @error('long_url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-2">
                <div class="mb-3">
                    <label for="">Archived</label>
                    <select class="form-control" name="archived">
                        <option value="1"  {{old('archived') == 1 || empty(old()) ? 'selected' : false}} >Active</option>
                        <option value="0"  {{!empty(old()) && old('archived') == 0 ? 'selected' : false}} >Hidden</option>
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Title <small style="font-size: 16px"> (optional)</small></label>
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
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Back-half <small style="font-size: 16px"> (optional) (You can customize it) (a-z, A-Z, 0-9)</small></label>
                    <input id="back_half" name="back_half" type="text" class="form-control
                    @error('back_half') is-invalid @enderror"
                           value="{{ old('back_half') }}" autofocus placeholder="">
                    @error('back_half')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><div class="col-4">
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Select the tags you want to add<small style="font-size: 16px"> (optional)</small></h3>
                    </div>
                    @can('view tags')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Total Urls </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Total Urls </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($tags as $key => $tag)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" id="checkbox{{$key+1}}" {{(!empty(old('tags')) && in_array($tag->id , old('tags')) || request()->query('tag_id') == $tag->id ? 'checked': false)}}>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{getLimitText($tag->title)}}</td>
                                    <td>
                                        <a href="{{route('admin.user.show', $tag->user->id)}}">{{$tag->user->name}}</a>
                                    </td>
                                    <td>{{$tag->created_at}}</td>
                                    <td>{{$tag->total_urls}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endcan
                    <x-cannot permission="view tags"/>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <a href="{{ route('admin.url.index') }}" class="btn btn-danger">Hủy</a>
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
        tr.selected a {
            color: #FFFFFF !important;
        }
        input[type="checkbox"] {
            transform: scale(1.4); /* Phóng to 2 lần kích thước */
        }
    </style>
@endsection
