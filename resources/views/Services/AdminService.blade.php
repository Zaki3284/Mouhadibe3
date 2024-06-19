<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء شركة جديدة</title>
    <script src="{{ asset('js/Company.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/Company.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div>
        <img src="{{ asset('images/logo.jpeg') }}" alt="شعار الشركة">
    </div>
    <div class="container">
        <div class="stepper">
            <div class="step active" data-step="1">
                <div class="step-icon"><i class="fas fa-building"></i></div>
                <p>معلومات الشركة</p>
            </div>
            <div class="step" data-step="2">
                <div class="step-icon"><i class="fas fa-balance-scale"></i></div>
                <p>الأصول المجمدة</p>
            </div>
            <div class="step" data-step="3">
                <div class="step-icon"><i class="fas fa-money-bill"></i></div>
                <p>الأصول المتداولة</p>
            </div>
            <div class="step" data-step="4">
                <div class="step-icon"><i class="fas fa-balance-scale"></i></div>
                <p>أسهم الشركة</p>
            </div>
            <div class="step" data-step="5">
                <div class="step-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <p>الديون</p>
            </div>
        </div>

        <form id="stepperForm" action="{{ route('create_Company') }}" method="POST">
            <input type="hidden" name="admin_user_id" value="{{ auth()->user()->id }}">
            @csrf
            <!-- Step 1: Company Information -->
            <div class="form-step form-step-active" data-step="1">
                <label>اسم الشركة*</label>
                <input type="text" name="company_name" required>
                <label>عنوان الشركة*</label>
                <input type="text" name="company_address" required>
                <label>رقم التسجيل*</label>
                <input type="text" name="company_registration" required>
                <button type="button" class="btn-next">التالي</button>
            </div>

            <!-- Step 2: Actifs -->
            <div class="form-step" data-step="2">
                <label>إجمالي الأصول الثابتة*</label>
                <input type="number" name="total_immobilisation" required>
                <label>التفاصيل</label>
                <textarea name="details_immobilisation"></textarea>
                <button type="button" class="btn-prev">السابق</button>
                <button type="button" class="btn-next">التالي</button>
            </div>

            <!-- Step 3: Actifs Circulants -->
            <div class="form-step" data-step="3">
                <label>إجمالي الأصول المتداولة*</label>
                <input type="number" name="total_actif_a_court_terme" required>
                <label>التفاصيل</label>
                <textarea name="details_total_actif_a_court_terme"></textarea>
                <button type="button" class="btn-prev">السابق</button>
                <button type="button" class="btn-next">التالي</button>
            </div>

            <!-- Step 4: Capitaux Propre -->
            <div class="form-step" data-step="4">
                <label>رأس المال*</label>
                <input type="number" name="total_du_capital" required>
                <label>التفاصيل</label>
                <textarea name="details_du_capital"></textarea>
                <button type="button" class="btn-prev">السابق</button>
                <button type="button" class="btn-next">التالي</button>
            </div>

            <!-- Step 5: Passifs Circulants -->
            <div class="form-step" data-step="5">
                <label>إجمالي الخصوم المتداولة*</label>
                <input type="number" name="total_du_passif_court_terme" required>
                <label>التفاصيل</label>
                <textarea name="details_du_passif_court_terme"></textarea>
                <button type="button" class="btn-prev">السابق</button>
                <button type="submit">إرسال</button>
            </div>
        </form>
    </div>
</div>
<a href="{{ route('home') }}" style="color: #fff"   class="back-button">العودة إلى الصفحة الرئيسية</a>
    </div>
</body>

</html>
