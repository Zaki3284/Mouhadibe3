<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تم تسجيل المحاسب</title>
</head>
<body>
    <!-- Add your logo here -->
    <div style="text-align: center;">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width: 150px; height: auto;">
    </div>

    <h1>مرحبًا {{ $fullname }}،</h1>
    <p>تم تسجيلك كمحاسب في تطبيق المحاسب.</p>
    <p>يرجى تسجيل الدخول للمتابعة.</p>
    <p>يرجى تأكيد بريدك الإلكتروني من خلال النقر على الرابط التالي:</p>
    <p><a href="{{ $confirmationUrl }}">تأكيد البريد الإلكتروني</a></p>
</body>
</html>

