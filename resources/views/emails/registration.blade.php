<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد البريد الإلكتروني</title>
</head>
<body>
    <p>مرحبًا {{ $details['username'] }},</p>

    @if (isset($details['confirmation_url']))
    <p>
        نتمنى لك حظا سعيدا لقد تم تسجيلك في تطبيقنا المحاسب
    </p>
        <p>. يرجى النقر على الرابط التالي لتأكيد عنوان بريدك الإلكتروني:</p>
        <p><a href="{{ $details['confirmation_url'] }}">{{ $details['confirmation_url'] }}</a></p>
    @elseif (isset($details['confirmation_code']))
        <p>شكرًا لتسجيلك. يرجى استخدام الرمز التالي لتأكيد رقم هاتفك:</p>
        <p>{{ $details['confirmation_code'] }}</p>
    @endif

    <p>إذا لم تكن طلبت ذلك، يمكنك تجاهل هذه الرسالة بأمان.</p>
    <p>مع التحية،<br> فريق التطبيق الخاص بك</p>
</body>
</html>
