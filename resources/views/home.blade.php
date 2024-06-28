@extends('layouts.app')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil || L'avenir sur le web</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="{{asset('js/home.js')}}"></script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-teal">
        <a class="navbar-brand" href="#">Gestion de Projet</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="direction: rtl">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="nav-item">
                        @csrf
                        <button type="button" class="nav-link" style="background: none; border: none; cursor: pointer;" onclick="confirmLogout(event)">
                            <i class="fas fa-sign-in-alt"></i> Déconnexion
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" id="night-mode-toggle"><i class="fas fa-moon"></i> Mode Nuit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact-us-section"><i class="fas fa-phone-alt"></i> Contactez-nous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Services-us-section"><i class="fas fa-cogs"></i> Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> Accueil</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container content" id="Menu" >
        <div class="text-left">
            <h1 class="mt-5 " >Bienvenue</h1>
            <p>Nous développons une <i>application de comptabilité</i> pour gérer les activités financières des entreprises et faciliter le travail des employés de l'entreprise.</p>
            <a href="{{ route('OurService') }}" class="btn btn-lg mt-3">Commencer à utiliser l'application de comptabilité gratuitement</a>
        </div>
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="navbar-logo">
        </div>
    </div>

    <!-- Nos services -->
    <div id="Services-us-section" class="container mt-5" >
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12" >
                        <h2 class="text-left">Services</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-project-diagram service-icon"></i>
                    <h3 class="service-title">Gestion de projets</h3>
                    <p class="service-description">L'application de comptabilité assure une gestion efficace de votre petit projet.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-money-bill-alt service-icon"></i>
                    <h3 class="service-title">Calcul des bénéfices</h3>
                    <p class="service-description">L'application de comptabilité permet de déterminer le pourcentage de bénéfice de votre projet.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-truck service-icon"></i>
                    <h3 class="service-title">Communication avec le fournisseur</h3>
                    <p class="service-description">L'application de comptabilité permet de communiquer avec les fournisseurs.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contactez-nous -->
    <div id="contact-us-section" class="container mt-5">
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-left">Contactez-nous</h2>
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
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name" placeholder="Entrez le nom" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email" placeholder="Entrez l'adresse e-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Sujet</label>
                                    <select id="subject" name="subject" class="form-control" required>
                                        <option value="Choisissez-en un">Choisissez-en un</option>
                                        <option value="Service général">Service général</option>
                                        <option value="Suggestions">Suggestions</option>
                                        <option value="Commentaires">Commentaires</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn pull-right" id="btnContactUs">Envoyer le message</button>
                            </div>
                        </div>
                    </form>
                    <div id="formFeedback" class="mt-3"></div>
                </div>
                <div class="col-md-4">
                    <legend><i class="fas fa-globe"></i> Notre bureau</legend>
                    <address>
                        <strong>Mouhasibe2024</strong><br>
                        <br>
                        <abbr title="Téléphone">P:</abbr> (123) 456-7890
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
        border: 1px solid teal;
        padding: 20px;
        text-align: center;
      }
</style>
@endsection
