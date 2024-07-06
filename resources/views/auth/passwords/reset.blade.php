@extends('layouts.app')
<link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/ForgetPass.css') }}">
@section('content')
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
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Adresse email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Mot de passe">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password" placeholder="Confirmer le mot de passe">
                    </div>

                    <div class="d-flex justify-content-center mt-3 forget_container">
                        <button type="submit" class="btn forget_btn">Réinitialiser le mot de passe</button>
                    </div>
                </form>
            </div>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    <a href="{{ route('login') }}">Connexion</a>
                </div>
                <div class="d-flex justify-content-center links">
                    Vous n'avez pas de compte? <a href="{{ route('register') }}" class="ml-2">Créer un compte</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
