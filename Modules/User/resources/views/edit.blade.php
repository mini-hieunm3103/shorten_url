@extends('admin.layouts.master')
@section('content')
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <form action="{{route('admin.user.update', compact('user'))}}" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input id="name" name="name" type="text" class="form-control
                    @error('name') is-invalid @enderror"
                           value="{{old('name') ?? $user->name }}" autofocus placeholder="Họ Và Tên...">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Email</label>
                    <input id="email" name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror" value=" {{old('email') ?? $user->email }}"
                           autofocus placeholder="Địa Chỉ Email...">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Nhóm</label>
                    <select name="group_id" class="form-control @error('group_id') is-invalid @enderror">
                        <option value="0">Chọn Nhóm</option>
                        <option value="1">Super Administrator</option>
                        <option value="2">Administrator</option>
                        <option value="3">Users</option>
                    </select>
                    @error('group_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mật khẩu</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Mật Khẩu...">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Lưu lại</button>
                <a href="{{ url()->previous() }}" class="btn btn-primary">Quay Lại</a>
            </div>
        </div>
        @method('PUT')
    </form>
@endsection
