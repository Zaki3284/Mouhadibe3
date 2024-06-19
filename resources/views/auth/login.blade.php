@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="{{ asset('images/logo.jpeg') }}" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus placeholder="اسم المستخدم">
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="كلمة المرور">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">تذكرني</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" class="btn login_btn">تسجيل الدخول</button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    ليس لديك حساب؟ <a href="{{ route('register') }}" class="ml-2">إنشاء حساب</a>
                </div>
                @if (Route::has('password.request'))
                    <div class="d-flex justify-content-center links">
                        <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
