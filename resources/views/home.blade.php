@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية || المستقبل على الويب</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="{{asset('js/home.js')}}"></script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-teal" >
        <a class="navbar-brand" href="#">إدارة مشروع</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="nav-item">
                        @csrf
                        <button type="button" class="nav-link" style="background: none; border: none; cursor: pointer;" onclick="confirmLogout(event)">
                            <i class="fas fa-sign-in-alt"></i> تسجيل الخروج
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="night-mode-toggle"><i class="fas fa-moon"></i> الوضع الليلي</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact-us-section"><i class="fas fa-phone-alt"></i> اتصل بنا</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Services-us-section"><i class="fas fa-cogs"></i> الخدمات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> الرئيسية</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container content" id="Menu" >
        <div class="text-right">
            <h1 class="mt-5">مرحبًا</h1>
            <p>نحن نطور <i>تطبيقً محاسب</i> لإدارة الأنشطة المالية في الشركات وتسهيل عمل موظفي الشركة.</p>
            <a href="{{ route('OurService') }}" class="btn btn-lg mt-3">البدء باستخدام تطبيق المحاسب مجانا</a>
        </div>
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="navbar-logo">
        </div>
    </div>

    <!-- Our Services -->
    <div id="Services-us-section" class="container mt-5">
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-right">الخدمات</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-project-diagram service-icon"></i>
                    <h3 class="service-title">إدارة المشاريع</h3>
                    <p class="service-description">المحاسب يضمن ان يدير مشروعك الصغير بشكل فعال.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-money-bill-alt service-icon"></i>
                    <h3 class="service-title">يحسب الارباح</h3>
                    <p class="service-description">المحاسب يعمل على تحديد نسبة ارباح مشروعك.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-truck service-icon"></i>
                    <h3 class="service-title">التواصل مع المورد</h3>
                    <p class="service-description">المحاسب يمكن من خلاله التواصل مع الموردين.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact us -->
    <div id="contact-us-section" class="container mt-5">
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-right">اتصل بنا</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input type="text" class="form-control" id="name" placeholder="أدخل الاسم" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">عنوان البريد الإلكتروني</label>
                                    <input type="email" class="form-control" id="email" placeholder="أدخل البريد الإلكتروني" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject">الموضوع</label>
                                    <select id="subject" name="subject" class="form-control" required>
                                        <option value="اختر واحد">اختر واحد</option>
                                        <option value="الخدمة العامة">الخدمة العامة</option>
                                        <option value="اقتراحات">اقتراحات</option>
                                        <option value="مراجعة">مراجعة</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">الرسالة</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required placeholder="الرسالة"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn pull-right" id="btnContactUs">إرسال الرسالة</button>
                            </div>
                        </div>
                    </form>
                    <div id="formFeedback" class="mt-3"></div>
                </div>
                <div class="col-md-4">
                    <legend><i class="fas fa-globe"></i> مكتبنا</legend>
                    <address>
                        <strong>Mouhasibe2024</strong><br>
                        <br>
                        <abbr title="هاتف">P:</abbr> (123) 456-7890
                    </address>
                    <address>
                        <strong>Email</strong><br>
                        <a href="mailto:#">Mouhasibe2024@gmail.com</a>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
   
    </script>
<style>
      .confirmation-dialog {
        width: 300px;
        height: 200px;
        color: #000;
        border: 1px solid  teal;
        padding: 20px;
        text-align: center;
      }
</style>
@endsection
