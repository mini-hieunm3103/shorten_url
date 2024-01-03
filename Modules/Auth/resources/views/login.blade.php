@extends('admin.layouts.app')


@section('content')
    <div class="card card-outline card-primary full-height">
        <div class="card-header text-center">
            <a href="" class="h1">Shorten <b>URL</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg h4">Welcome back!</p>

            <form action="{{ route('login') }}" method="post" id="login-form">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" id="email"
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
                    <input type="password" name="password" id="password"
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

            <!-- /.social-auth-links -->
            <p class="mb-1">
                Forgotten Password?
                <a href="{{route('password.request')}}">Click Here!</a>
            </p>
            <p class="mb-0">
                <a href="{{route('register')}}" class="text-center">Register a new membership</a>
            </p>
            <hr>
            <div class="social-auth-links text-center mt-2 mb-3">
                <a href="#" class="btn btn-block btn-danger" id="admin-btn">
                    <i class="fas fa-user-cog mr-2"></i> Click Here To Login As Administrator
                </a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('login-form')
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const adminBtn = document.getElementById('admin-btn')
            adminBtn.addEventListener('click', (e) => {
                emailInput.value = 'admin@gmail.com'
                passwordInput.value = '12345678'
                loginForm.submit()
            })
        })
    </script>
@endsection
