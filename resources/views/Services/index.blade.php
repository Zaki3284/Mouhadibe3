@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container text-center">
    <div class="logo my-4">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
    </div>
    <h1 class="section-title">Êtes-vous ?</h1>
    <div class="user-types d-flex justify-content-around my-4">
        <a href="{{ route('ServiceFournisseur') }}" class="user-type publier-produit btn btn-outline-primary d-flex flex-column align-items-center p-4">
            <i class="fas fa-truck icon fa-3x mb-2"></i>
            <h2>Publier un produit</h2>
        </a>
        <a href="{{ route('ServiceAdmin') }}" class="user-type create-enterprise btn btn-outline-secondary d-flex flex-column align-items-center p-4">
            <i class="fas fa-user-tie icon fa-3x mb-2"></i>
            <h2>Créer une entreprise</h2>
        </a>
    </div>
    <a href="{{ route('home') }}" class="back-button btn btn-info mt-4"><i class="fas fa-home"></i> Retour à la page d'accueil</a>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/SerIndex.css') }}">
<style>
    body {
        /* font-family: 'Crimson Text', serif; */
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
        box-shadow: 0px 0px 20px teal;
        max-width: 800px;
        width: 100%;
    }

    .logo img {
        width: 100px;
        height: 100px;
    }

    .section-title {
        color: teal;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .user-types .user-type {
        display: block;
        width: 150px;
        padding: 20px;
        border: 2px solid #ccc;
        border-radius: 10px;
        text-align: center;
        text-decoration: none;
        color: teal;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .user-types .user-type:hover {
        background-color: teal;
        color: #fff;
        border-color: teal;
    }

    .user-type h2 {
        font-size: 18px;
        margin-top: 10px;
    }

    .back-button {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }

    .back-button:hover {
        text-decoration: underline;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
