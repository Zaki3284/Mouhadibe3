@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8">
    <title>تسجيل</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>

<div class="container h-100">
    <div class="d-flex justify-content-center h-100" style="margin-top: 50px;">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <a href="{{ route('home') }}"><img src="{{ asset('images/logo.jpeg') }}" class="brand_logo" alt="Logo"></a>
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control input_user @error('username') is-invalid @enderror" value="{{ old('username') }}" required placeholder="اسم المستخدم" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="البريد الإلكتروني">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control input_pass @error('password') is-invalid @enderror" required placeholder="كلمة المرور">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control input_pass" required placeholder="تأكيد كلمة المرور">
                    </div>
                    <div class="d-flex justify-content-center mt-3 register_container">
                        <button type="submit" class="btn register_btn">تسجيل</button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="ml-2">تسجيل الدخول</a>
                </div>
                <div class="d-flex justify-content-center links">
                    <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
