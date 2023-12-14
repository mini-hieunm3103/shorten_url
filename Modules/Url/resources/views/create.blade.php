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
            <div class="col-12">
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
                    <label for="">Custom back-half <small style="font-size: 16px"> (optional)</small></label>
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
                                <option value="{{$user->id}}" @if(old('user_id') == $user->id) {{'selected'}} @endif>{{$user->name}}</option>
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
                                <tr>
                                    <td>
                                        <input type="checkbox" name="tags[]" value="{{$tag->id}}" id="checkbox{{$key+1}}" {{(in_array($tag->id , old('tags')) ? 'checked': false)}}>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{getLimitText($tag->title)}}</td>
                                    <td>{{getLimitText($tag->description)}}</td>
                                    <td>
                                        <a href="{{route('admin.user-urls.show', $tag->user->id)}}">{{$tag->user->name}}</a>
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
                <a href="{{ url()->previous() }}" class="btn btn-primary">Quay Lại</a>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    {{--    DataTable Checkbox--}}
    <script src="{{asset('admin/plugins/datatables-select/js/dataTables.select.js')}}"></script>
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
                        'checkboxes': {
                            'selectRow': true
                        },
                        "targets": 0
                    }
                ],
                "select":{
                    "style" : "multi",
                    "selector": 'td:first-child input'
                },
                "order": [[5, 'asc']]
            });
        });
    </script>

@endsection
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-select/css/select.bootstrap4.min.css')}}">
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
