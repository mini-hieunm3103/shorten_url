@extends('admin.layouts.app')


@section('content')
    <div class="card card-outline card-primary full-height">
        <div class="card-header text-center">
            <a href="" class="h1">Shorten <b>URL</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Welcome back! Administrator</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12" style="margin: 4px 4px 4px auto">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>

            <p class="mb-1">
                Forgotten Password?
                <a href="{{route('password.request')}}">Click Here!</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

