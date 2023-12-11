@extends('url::layouts.master')
@push('css')
    <style>
        #btn-counter{
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
    </style>
@endpush
@section('content')
    @include('url::parts.title', compact('title', 'paragraph'))
    <div style="max-width: 758px; margin: auto">
        @if($errors->any())
            <div class="alert-danger alert text-center" style="font-size: 18px">{{$errors->first()}}</div>
        @endif
    </div>
    <section id="urlbox">
        <br><br>
        <form action="{{route('id-counter')}}" method="post" class="mb-3">
            @csrf
            <div id="formurl">
                <input type="text" name="shortened" placeholder="Enter here your shortened URL" >
                <div id="formbutton">
                    <button type="submit" id="btn-counter">Track Clicks</button>
                </div>
            </div>
        </form>
        <p class="p050">Example: shorturl.at/AbCdE</p>
    </section>
@endsection
