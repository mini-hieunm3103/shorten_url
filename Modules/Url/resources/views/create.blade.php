@extends('admin.layouts.master')
@section('content')
    @if($errors->any())
        <div class="alert-danger alert text-center font-weight-bold"
             style="
                color:#c4434f;background-color:#f8d7da;border-color:#f5c6cb
             "
        >Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="{{route('admin.url.store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="">Destination</label>
                    <input id="long_url" name="long_url" type="text" class="form-control
                    @error('long_url') is-invalid @enderror"
                           value="{{ old('long_url') }}" autofocus placeholder="https://example.com/my-long-url">
                    @error('long_url')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Title <small style="font-size: 16px"> (optional)</small></label>
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
            <div class="col-4">
                <div class="mb-3">
                    <label for="">Custom back-half <small style="font-size: 16px"> (optional)</small></label>
                    <input id="back_half" name="back_half" type="text" class="form-control
                    @error('back_half') is-invalid @enderror"
                           value="{{ old('back_half') }}" autofocus placeholder="">
                    @error('back_half')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div><div class="col-4">
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
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.url.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
    </form>
@endsection
