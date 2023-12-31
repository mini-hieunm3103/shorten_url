@extends('client.layouts.master')
@section('content')
    <div class="row">
        <div class="col-2 "></div>
        <div class="col-8">
            <div class="col-sm-6 mt-5 mb-3 pl-0">
                <h1 class="m-0 font-weight-bold" style="font-size: 36px; color: #3b3b3d">Links:</h1>
            </div>
            <div class="col-12 pl-0 pb-3 d-flex flex-wrap justify-content-between" style="border-bottom: 2px solid #f1e8e8;  flex-direction: row;">
                <div class="d-flex">
                    <a class="d-flex mr-3 mb-2 max-w-56 p-1 pl-3 pr-3 open-filter-btn" id=""
                       style="
                            cursor: pointer;
                            {{($filterApplied) ? 'color: rgba(20,108,196);' : 'color: rgba(0,0,0,.8);'}}
                            {{($filterApplied) ? 'border: 2px solid #146cc4;' : 'border: 2px solid #abaeb2;'}}
                            border-radius: 5px;
                            background-color: #fffffc;
                            "
                       data-toggle="modal" data-target="#filterModal">
                        <span class="material-symbols-outlined pt-1 pb-1 mr-2">tune</span>
                        <span class="" style="align-items: center; margin: auto; font-size: large" >{{($filterApplied) ? $filterApplied.' filtered applied' : 'Add filters'}}</span>
                    </a>
                    @if($filterApplied)
                        <div class="font-weight-bold d-flex align-items-center mr-2" style="font-size: larger">
                            <span class="mb-2">
                                 Filtered to {{($urls->count() <= 1) ? $urls->count().' link' : $urls->count().' links'}}
                            </span>
                        </div>
                        <a style="font-size: larger" class="mb-2 btn btn-link font-weight-normal d-flex align-items-center" href="{{route('client.links.index')}}">
                            <i class="fas fa-times-circle mr-1"></i>
                             Clear all
                        </a>
                    @endif
                </div>
                <div class="d-flex">
                    <button class="d-flex mr-2 mb-2 max-w-56 p-1 pl-3 pr-3 align-items-center btn btn-secondary disabled" id="createTagsBtn"
                            title="Please select more than one link to create tag"
                    >
                        <i class="fa fa-tag pt-1 mr-2"></i>
                        <span class="" style="align-items: center; margin: auto; font-size: large" >Create tag</span>
                    </button>
                    <button class="d-flex  mb-2 max-w-56 p-1 pl-3 pr-3 align-items-center btn btn-secondary {{request()->input('archived') == 'off'? 'active-links' : 'hidden-links'}} disabled" id="archived-handle"
                            title="Please select more than one link to handel" data-archived="{{request()->input('archived') == 'off'? 'on' : 'off'}}"
                    >
                        <i class="fa fa-eye{{request()->input('archived') == 'off'? false : '-slash'}} pt-1 mr-2"></i>
                        <span class="" style="align-items: center; margin: auto; font-size: large" >{{request()->input('archived') == 'off'? 'Active' : 'Hide'}}</span>
                    </button>
                </div>
            </div>
{{--            Select and show active or hidden link | check Tồn tại $urls--}}
            <div class="col-12 d-flex flex-wrap mt-3 ">
                <div class="col-5 mb-0 d-flex align-items-center" style="">
                    <div style="margin-left: 21px;" class="mr-2 @if(!empty($urls)) d-none @endif">
                        <input type="checkbox" style="" name="" id="checkboxAll">
                        <span class = "ml-2" style="font-size: large"> <span class="count-select">0</span> selected</span>
                    </div>
                </div>
                <div class="col-7 d-flex justify-content-end pr-0 ">
                    <div class="btn-group" >
                        <button type="button" class="btn btn-default font-weight-bold">Show: <span class="show-archived">{{empty(request()->input('archived')) || request()->input('archived') == 'on' ? 'Active' : 'Hidden'}}</span></button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">

                            <button  class="archived-on-btn dropdown-item mb-1 d-flex justify-content-between align-items-center" data-archived="on">
                                Active
                                <i class="fa fa-check archived-check-icon"></i>
                            </button>
                            <button class="archived-off-btn dropdown-item  d-flex justify-content-between align-items-center" data-archived="off">
                                Hidden
                                <i class="fa fa-check archived-check-icon"></i>
                            </button>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Expired link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                @foreach($urls as $key=> $url)
                    <div class="link-detail card card-primary mb-4" data-id="{{$url->id}}">
                        <div class="card-body row d-flex flex-wrap">
                            <div class="mb-2 mr-3 ml-3">
                                <input type="checkbox" name=""  class="linkCheckbox">
                            </div>
                            <div class="col-11">
                                <div class="col-12 mb-1 pb-3 shorted_url" style="border-bottom: 2px solid #f1e8e8">
                                    <div class="m-0 shorted_url">
                                        <h5 class="card-title font-weight-bold mb-2" style="font-size: 24px">{{$url->title}}</h5>
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
                                        <div class="shorted_url">
                                            @if(count($url->tags) == 0)
                                                <i class="fas fa-tag"></i>
                                                <span class="ml-1 mr-1">No tags</span>
                                            @elseif(count($url->tags) == 1)
                                                <i class="fas fa-tag"></i>
                                                <span class="ml-1 mr-1 p-1" style="background-color: #e8ebf2">{{$url->tags[0]->title}}</span>
                                            @else
                                                <i class="fas fa-tags"></i>
                                                @foreach($url->tags as $tag)
                                                    <span class="ml-1 mr-1 mb-1 p-1" style="background-color: #e8ebf2">{{$tag->title}}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 pt-1 pr-1 pb-1 pl-0 mb-2 d-inline-flex flex-wrap mt-2" >
                                    <a class="mb-1  mr-3 p-1 d-flex max-w-56 btnCopy" style="padding-left: 12px!important;align-items: center;background-color: #e8ebf2; height: fit-content; border: 1px solid #e8ebf2; border-radius: 8px; color: rgba(0,0,0,.7)">
                                        <i class="far fa-copy"></i>
                                        <span class="ml-1 mr-1 p-1 copy-text" >Copy</span>
                                    </a>
                                    <a title="Edit This Link" href="#" class="mb-1 mr-2 edit-btn" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:5px 8px 5px 10px " data-toggle="modal" data-target="#editModalCenter">
                                        <i class="far fa-edit"></i>
                                        <span class="ml-1 media-8">Edit Link</span>
                                    </a>
                                    <a title="Delete This Link" href="{{route('admin.url.destroy', compact('url'))}}"
                                       class="mb-1 mr-2 delete-action"
                                       style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:6px 10px 4px 10px ">
                                        <i class="fas fa-trash"></i>
                                        <span class="ml-1 media-8">Delete Link</span>
                                    </a>
                                    <a title="View Link Detail" href="{{route('client.links.show', $url->back_half)}}" class="mb-1 mr-2" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:6px 10px 4px 10px ">
                                        <i class="fas fa-link"></i>
                                        <span class="ml-1 media-8">View Link Detail</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card -->
                @endforeach
            </div>

        </div>
        <div class="col-12 text-center mt-3 mb-4">
            ------------    You've reached the end of your links   ------------
        </div>
    </div>
    <!-- Edit Modal-->
    @include('client/parts/edit')
    @include('client/parts/delete')
{{--   Filter Modal--}}
    <div class="modal fade " id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document" style="width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="m-0 font-weight-bold" style=" color: #3b3b3d">Filter</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('client.links.index')}}" id="filterForm" method="get" class="mt-3">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 multiSelect form-group" >
                                <label for="">Tags</label>
                                <select name="tags[]" multiple class="filter-tags-field form-control" data-placeholder="Select Tags" style="width: 100%">
                                    @foreach($allTags as $tag)
                                        <option value="{{$tag->title}}">{{$tag->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mt-3 form-group">
                                <label>Link type:</label>
                                <select name="custom_link" class="custom-link-select form-control font-weight-bold">
                                    <option value="all" {{empty(request()->get('custom_link'))}}>All</option>
                                    <option value="on" {{ !empty(request()->get('custom_link')) && request()->get('custom_link')== "on" ? 'selected' : false}}>Link with custom back-halve</option>
                                    <option value="off" {{ !empty(request()->get('custom_link')) && request()->get('custom_link')== "off" ? 'selected' : false}}>Link without custom back-halve</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3 form-group">
                                <label>Filter By Created Date</label>
                                <div class="d-flex mr-3 mb-2 max-w-56 p-1 pl-3 pr-3 col-12" style="cursor: pointer; color: rgba(0,0,0,.8); border: 1px solid #cbcfd3; border-radius: 5px; background-color: #fffffc" id="reportrange">
                                    <span class="material-symbols-outlined pt-1 pb-1 mr-2">calendar_today</span>
                                    <span class="" style="align-items: center; margin: auto; font-size: large" id="insertDate">Click to filter</span>
                                </div>
                                <input type="hidden" id="created_after" name="created_after" value="">
                                <input type="hidden" id="created_before" name="created_before" value="">
                                <input type="hidden" id="archived" name="archived" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="reset-filter-btn btn btn-light d-flex align-items-center justify-content-center pt-0 pb-0">
                            <span aria-hidden="true" class="mr-1" style="font-size: x-large">&times; </span>
                            <span>Clear all filter</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{{--    Create Tag Modal--}}
    <div class="modal fade" id="createTagModal" tabindex="-1" role="dialog" aria-labelledby="createTagModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="m-0 font-weight-bold" style=" color: #3b3b3d">Filter</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.tag.store')}}" method="post" class="mt-3">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label for="">Title</label>
                                <input name="title" type="text" class="form-control" placeholder="Example:  Laravel Shorten URL">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="d-none">
                        @foreach($urls as $url)
                            <input type="checkbox" name="urls[]" value="{{$url->id}}" id="">
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--    Active list link form--}}
    <div style="display: none">
        <form action="{{route('admin.url.active')}}" method="POST" id="archived-links-form">
            @csrf
            @foreach($urls as $url)
                <input type="checkbox" name="urls[]" value="{{$url->id}}" id="">
            @endforeach
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        // Gửi dâta url vào edit form

        document.addEventListener('DOMContentLoaded', function (){
            // lấy ra tất cả thẻ link
            const linkList = document.querySelectorAll('.link-detail')
            // lấy ra form delete
            const deleteForm = document.querySelector('#delete-form');
            // Xử lý checkbox
            var spanCheckboxCount = document.querySelector('.count-select')
            let checkedCount = 0;
            var checkboxAll = document.querySelector('#checkboxAll')

            // Xử lý copy handle
            var copyTextList = document.querySelectorAll('.copy-text')
            // Xử lý edit link
            var editForm = document.querySelector(".edit-form")
            var titleModal = document.querySelector("input[name='title']")
            var backHalfModal = document.querySelector("input[name='back_half']")
            var editTagsSelect = document.querySelector('.edit-tags-field')

            var archiveHandleBtn = document.querySelector('#archived-handle')
            var archiveLinksForm = document.querySelector('#archived-links-form')
            // reset lại checkcount khi có checkbox đã check
            checkboxAll.addEventListener('click', (e) => {
                if(checkboxAll.checked){
                    checkedCount = 0
                }
            })

            var isArchived = {!! empty(request()->input('archived')) || request()->input('archived') == 'on' ? 'true' : 'false' !!};
            $('.archived-on-btn').toggleClass('active', isArchived);
            $('.archived-off-btn').toggleClass('active', !isArchived);
            if (isArchived) {
                $('.archived-off-btn .archived-check-icon').remove();
                $('.archived-off-btn').click(function (event) {
                    event.preventDefault();
                });
                $('.archived-on-btn').click(function () {
                    $('#filterForm input[name="archived"]').val($(this).attr('data-archived'));
                    $('#filterForm').submit();
                });
            } else {
                $('.archived-on-btn .archived-check-icon').remove();
            }
            $('.archived-on-btn, .archived-off-btn').click(function () {
                $('#filterForm input[name="archived"]').val($(this).attr('data-archived'));
                filterForm();
                $('#filterForm').submit();
            });
            // Filter Modal
            $('.open-filter-btn').click(filterForm)

            // Archived Handle
            archiveHandleBtn.addEventListener('click', (e)=> {
                if (archiveHandleBtn.getAttribute('data-archived') == "on"){
                    // on => active (hidden links)
                    archiveLinksForm.action = '{{route('admin.url.active')}}'
                } else{
                    archiveLinksForm.action = '{{route('admin.url.hidden')}}'
                    // off => hidden (active links)
                }
                archiveLinksForm.submit()
            })

            $('.reset-filter-btn').click(function (){
                $(".filter-tags-field").chosen("destroy");
                $(".filter-tags-field").prop('selectedIndex', -1)
                $(".custom-link-select").prop('selectedIndex', 0);
                cb(start, end, true)
                $(".filter-tags-field").chosen({ width: "100%" });
                $('#reportrange').daterangepicker({
                    startDate: start,
                    autoApply: true,
                    showDropdowns: true,
                    alwaysShowCalendars: true,
                    endDate: end,
                    maxDate: moment(),
                }, cb);
            })
            // when submit
            $('#filterForm').submit((e)=>{
                if ($('.custom-link-select').val() === 'all'){
                    $('.custom-link-select').removeAttr('name')
                }
                if ($('#created_after').val() === ''){
                    $('#created_after').removeAttr('name')
                }
                if ($('#created_before').val() === ''){
                    $('#created_before').removeAttr('name')
                }
                if ($('#archived').val() === '' || $('#archived').val() === 'on'){
                    $('#archived').removeAttr('name')
                }
                return true
            })
            linkList.forEach((e, i) => {
                var urlId = e.getAttribute('data-id')
                var deleteBtn = e.querySelector('.delete-action')
                var copyBtn = e.querySelector('.btnCopy')
                var shortUrl = e.querySelector('.short-link')
                var totalClicks = e.querySelector('.total-clicks')
                var checkboxLink = e.querySelector('.linkCheckbox')
                var editBtn = e.querySelector('.edit-btn')
                shortUrl.addEventListener('click', () => {
                    getUrlInfoById(urlId)
                        .then((urlData) => {
                            totalClicks.innerText = urlData.clicks + 1
                        })
                })
                editBtn.addEventListener('click', () => {
                    getUrlInfoById(urlId)
                        .then((urlData) => {
                            // clear data
                            editTagsSelect.innerHTML = '';
                            $(".edit-tags-field").chosen("destroy");
                            editForm.action = '{!! route('admin.url.index') !!}'; // reset action form

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
                deleteBtn.addEventListener('click', (deleteEvent) => {
                    deleteEvent.preventDefault()
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Nếu Xóa Bạn Không Thể Khôi Phục",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteForm.action = deleteEvent.target.href
                            deleteForm.submit();
                        }
                    });
                })

                copyBtn.addEventListener('click', (copyEvent) => {
                    copyTextList.forEach((e) =>{
                        e.innerText  = 'Copy'
                    })
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
                // Attach a change event to the checkbox
                checkboxLink.addEventListener('change', () => {
                    if (checkboxLink.checked){
                        e.classList.add('check-solid')
                        checkedCount +=1
                        $('input[name="urls[]"][value="'+urlId+'"]').each( function () {
                            $(this).prop("checked", true);
                        })
                        toggleBtn(checkedCount)
                    } else {
                        e.classList.remove('check-solid')
                        checkedCount -=1
                        $('input[name="urls[]"][value="'+urlId+'"]').each( function () {
                            $(this).prop("checked", false);
                        })
                        toggleBtn(checkedCount)
                    }
                    if (checkedCount === linkList.length){
                        checkboxAll.indeterminate = false
                        checkboxAll.checked = true
                    } else if (checkedCount <= linkList.length && checkedCount > 0) {
                        checkboxAll.checked = false
                        checkboxAll.indeterminate = true
                    } else {
                        checkboxAll.checked = false
                        checkboxAll.indeterminate = false
                    }
                    spanCheckboxCount.innerText = checkedCount
                })

                checkboxAll.addEventListener('click', ()=> {
                    if (checkboxAll.checked) {
                        e.classList.add('check-solid')
                        checkedCount +=1
                        $('input[name="urls[]"][value="'+urlId+'"]').each( function () {
                            $(this).prop("checked", true);
                        })
                        checkboxLink.checked = true
                        toggleBtn(checkedCount)
                    }
                    else {
                        e.classList.remove('check-solid')
                        checkedCount = 0
                        checkboxLink.checked = false

                        $('input[name="urls[]"][value="'+urlId+'"]').each( function () {
                            $(this).prop("checked", false);
                        })
                        toggleBtn(checkedCount)
                    }
                    spanCheckboxCount.innerText = checkedCount
                })
            })
        })
        function getUrlInfoById(urlId){
            var urlData = '{!! route('admin.url.data') !!}';
            return fetch(urlData + '/' + urlId)
                .then(function (response) {
                    return response.json();
                });
        }
        function toggleBtn(checkedCount){
            var creatTagBtn = document.querySelector('#createTagsBtn')
            var archiveHandleBtn = document.querySelector('#archived-handle')
            if (checkedCount>0){
                // data-toggle="modal" data-target="#createTagModal"
                creatTagBtn.classList.remove('disabled')
                creatTagBtn.setAttribute("data-toggle", "modal")
                creatTagBtn.setAttribute("data-target", "#createTagModal")

                archiveHandleBtn.classList.remove('disabled')
            } else {
                creatTagBtn.classList.add('disabled')
                creatTagBtn.removeAttribute("data-toggle")
                creatTagBtn.removeAttribute("data-target")

                archiveHandleBtn.classList.add('disabled')
            }
        }
        function filterForm(){
            var start = moment();
            var end = moment();
            $(".filter-tags-field").chosen("destroy");
            @if(!empty($tagsFilterArr))
                tagsArr = []
            @foreach($tagsFilterArr as $tag)
            tagsArr.push('{!! $tag->title !!}');
            @endforeach
            $(".filter-tags-field").val(tagsArr)
            @endif

            var defautSelect = 0
            @if(request()->get('custom_link') == "on")
                defautSelect = 1
            @elseif(request()->get('custom_link') == "off")
                defautSelect = 2
            @endif
            $(".custom-link-select").prop('selectedIndex', defautSelect);

            @if(!empty(request()->get('created_after')) && !empty(request()->get('created_before')))
                start = moment.unix({!! request()->input('created_after') !!});
            end =moment.unix({!! request()->input('created_before') !!});
            cb(start, end)
            @else
            cb(start, end, true)
            @endif
            $(".filter-tags-field").chosen({ width: "100%" });
            $('#reportrange').daterangepicker({
                startDate: start,
                autoApply: true,
                showDropdowns: true,
                alwaysShowCalendars: true,
                endDate: end,
                maxDate: moment(),
            }, cb);
        }
        function cb(start, end, clear) {
            if(clear){
                $('#reportrange #insertDate').html('Click to filter');
                $('#created_after').val('') ; // dùng explode để lấy ra giá trị
                $('#created_before').val('');
            } else{
                $('#reportrange #insertDate').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
                $('#created_after').val(start.unix()); // dùng explode để lấy ra giá trị
                $('#created_before').val(end.unix());
            }
        }
    </script>
@endsection
@section('stylesheet')
    <style>
        @media screen and (max-width: 560px) {
            .max-w-56{
                width: 100%;
                margin-right: 0!important;
                margin-bottom: 10px!important;
                display: flex;
                justify-content: center;
            }
            .max-w{
                width: 100%;
                margin-right: 0!important;
            }
        }
        @media screen and (max-width: 950px) {
            .media-8{
                display: none;
            }
        }
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
        /* ngay cả khi click vào icon hoặc span thì vẫn thực hiện hành động của thẻ a */
        .delete-action i, .delete-action span {
            pointer-events: none;
        }
        input[type="checkbox"]{
            transform: scale(1.1);
        }
        input:indeterminate {
            background-color: #0a66c2;
        }
        .dropdown-item.active,.dropdown-item:active{
            color:var(--bs-dropdown-link-active-color);
            text-decoration:none;
            background-color: #d9dee3 !important;
        }
    </style>
@endsection
