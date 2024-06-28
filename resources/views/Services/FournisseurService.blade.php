<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <script src="{{ asset('js/Product.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/Product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div>
        <img src="{{ asset('images/logo.jpeg') }}" alt="">
    </div>
    <div class="container">

        <!-- Structure HTML pour le formulaire et le stepper -->
        <form id="stepperForm" action="{{ route('Add_Product') }}" method="POST">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @csrf

            <div class="form-step form-step-active" data-step="1">
                <label>Nom du produit</label>
                <input type="text" required name="product_name" value="{{ old('product_name') }}">

                <label>Type de produit</label>
                <input type="text" name="product_type" value="{{ old('product_type') }}">

                <button type="button" class="btn-next">Suivant</button>
            </div>

            <div class="form-step" data-step="2">
                <p>Merci.</p>
                <button type="button" class="btn-prev">Précédent</button>
                <button type="submit">Envoyer</button>
            </div>
        </form>    

    </div>
    <a href="{{ route('home') }}" style="color: #fff" class="back-button">Retour à la page d'accueil</a>
</body>
</html>
