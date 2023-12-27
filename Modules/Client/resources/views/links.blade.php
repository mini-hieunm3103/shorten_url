@extends('client.layouts.master')
@section('content')
    <div class="row">
        <div class="col-2 "></div>
        <div class="col-8">
            <div class="col-sm-6 mt-5 mb-3 pl-0">
                <h1 class="m-0 font-weight-bold" style="font-size: 36px; color: #3b3b3d">Links:</h1>
            </div>
            <div class="col-12 pl-0 pb-3 d-flex flex-wrap" style="border-bottom: 2px solid #f1e8e8">
                <div class="d-flex mr-3 mb-2 max-w-56 p-1 pl-2 pr-2" style="border: 1px solid #cbcfd3; border-radius: 5px; background-color: #fffffc" id="reportrange">
                    <span class="material-symbols-outlined pt-1 pb-1 mr-2">calendar_today</span>
                    <span class="" style="align-items: center; margin: auto; font-size: large" id="insertDate">Filter by created date</span>
                </div>
                <div class="d-flex mr-3 mb-2 max-w-56 p-1 pl-2 pr-2" style="border: 1px solid #cbcfd3; border-radius: 5px; background-color: #fffffc">
                    <span class="material-symbols-outlined pt-1 pb-1 mr-2">tune</span>
                    <span class="" style="align-items: center; margin: auto; font-size: large" >Add Filters</span>
                </div>
            </div>
            @foreach($urls as $key=> $url)
                <div class="card card-primary mb-4 {{($key == 0) ? 'mt-4' : false}} checkbox-container">
                    <div class="card-body row d-flex flex-wrap">
                        <div class="mb-2 mr-3 ml-3">
                            <input type="checkbox" name="" id="linkCheckbox">
                        </div>
                        <div class="col-11">
                            <div class="col-12 mb-1 pb-3 shorted_url" style="border-bottom: 2px solid #f1e8e8">
                                <div class="m-0 shorted_url">
                                    <h5 class="card-title font-weight-bold mb-2" style="font-size: 24px">{{$url->title}}</h5>
                                </div>
                                <p class="card-text mb-2">
                                    <a target="_blank" href="{{request()->root().'/'.$url->back_half}}" class="card-link text-bold">{{$domain.'/'.$url->back_half}}</a>
                                </p>
                                <p class="card-text mb-2 shorted_url">
                                    <a title = "{{$url->long_url}}" target="_blank" href="{{$url->long_url}}"  style="color: #273144; text-decoration: underline #273144">{{($url->long_url)}}</a>
                                </p>
                                <div class="mt-4 mb-0 d-flex flex-wrap  " style="color:rgba(0,0,0,.65)!important">
                                    <div>
                                        <i class="fas fa-chart-bar"></i>
                                        <span class="ml-1 mr-3">{{$url->clicks}}</span>
                                    </div>
                                    <div class="mb-1">
                                        <i class="far fa-calendar"></i>
                                        <span class="ml-1 mr-3">{{date('d-m-Y', strtotime($url->created_at))}}</span>
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
                                <div class="mb-1  mr-3 p-1 d-flex max-w-56" style="padding-left: 12px!important;align-items: center;background-color: #e8ebf2; height: fit-content; border: 1px solid #e8ebf2; border-radius: 8px">
                                    <i class="far fa-copy"></i>
                                    <span class="ml-1 mr-1 p-1" >Copy</span>
                                </div>
                                <a title="Edit This Link" data-id="{{$url->id}}" href="#" class="mb-1 mr-2 edit-btn" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:5px 8px 5px 10px " data-toggle="modal" data-target="#exampleModalCenter">
                                    <i class="far fa-edit"></i>
                                    <span class="ml-1 media-8">Edit Link</span>
                                </a>
                                <a title="Delete This Link" href="" class="mb-1 mr-2" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:6px 10px 4px 10px ">
                                    <i class="fas fa-trash"></i>
                                    <span class="ml-1 media-8">Delete Link</span>
                                </a>
                                <a title="View Link Detail" href="" class="mb-1 mr-2" style="color: #838282 ;align-items: center; border: 2px solid #838282; border-radius: 8px; padding:6px 10px 4px 10px ">
                                    <i class="fas fa-link"></i>
                                    <span class="ml-1 media-8">View Link Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card -->
            @endforeach
        </div>
        <div class="col-12 text-center mt-3 mb-4">
            ------------    You've reached the end of your links   ------------
        </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="{{route('admin.url.store')}}" method="post" class="mt-3">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="m-0 font-weight-bold" style=" color: #3b3b3d">Edit Link</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 pb-3" style="border-bottom: 2px solid #f1e8e8;">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3 shorted_url">
                                            <label for="">Title <small style="font-size: 16px">
                                                    (optional)</small></label>
                                            <input value="" name="title" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3 shorted_url">
                                            <label for="">Domain</label>
                                            <select name="domain" disabled class="form-control form-select">
                                                <option selected value="{{$domain}}">{{$domain}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-center">
                                        <div class="mb-3 font-weight-bold" style="; margin-top: 35px;">
                                            <span style="align-items: center; font-size: 20px">/</span>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3 shorted_url">
                                            <label for="">Back-half </label>
                                            <input value="" name="back_half" type="text"
                                                   class="form-control @error('back_half') is-invalid @enderror"
                                                   placeholder="yourBackHalf">
                                            @error('back_half')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-6 mt-3 mb-4 pl-0">
                                    <h4 class="m-0 font-weight-bold" style=" color: #3b3b3d">Option details</h4>
                                </div>
                                <div class=" p-0">
                                    <div class="mb-3" style="width: 100%; background-color: #fffffc">
                                        <div class="multiSelect">
                                            <select name="tags[]" multiple class="multiSelect_field" data-placeholder="Add Tags">
                                                @foreach($tags as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
                                                <g stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </g>
                                            </symbol>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        var start = moment();
        var end = moment();
        function cb(start, end) {
            $('#reportrange #insertDate').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            $('#created_after').val(start.format('MM.DD.YYYY')); // dùng explode để lấy ra giá trị
            $('#created_before').val(end.format('MM.DD.YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        // Multiple select
        jQuery(function() {
            jQuery('.multiSelect').each(function(e) {
                var self = jQuery(this);
                var field = self.find('.multiSelect_field');
                var fieldOption = field.find('option');
                var placeholder = field.attr('data-placeholder');

                field.hide().after(`<div class="multiSelect_dropdown"></div>
                        <span class="multiSelect_placeholder">` + placeholder + `</span>
                        <ul class="multiSelect_list"></ul>
                        <span class="multiSelect_arrow"></span>`);

                fieldOption.each(function(e) {
                    jQuery('.multiSelect_list').append(`<li class="multiSelect_option" data-value="`+jQuery(this).val()+`">
                                            <a class="multiSelect_text">`+jQuery(this).text()+`</a>
                                          </li>`);
                });

                var dropdown = self.find('.multiSelect_dropdown');
                var list = self.find('.multiSelect_list');
                var option = self.find('.multiSelect_option');
                var optionText = self.find('.multiSelect_text');

                dropdown.attr('data-multiple', 'true');
                list.css('top', dropdown.height() + 5);

                option.click(function(e) {
                    var self = jQuery(this);
                    e.stopPropagation();
                    self.addClass('-selected');
                    field.find('option:contains(' + self.children().text() + ')').prop('selected', true);
                    dropdown.append(function(e) {
                        return jQuery('<span class="multiSelect_choice">'+ self.children().text() +'<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>').click(function(e) {
                            var self = jQuery(this);
                            e.stopPropagation();
                            self.remove();
                            list.find('.multiSelect_option:contains(' + self.text() + ')').removeClass('-selected');
                            list.css('top', dropdown.height() + 5).find('.multiSelect_noselections').remove();
                            field.find('option:contains(' + self.text() + ')').prop('selected', false);
                            if (dropdown.children(':visible').length === 0) {
                                dropdown.removeClass('-hasValue');
                            }
                        });
                    }).addClass('-hasValue');
                    list.css('top', dropdown.height() + 5);
                    if (!option.not('.-selected').length) {
                        list.append('<h5 class="multiSelect_noselections">That\'s all tags you ever created</h5>');
                    }
                });

                dropdown.click(function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    dropdown.toggleClass('-open');
                    list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
                });

                jQuery(document).on('click touch', function(e) {
                    if (dropdown.hasClass('-open')) {
                        dropdown.toggleClass('-open');
                        list.removeClass('-open');
                    }
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function (){
            var editBtns = document.querySelectorAll('.edit-btn')
            var titleModal = document.querySelector("input[name='title']")
            var backHalfModal = document.querySelector("input[name='back_half']")
            editBtns.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    var urlId = btn.getAttribute('data-id')
                })
            })
        })
        function getUrlInfoById(){
            return fetch('{{route('admin.url.data')}}')
                .then(function (response) {
                    return response.json();
                });
        }
        console.log(getUrlInfoById())

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
        @media screen and (max-width: 800px){
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
    </style>
@endsection
