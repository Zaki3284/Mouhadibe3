<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
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
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        .container h1.section-title {
            text-align: center;
            margin-bottom: 20px;
            color: teal;
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

        input[type="text"] {
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
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <h1 class="section-title">Ajouter un produit</h1>
        <div class="stepper">
            <div class="step active" data-step="1">
                <div class="step-icon">1</div>
                <div class="step-label">Info Produit</div>
            </div>
            <div class="step" data-step="2">
                <div class="step-icon">2</div>
                <div class="step-label">Confirmation</div>
            </div>
        </div>
        <!-- Formulaire d'inscription -->
        <form id="stepperForm" action="{{ route('Add_Product') }}" method="POST">
            @csrf
            <div class="step-content active" data-step="1">
                <label>Nom du produit <i class="fas fa-box"></i></label>
                <input type="text" required name="product_name" value="{{ old('product_name') }}">

                <label>Type de produit <i class="fas fa-tags"></i></label>
                <input type="text" name="product_type" value="{{ old('product_type') }}">

                <button type="button" class="btn-next">Suivant <i class="fas fa-arrow-right"></i></button>
            </div>

            <div class="step-content" data-step="2">
                <p>Merci.</p>
                <button type="button" class="btn-prev"><i class="fas fa-arrow-left"></i> Précédent</button>
                <button type="submit">Envoyer <i class="fas fa-paper-plane"></i></button>
            </div>
        </form>
    </div>
    <a href="{{ route('home') }}" class="back-button"><i class="fas fa-home"></i> Retour à la page d'accueil</a>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const steps = document.querySelectorAll('.step');
            const nextButtons = document.querySelectorAll('.btn-next');
            const prevButtons = document.querySelectorAll('.btn-prev');
            const stepContents = document.querySelectorAll('.step-content');

            nextButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const activeStep = document.querySelector('.step.active');
                    const activeContent = document.querySelector('.step-content.active');
                    const nextStep = activeStep.nextElementSibling;
                    const nextContent = activeContent.nextElementSibling;

                    if (nextStep && nextContent) {
                        activeStep.classList.remove('active');
                        activeContent.classList.remove('active');
                        nextStep.classList.add('active');
                        nextContent.classList.add('active');
                    }
                });
            });

            prevButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const activeStep = document.querySelector('.step.active');
                    const activeContent = document.querySelector('.step-content.active');
                    const prevStep = activeStep.previousElementSibling;
                    const prevContent = activeContent.previousElementSibling;

                    if (prevStep && prevContent) {
                        activeStep.classList.remove('active');
                        activeContent.classList.remove('active');
                        prevStep.classList.add('active');
                        prevContent.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
