@extends('admin.layouts.master')
@section('content')
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <form action="{{route('admin.url.update', compact('url'))}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Destination</label>
                    <input id="long_url" name="long_url" type="text" class="form-control
                    @error('long_url') is-invalid @enderror"
                           value="{{ old('long_url') ?? $url->long_url }}" autofocus placeholder="https://example.com/my-long-url">
                    @error('long_url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Title <small style="font-size: 16px"> (optional)</small></label>
                    <input id="title" name="title" type="text" class="form-control
                    @error('title') is-invalid @enderror"
                           value="{{ old('title') ?? $url->title }}" autofocus placeholder="">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Custom back-half <small style="font-size: 16px"> (optional)</small></label>
                    <input id="back_half" name="back_half" type="text" class="form-control
                    @error('back_half') is-invalid @enderror"
                           value="{{ old('back_half') ?? $url->back_half }}" autofocus placeholder="">
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
                                <option value="{{$user->id}}" @if(old('user_id') == $user->id || $url->user_id == $user->id) {{'selected'}} @endif>{{$user->name}}</option>
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>Description</th>
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
                                <th>Description</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Total Urls </th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($tags as $key => $tag)
                                <tr >
                                    <td>
                                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" {{(in_array($tag->id , old('tags') ?? $tagIds) ? 'checked': false)}}>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{getLimitText($tag->title)}}</td>
                                    <td>{{getLimitText($tag->description)}}</td>
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
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <a href="{{ route('admin.url.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @method('PUT')
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
