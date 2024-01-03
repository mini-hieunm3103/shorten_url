@extends('client.layouts.master')
@section('content')
<div class="row">
     <div class="col-2"></div>
    <div class="col-8">
        <div class="col-sm-6 mt-5 mb-3 pl-0">
            <h1 class="m-0 font-weight-bold" style="font-size: 36px; color: #3b3b3d">Create New</h1>
        </div>
        <form action="{{route('client.links.store')}}" method="post" class="mt-3">
            @csrf
            <div class="row">
                <div class="mb-3 col-12">
                    <label for="">Destination</label>
                    <input value="{{ old('long_url') }}" name="long_url" type="text" class="form-control @error('long_url') is-invalid @enderror" placeholder="https://example.com/my-long-url">
                    @error('long_url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12">
                    <div class="mb-3 shorted_url">
                        <label for="">Title <small style="font-size: 16px"> (optional)</small></label>
                        <input name="title" type="text" class="form-control" >
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3 shorted_url" >
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
                    <div class="mb-3 shorted_url" >
                        <label for="">Custom back-half <small style="font-size: 16px"> (optional) (a-z, A-Z, 0-9)</small></label>
                        <input value="{{ old('back_half') }}" name="back_half" type="text" class="form-control @error('back_half') is-invalid @enderror" placeholder="yourBackHalf">
                        @error('back_half')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="archived" value="1">
                <div class="col-12 right">
                    <button type="submit" class="btn btn-primary mr-2">Create</button>
                    <a href="{{ route('client.links.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
