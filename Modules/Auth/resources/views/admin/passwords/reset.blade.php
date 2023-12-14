@extends('admin.layouts.app')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="" class="h1">Shorten <b>URL</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            <form action="{{ route('password.update') }}" method="post">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-3">
                    <input readonly type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                Remember Password & Don't Want To Change Password?
                <a href="{{route('login')}}">Clicks Here To Login!</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection

