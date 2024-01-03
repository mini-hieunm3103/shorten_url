@extends('client.layouts.master')
@section('content')
    <div class="row">
        <div class="col-2"></div>

        <div class="col-9 mt-4 pl-4" style="border-left: 2px solid #c7c3c3">
            <div class="mb-4 pb-3 border-bottom">
                <h2 class="font-weight-bold mb-4 ml-4">Profile</h2>
                <div class="ml-5 mt-2 mb-5">
                    <h4 class="font-weight-bold mb-3 ml-1">Preferences</h4>
                    <form action="{{route('client.user.update', auth()->user()->id)}}" method="post" id="form-name">
                        @csrf
                        @method('PATCH')
                        <div class="setting_section mb-3 ml-2">
                            <div class="form-group">
                                <label for="">Display name</label>
                                <input class="form-control input-name @error('name') is-invalid @enderror" type="text" name="name" value="{{auth()->user()->name}}" id="">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                    <br>
                                    <span>{{ 'Your old name is: '.auth()->user()->name}}</span>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary submit-name" >Update display name</button>
                        </div>
                    </form>
                </div>
                <div class="ml-5 mt-2 " >
                    <form action="{{route('client.user.update', auth()->user()->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="setting_section mb-3 ml-2">
                            <div class="form-group">
                                <label for="">Email address</label>
                                <input class="form-control input-email @error('email') is-invalid @enderror" type="text" name="email" value="{{old('email')??auth()->user()->email}}" id="">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                    <br>
                                    <span>{{ 'Your old email is: '.auth()->user()->email}}</span>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary submit-email" >Update email address</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mb-4 pb-3 border-bottom">
                <h2 class="font-weight-bold mb-3 ml-4">Security</h2>
                <div class="ml-5 mt-2 mb-5">
                    <h4 class="font-weight-bold mb-3 ml-1">Change password</h4>
                    <form action="{{route('client.user.update', auth()->user()->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="confirm_pass" value="true">
                        <div class="setting_section mb-3 ml-2">
                            <div class="form-group">
                                <label for="">Current password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"  id="">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">New password</label>
                                <input class="form-control @error('new_password') is-invalid @enderror" type="password" name="new_password"  id="">
                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm new password</label>
                                <input class="form-control @error('new_password_confirmation') is-invalid @enderror" type="password" name="new_password_confirmation"  id="">
                                @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Change your password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mb-4 pb-3">
                <div class="ml-5 mt-2 mb-5">
                    <div class="setting_section mb-3 ml-2">
                        <a href="{{route('client.user.destroy', auth()->user()->id)}}" class="delete-action btn btn-danger font-weight-bold">Delete account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('client/parts/delete')
@endsection
@section('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            @if(session('showSweetAlert'))
                Swal.fire({
                    position: "top-end",
                    icon: "{{session('type')}}",
                    title: "{{session('msg')}}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
            var inputName = document.querySelector('.input-name');
            var submitNameBtn = document.querySelector('.submit-name')
            var inputEmail = document.querySelector('.input-email');
            var submitEmailBtn = document.querySelector('.submit-email')
            var deleteBtn = document.querySelector('.delete-action')
            const deleteForm = document.querySelector('#delete-form');

            deleteBtn.addEventListener('click', (deleteEvent) => {
                deleteEvent.preventDefault()
                Swal.fire({
                    title: "Are you sure?",
                    html: `To permanently delete your account,<br>enter: '<b id="nonClickableText">DELETE ACCOUNT</b>' below.`,
                    icon: "warning",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    inputPlaceholder: "Enter 'DELETE ACCOUNT'",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    showConfirmButton: true,
                    inputValidator: (value) => {
                        // Kiểm tra giá trị của input
                        if (value !== "DELETE ACCOUNT") {
                            return 'Please type the phrase exactly as it appears';
                        }
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteForm.action = deleteEvent.target.href
                        deleteForm.submit();
                    }
                });
            })


            if (inputName.value == '{{auth()->user()->name}}'){
                submitNameBtn.disabled = true
            }
            if (inputEmail.value == '{{auth()->user()->email}}'){
                submitEmailBtn.disabled = true
            }
            inputName.addEventListener('keyup' , (e) => {
                if (inputName.value != '{{auth()->user()->name}}'){
                    submitNameBtn.removeAttribute('disabled')
                }else  {
                    submitNameBtn.disabled = true
                }
            })
            inputEmail.addEventListener('keyup' , (e) => {
                if (inputEmail.value != '{{auth()->user()->email}}'){
                    submitEmailBtn.removeAttribute('disabled')
                }else  {
                    submitEmailBtn.disabled = true
                }
            })
        })
    </script>
@endsection
@section('stylesheet')
    <style>
        #nonClickableText {
            user-select: none; /* Ngăn chặn việc chọn văn bản */
            pointer-events: none; /* Ngăn chặn sự kiện click */
        }
    </style>
@endsection
