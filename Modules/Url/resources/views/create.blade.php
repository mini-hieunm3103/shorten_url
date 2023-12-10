@extends('url::layouts.master')

@section('content')
    <div style="max-width: 758px; margin: auto">
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center" style="font-size: 18px">
                {{session('msg')}}
            </div>
        @endif
            @if($errors->any())
                <div class="alert-danger alert text-center" style="font-size: 18px">{{$errors->first()}}</div>
            @endif
    </div>

    <section id="urlbox" class="">
        <h1>Paste the URL to be shortened</h1>
        <form action="{{route('store')}}" method="post">
            @csrf
            <div id="formurl" class="mb-3 ">
                <input type="text" class="@error('long_url') is-invalid @enderror" name="long_url" placeholder="Enter the link here">

                <div id="formbutton">
                    <input type="submit" value="Shorten URL">
                </div>
            </div>
            @error('long_url')
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </form>
        <p class="boxtextcenter">ShortURL is a free tool to shorten URLs and generate short links<br>URL shortener allows to create a shortened link making it easy to share</p>
    </section>
@endsection
