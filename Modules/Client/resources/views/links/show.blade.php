@extends('client.layouts.master')
@section('content')
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 ">
            <a class="btn mt-5 mb-4 btn-link" href="{{route('client.links.index')}}">
                <i class="fa fa-chevron-left mr-2"></i>
                <span style="font-size: 20px">Back to list</span>
            </a>
            <div class="link-detail card card-primary mb-4" data-id="{{$url->id}}">
                <div class="card-body row d-flex flex-wrap">
                    <div class="col-11">
                        <div class="col-6 mb-1 pb-3 shorted_url" style="border-bottom: 2px solid #f1e8e8">
                            <div class="m-0 shorted_url">
                                <h1 class="card-title font-weight-bold mb-2" style="font-size: 36px; color: rgba(0,0,0,0.7)">{{$url->title}}</h1>
                            </div>
                            <p class="card-text mb-2">
                                <a target="_blank" href="{{request()->root().'/'.$url->back_half}}" class="short-link card-link text-bold">{{$domain.'/'.$url->back_half}}</a>
                                <input type="hidden" name="" >
                            </p>
                            <p class="card-text mb-2 shorted_url">
                                <a title = "{{$url->long_url}}" target="_blank" href="{{$url->long_url}}"  style="color: #273144; text-decoration: underline #273144">{{($url->long_url)}}</a>
                            </p>
                            <div class="mt-4 mb-0 d-flex flex-wrap  " style="color:rgba(0,0,0,.65)!important">
                                <div>
                                    <i class="fas fa-chart-bar"></i>
                                    <span class="ml-1 mr-3 total-clicks">{{$url->clicks}}</span>
                                </div>
                                <div class="mb-1">
                                    <i class="far fa-calendar"></i>
                                    <span class="ml-1 mr-3">{{date('d-m-Y H:i:s', strtotime($url->created_at))}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pt-1 pr-1 pb-1 pl-0 mb-2 d-inline-flex flex-wrap mt-2" >
                            <a class="mb-1  mr-3 p-1 d-flex max-w-56 btnCopy" style="padding-left: 12px!important;align-items: center;background-color: #e8ebf2; height: fit-content; border: 1px solid #e8ebf2; border-radius: 8px; color: rgba(0,0,0,.7)">
                                <i class="far fa-copy"></i>
                                <span class="ml-1 mr-1 p-1 copy-text" >Copy</span>
                            </a>
                            <a title="Edit This Link" href="#" class="mb-1 mr-2 edit-btn" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:5px 8px 5px 10px " data-toggle="modal" data-target="#editModalCenter">
                                <i class="far fa-edit"></i>
                                <span class="ml-1 media-8">Edit Link</span>
                            </a>
                            <a title="You Can't Delete This Link In The Editor Page"
                               class="mb-1 mr-2 delete-action disabled"
                               style="cursor: not-allowed; color: #d0cccc; align-items: center; border: 2px solid rgb(208,204,204); border-radius: 8px; padding:6px 10px 4px 10px ">
                                <i class="fas fa-trash"></i>
                                <span class="ml-1 media-8">Delete Link</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #e8ebf2">

                        @if(count($url->tags) == 0)
                            <i class="fas fa-tag"></i>
                            <span class="ml-1 mr-1 font-weight-bold">No tags</span>
                        @elseif(count($url->tags) == 1)
                            <i class="fas fa-tag"></i>
                            <span class="ml-1 mr-1 p-1 font-weight-bold">{{count($url->tags)}} tag:</span>
                        @else
                            <i class="fas fa-tags"></i>
                            <span class="ml-1 mr-1 mb-1 p-1 font-weight-bold" >{{count($url->tags)}} tags:</span>
                            @foreach($url->tags as $tag)
                            @endforeach
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th>Title Tag</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Title Tag</th>
                                <th>Created At</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($url->tags as $key => $tag)
                                <tr >
                                    <td>{{$key+1}}</td>
                                    <td>{{getLimitText($tag->title)}}</td>
                                    <td>{{$tag->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client/parts/edit')
@endsection
@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function (){
            $('#dataTable').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "order": [[0, 'asc']]
            });
            var editBtn = document.querySelector('.edit-btn')
            var urlId = {!! $url->id !!};
            var copyBtn = document.querySelector('.btnCopy')

            var shortUrl = document.querySelector('.short-link')
            var totalClicks = document.querySelector('.total-clicks')
            // Xử lý edit link
            var editForm = document.querySelector(".edit-form")
            var titleModal = document.querySelector("input[name='title']")
            var backHalfModal = document.querySelector("input[name='back_half']")
            var editTagsSelect = document.querySelector('.edit-tags-field')

            shortUrl.addEventListener('click', () => {
                getUrlInfoById(urlId)
                    .then((urlData) => {
                        totalClicks.innerText = urlData.clicks + 1
                    })
            })
            function getUrlInfoById(urlId){
                var urlData = '{!! route('client.links.data') !!}';
                return fetch(urlData + '/' + urlId)
                    .then(function (response) {
                        return response.json();
                    });
            }
            editBtn.addEventListener('click', () => {
                getUrlInfoById(urlId)
                    .then((urlData) => {
                        console.log(urlData)
                        // clear data
                        editTagsSelect.innerHTML = '';
                        $(".edit-tags-field").chosen("destroy");
                        editForm.action = '{!! route('client.links.index') !!}'; // reset action form

                        titleModal.value = urlData.title;
                        backHalfModal.value = urlData.back_half;
                        editForm.action = editForm.action + '/' + urlId;

                        var optionFields = '';
                        urlData.tags.forEach((e) => {
                            optionFields += '<option selected value ="' + e.id + '" >'+ e.title +'</option>'
                        })
                        urlData.other_tags.forEach((e)=>{
                            optionFields += '<option value ="' + e.id + '" >'+ e.title +'</option>'
                        })
                        editTagsSelect.innerHTML = optionFields;
                        // urlData.other_tags
                        // lỗi mỗi làn click vào edit btn thì sẽ lưu dữ liệu của select btn làm thêm 1 input ở dưới
                        $(".edit-tags-field").chosen({width: "100%"})
                    })
            })
            copyBtn.addEventListener('click', (copyEvent) => {
                var input = document.createElement("input");
                input.type = "text";
                input.value = shortUrl.href;
                document.body.appendChild(input);
                // Chọn nội dung của input
                input.select();
                input.setSelectionRange(0, 99999); // Đối với các trình duyệt di động

                // Sao chép nội dung vào clipboard
                document.execCommand("copy");

                // Xóa phần tử input
                document.body.removeChild(input);
                copyBtn.querySelector(".copy-text").innerText = 'Copied'
            })
        })

    </script>
@endsection
