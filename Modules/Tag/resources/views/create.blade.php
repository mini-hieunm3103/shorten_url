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
                        <h3 class="card-title">Select the url you want to add</h3>
                    </div>
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
                                <tr id="row{{$key+1}}">
                                    <td>
                                        <input type="checkbox" name="urls[]" value="{{$url->id}}" id="checkbox{{$key+1}}">
                                    </td>
                                    <td>{{getLimitText($url->title)}}</td>
                                    <td>
                                        <a class="limited-url" href="{{$url->long_url}}">{{getLimitUrl($url->long_url)}}</a>
                                    </td>
                                    <td>
                                        <a class="limited-url" href="{{request()->root().'/'.$url->back_half}}">{{$url->back_half}}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.user-urls.show', $url->user->id)}}">{{$url->user->name}}</a>
                                    </td>
                                    <td>{{$url->created_at}}</td>
                                    <td>{{$url->expired_at}}</td>
                                    <td>{{$url->clicks}}</td>
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
