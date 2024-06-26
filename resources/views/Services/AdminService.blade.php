<!-- resources/views/auth/register.blade.php -->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء شركة</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/CreateCompany.css') }}">
</head>
<body>
    <div>
        <img src="{{ asset('images/logo.jpeg') }}" alt="">
    </div>
    <div class="container">
        <h1 class="section-title">إنشاء شركة</h1>

        {{-- <div class="stepper">
            <div class="step active">
                <div class="step-icon"><i class="fas fa-building"></i></div>
                <p>إنشاء الشركة</p>
            </div>
        </div> --}}

        <!-- نموذج التسجيل المدمج -->
        <div id="registration-form" class="form-step">
            <form id="comptable-form" action="{{ route('create.company') }}" method="POST">
                @csrf

                <label for="company_name">اسم الشركة:</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                @error('company_name')
                    <div>{{ $message }}</div>
                @enderror

                <label for="company_address">عنوان الشركة:</label>
                <input type="text" id="company_address" name="company_address" value="{{ old('company_address') }}" required>
                @error('company_address')
                    <div>{{ $message }}</div>
                @enderror

                <label for="fullname">اسم المحاسب:</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                @error('fullname')
                    <div>{{ $message }}</div>
                @enderror
                <label for="phone_number">رقم الهاتف:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div>{{ $message }}</div>
                @enderror
                
                <label for="email">البريد الإلكتروني:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror

                <label for="password">كلمة المرور:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror

                <label for="password_confirmation">تأكيد كلمة المرور:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                
                <button type="submit">إنشاء</button>
            </form>
        </div>
    </div>
    
    <a href="{{ route('home') }}" style="color: #fff"   class="back-button">العودة إلى الصفحة الرئيسية</a>
   
</body>
</html>
