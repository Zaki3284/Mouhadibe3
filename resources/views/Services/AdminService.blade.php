<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une entreprise</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{ asset('css/CreateCompany.css') }}"> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&display=swap');

        body {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 0px 20px teal;
            max-width: 600px;
            width: 100%;
        }

        .container h1.section-title {
            text-align: center;
            margin-bottom: 20px;
            color: #FFC312;
            font-size: 28px;
        }

        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            width: 100%;
            text-align: center;
            position: relative;
        }

        .step:before {
            content: '';
            width: 100%;
            height: 2px;
            background-color: #ccc;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
        }

        .step:not(:first-child):before {
            width: calc(100% - 20px);
            left: 10px;
        }

        .step.active:before {
            background-color: teal;
        }

        .step .step-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ccc;
            display: inline-block;
            line-height: 30px;
            color: #fff;
            margin-bottom: 5px;
        }

        .step.active .step-icon {
            background-color: teal;
        }

        .step-label {
            display: block;
            margin-top: 5px;
            font-size: 12px;
            color: teal;
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        button[type="button"], button[type="submit"] {
            background-color: teal;
            color: #fff;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        button[type="button"]:hover, button[type="submit"]:hover {
            background-color: #006666;
        }

        .alert-success {
            color: green;
            margin-top: 20px;
            font-size: 16px;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            color: teal;
            text-decoration: none;
            font-size: 16px;
        }

        .back-button:hover {
            text-decoration: underline;
        }

        .logo img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
    </div>
    <div class="container">
        <h1 class="section-title">Créer une entreprise<i class="fas fa-building"></i></h1>
        <div class="stepper">
            <div class="step active" data-step="1">
                <div class="step-icon">1</div>
                <div class="step-label">Info Entreprise</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-icon">2</div>
                <div class="step-label">Info Comptable</div>
            </div>
            <div class="step" data-step="3">
                <div class="step-icon">3</div>
                <div class="step-label">Connexion</div>
            </div>
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <!-- Formulaire d'inscription -->
        <form id="comptable-form" action="{{ route('create.company') }}" method="POST">
            @csrf
            <div class="step-content active" data-step="1">
                <label for="company_name">Nom de l'entreprise <i class="fas fa-building"></i>:</label>
                <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                @error('company_name')
                    <div>{{ $message }}</div>
                @enderror

                <label for="company_address">Adresse de l'entreprise <i class="fas fa-map-marker-alt"></i>:</label>
                <input type="text" id="company_address" name="company_address" value="{{ old('company_address') }}" required>
                @error('company_address')
                    <div>{{ $message }}</div>
                @enderror

                <button type="button" onclick="nextStep(2)"><i class="fas fa-arrow-right"></i>Suivant</button>
            </div>
            <div class="step-content" data-step="2">
                <label for="fullname">Nom du comptable <i class="fas fa-user-tie"></i>:</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" required>
                @error('fullname')
                    <div>{{ $message }}</div>
                @enderror

                <label for="phone_number">Numéro de téléphone <i class="fas fa-phone"></i>:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <div>{{ $message }}</div>
                @enderror

                <button type="button" onclick="prevStep(1)"><i class="fas fa-arrow-left"></i>Précédent</button>
                <button type="button" onclick="nextStep(3)"><i class="fas fa-arrow-right"></i>Suivant</button>
            </div>
            <div class="step-content" data-step="3">
                <label for="email">Email <i class="fas fa-envelope"></i>:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div>{{ $message }}</div>
                @enderror

                <label for="password">Mot de passe <i class="fas fa-lock"></i>:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <div>{{ $message }}</div>
                @enderror

                <label for="password_confirmation">Confirmer le mot de passe <i class="fas fa-lock"></i>:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                <button type="button" onclick="prevStep(2)"><i class="fas fa-arrow-left"></i>Précédent</button>
                <button type="submit">Créer <i class="fas fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
    <a href="{{ route('home') }}" class="back-button"><i class="fas fa-home"></i> Retour à la page d'accueil</a>
    <script>
        function nextStep(step) {
            document.querySelectorAll('.step, .step-content').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelector('.step[data-step="' + step + '"]').classList.add('active');
            document.querySelector('.step-content[data-step="' + step + '"]').classList.add('active');
        }

        function prevStep(step) {
            document.querySelectorAll('.step, .step-content').forEach(el => {
                el.classList.remove('active');
            });
            document.querySelector('.step[data-step="' + step + '"]').classList.add('active');
            document.querySelector('.step-content[data-step="' + step + '"]').classList.add('active');
        }
    </script>
</body>
</html>
