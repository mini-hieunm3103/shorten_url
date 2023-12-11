@extends('url::layouts.master')
@push('css')
    <style>
        #btnCopy {
            height: 56px;
            padding: 10px 16px;
            font: bold 17px lato,arial;
            color: #fff;
            background-color: #2c87c5;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            white-space: nowrap;
            border: 0;
            border-radius: 3px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -1px;
            -webkit-appearance: button;
            margin: 0;
        }
        #btnCopy.clicked {
            background-color: #198754!important;
        }
    </style>
@endpush
@section('content')
    @include('url::parts.title', compact('title', 'paragraph'))
    <div style="max-width: 758px; margin: auto">
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center" style="font-size: 18px">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <section id="urlbox">
        <br><br>
        <div id="formurl" class="mw450 mb-3">
            <input id="shortenurl" type="text" value="{{$url->short_url}}" onclick="" readonly>
            <div id="formbutton" >
                <button id="btnCopy" >Copy URL</button>
            </div>
        </div>
        <div id="formurl" class="mw450dblock">
            <p class="boxtextleft">
                <a href="{{$url->long_url}}" target="_blank">{{$url->long_url}}</a><br><br>

                    <a href="{{route('create')}}" class="colorbuttonsmall mb-0">Shorten another URL</a><br><br>
                    <a href="{{route('total-click', ['id'=>$url->id])}}" class="colorbuttonsmall mb-2">Total of clicks of your short URL</a><br>

                <span class="textmedium">* Short URLs that do not have at least one click per month are disabled</span>
            </p>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        isClick = false;
        let textBox = document.getElementById("shortenurl");
        function copyToClipboard(textBox) {
            textBox.select();
            document.execCommand("copy")
            isClick = true;
            return isClick;
        }
        $('#btnCopy').click(function() {
            // Thay đổi giá trị của isClick từ false thành true
            isClick = copyToClipboard(textBox);

            // Thay đổi nội dung của button thành "Copied URL"
            if (isClick){
                $(this).text('Copied URL');
                $(this).addClass('clicked');
            }
        });
    </script>
@endsection
