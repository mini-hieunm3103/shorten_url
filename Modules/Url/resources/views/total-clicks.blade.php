@extends('url::layouts.master')

@section('content')
    @include('url::parts.title', compact('title', 'paragraph'))
    <section id="content">
        <div class="squareboxurl"><a href="{{$url->short_url}}" target="_blank">{{$url->short_url}}</a></div>
        <br class="h20">
        <div class="squarebox mb-4"><div class="squareboxtext">{{$url->clicks}}</div></div>
        <p>
            <a href="{{route('counter')}}" class="mb-2 colorbuttonsmall">Track clicks from another short URL</a><br>
            <a href="{{route('create')}}" class="colorbuttonsmall">Shorten another URL</a>
        </p>
    </section>
@endsection
