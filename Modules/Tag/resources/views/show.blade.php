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
        <div class="col-6">
            <div class="mb-3">
                <label for="">Title</label>
                <input readonly id="title" name="title" type="text" class="form-control"
                       value="{{ $tag->title }}" autofocus placeholder="">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">User</label>
                <select disabled name="user_id" id=""
                        class="form-control form-select {{ $errors->has('user_id') ? 'is-invalid' : '' }}">
                    <option value="0">{{$tag->user->name}}</option>
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
                    <h3 class="card-title">Danh Sách Url(s) Rút Gọn Của Tag:</h3>
                </div>
                @can('view urls')
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
                            <th>Long URL</th>
                            <th>Back-Half</th>
                            <th>Người Đăng</th>
                            <th>Thời Gian</th>
                            <th>Hết Hạn</th>
                            <th width="5%">Archived</th>
                            <th width="5%">Clicks</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Title</th>
                            <th>Long URL</th>
                            <th>Back-Half</th>
                            <th>Người Đăng</th>
                            <th>Thời Gian</th>
                            <th>Hết Hạn</th>
                            <th width="5%">Archived</th>
                            <th width="5%">Clicks</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($tagUrls as $key => $url)
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
        <div class="mb-3 ml-2">
            <x-admin-btn module="tag" type="warning" action="edit" :data="$tag->id"  />
            <x-admin-btn module="url" type="primary" action="create" :data="['tag_id' => $tag->id]" />
            <a href="{{route('admin.tag.index')}}" class="btn btn-secondary">Quay về</a>
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

