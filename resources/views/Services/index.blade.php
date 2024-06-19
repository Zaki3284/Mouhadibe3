@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية ||</title>
    <link rel="icon" href="path/to/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/SerIndex.css') }}">
    <div class="container">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        <h1>هل أنت ؟</h1>
        <div class="user-types">
            <a href="{{ route('ServiceFournisseur') }}" class="user-type fournisseur">
                <i class="fas fa-truck icon"></i>
                <h2>مورد بضائع</h2>
                </a>
                <a href="{{ route('ServiceAdmin') }}" class="user-type admin">
                    <i class="fas fa-user-tie icon"></i>
                    <h2>مدير شركة</h2>
                    </a>
                    </div>
                <a href="{{ route('home') }}" style="color: #fff"   class="back-button">العودة إلى الصفحة الرئيسية</a>
                    </div>
                    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  {{-- <div><a href="{{ route('journals.index') }}">journal</a></div> --}}
    @endsection