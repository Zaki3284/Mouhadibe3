{{-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil || L'avenir sur le web</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&display=swap');

        body {
            /* font-family: Arial, Helvetica, sans-serif; */
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .bg-teal {
            background-color: teal !important;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            margin-bottom: 20px;
            height: 80px;
            color: #f8f9fa;
        }

        .content {
            margin-top: 100px;
            text-align: right;
            padding: 20px;
            direction: rtl;
            display: flex;
        }

        .jumbotron-sm {
            padding-top: 24px;
            padding-bottom: 24px;
        }

        .service-card {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            background-color: teal;
            padding: 20px;
            color: white;
        }

        .service-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .service-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .service-description {
            font-size: 16px;
        }

        #formFeedback {
            color: teal;
            font-size: 18px;
            font-weight: bold;
            display: none;
        }

        body.night-mode {
    background-color: #333;
    color: #fff;
}

        .btn {
            background-color: teal;
            color: #fff;
        }

        i {
            color: #FFC312;
        }

        .logo img {
            margin-top: 90px;
            width: 150px;
            height: 150px;
            margin-right: 50px;
            border: 5px solid #FFC312;
            border-radius: 20%;
            overflow: hidden;
        }

        .confirmation-dialog {
            background-color: white;
            border: 2px solid teal;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            width: 300px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .confirmation-dialog div {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .confirmation-dialog .btn {
            background-color: teal;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            font-size: 16px;
        }

        .confirmation-dialog .btn-confirm,
        .confirmation-dialog .btn-cancel {
            transition: background-color 0.3s ease;
        }

        .confirmation-dialog .btn-confirm:hover,
        .confirmation-dialog .btn-cancel:hover {
            background-color: #FFC312;
        }

        .professors-section {
            padding: 40px 0;
            text-align: center;
        }

        .professor-card {
            border: 1px solid teal;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .professor-card img {
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .professor-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .professor-card p {
            font-size: 16px;
            color: #333;
        }

        /* alert css */
        .alert {
    margin-top: 20px; /* Adjust spacing as needed */
    position: relative;
}

.alert .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.75rem 1.25rem;
}

    </style>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-check-circle"></i> Succès!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    

    <nav class="navbar navbar-expand-lg navbar-dark bg-teal">
        <a class="navbar-brand" href="#">EL Mouhasib</a>
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

    <div class="container content" id="Menu">
        <div class="text-left"> 
            <h1 class="mt-5">Bienvenue</h1>
            <p>Nous sommes ravis de vous accueillir sur notre site web. Nous sommes une équipe de développeurs passionnés qui aiment créer des expériences web exceptionnelles</p>
            <a href="{{ route('OurService') }}" class="btn btn-lg mt-3">Commencer à utiliser EL Mouhasib </a>
        </div>
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="navbar-logo">
        </div>
    </div>


    <!-- Nos services -->
    <div id="Services-us-section" class="container mt-5">
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-left">Services</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-book service-icon"></i>
                    <h3 class="service-title">Enregistrer Journal</h3>
                    <p class="service-description">L'application permet l'enregistrement des opérations journalières dans le journal comptable.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-balance-scale service-icon"></i>
                    <h3 class="service-title">Balance</h3>
                    <p class="service-description">Affiche l'état de la balance des comptes pour un suivi précis des finances.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-book-open service-icon"></i>
                    <h3 class="service-title">Grand Livre</h3>
                    <p class="service-description">Regroupe tous les comptes pour un suivi détaillé des transactions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-chart-line service-icon"></i>
                    <h3 class="service-title">Bilan</h3>
                    <p class="service-description">Présente la situation financière de l'entreprise à un moment donné.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-file-alt service-icon"></i>
                    <h3 class="service-title">Plan Comptable</h3>
                    <p class="service-description">Propose un plan comptable détaillé pour une organisation optimale des comptes.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card text-center">
                    <i class="fas fa-chart-pie service-icon"></i>
                    <h3 class="service-title">Rapports</h3>
                    <p class="service-description">Génère des rapports financiers pour les administrateurs et les comptables.</p>
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
                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'adresse e-mail" required>
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

     <!-- jQuery and Bootstrap JS -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
   

        // Add logout confirmation dialog
        function confirmLogout(event) {
            event.preventDefault();
            const confirmationDialog = document.createElement('div');
            confirmationDialog.className = 'confirmation-dialog';
            confirmationDialog.innerHTML = `
                <div>Êtes-vous sûr de vouloir vous déconnecter ?</div>
                <button class="btn btn-confirm" onclick="document.getElementById('logout-form').submit();">Oui</button>
                <button class="btn btn-cancel" onclick="this.parentElement.remove();">Non</button>
            `;
            document.body.appendChild(confirmationDialog);
        }
    </script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle night mode
        $('#night-mode-checkbox').change(function() {
            $('body').toggleClass('night-mode');
        });
    });
</script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil || L'avenir sur le web</title>
    <link rel="icon" href="{{ asset('images/logo.jpeg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital@1&display=swap');

        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: 'Crimson Text', serif; /* Example font family */
        }

        .bg-teal {
            background-color: teal !important;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            margin-bottom: 20px;
            height: 80px;
            color: #f8f9fa;
        }

        .content {
            margin-top: 80px;
            text-align: left;
            padding: 20px;
            /* direction: rtl; */
            display: flex;
            justify-content: space-between; /* Improved alignment */
            align-items: center; /* Center vertically */
        }

        .logo img {
            width: 150px;
            height: 150px;
            border: 5px solid #FFC312;
            border-radius: 20%;
            overflow: hidden;
        }

        .confirmation-dialog {
            background-color: white;
            border: 2px solid teal;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2000;
            width: 300px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .confirmation-dialog div {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .confirmation-dialog .btn {
            background-color: teal;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            font-size: 16px;
        }

        .confirmation-dialog .btn-confirm,
        .confirmation-dialog .btn-cancel {
            transition: background-color 0.3s ease;
        }

        .confirmation-dialog .btn-confirm:hover,
        .confirmation-dialog .btn-cancel:hover {
            background-color: #FFC312;
        }

        .professors-section {
            padding: 40px 0;
            text-align: center;
        }

        .professor-card {
            border: 1px solid teal;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .professor-card img {
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .professor-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .professor-card p {
            font-size: 16px;
            color: #333;
        }

        /* alert css */
        .alert {
    margin-top: 20px; /* Adjust spacing as needed */
    position: relative;
    color: #FFC312;
}

.alert .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.75rem 1.25rem;
}

    </style>
</head>
<body>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><i class="fas fa-check-circle"></i> Succès!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-teal">
        <a class="navbar-brand" href="#">EL Mouhasib</a>
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

    <div class="container content" id="Menu">
        <div>
            <h1 class="mt-5">Bienvenue</h1>
            <p>Nous sommes ravis de vous accueillir sur notre site web. Nous sommes une équipe de développeurs passionnés qui aiment créer des expériences web exceptionnelles</p>
            <a href="{{ route('OurService') }}" class="btn btn-lg mt-3">Commencer à utiliser EL Mouhasib</a>
        </div>
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="navbar-logo">
        </div>
    </div>

    <!-- Services Section -->
    <div id="Services-us-section" class="container mt-5">
        <div class="jumbotron jumbotron-sm bg-teal text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-left">Services</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service cards -->      
        
            <!-- Nos services -->
            <div id="Services-us-section" class="container mt-5">
                <div class="jumbotron jumbotron-sm bg-teal text-white">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-left">Services</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-book service-icon"></i>
                            <h3 class="service-title">Enregistrer Journal</h3>
                            <p class="service-description">L'application permet l'enregistrement des opérations journalières dans le journal comptable.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-balance-scale service-icon"></i>
                            <h3 class="service-title">Balance</h3>
                            <p class="service-description">Affiche l'état de la balance des comptes pour un suivi précis des finances.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-book-open service-icon"></i>
                            <h3 class="service-title">Grand Livre</h3>
                            <p class="service-description">Regroupe tous les comptes pour un suivi détaillé des transactions.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-chart-line service-icon"></i>
                            <h3 class="service-title">Bilan</h3>
                            <p class="service-description">Présente la situation financière de l'entreprise à un moment donné.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-file-alt service-icon"></i>
                            <h3 class="service-title">Plan Comptable</h3>
                            <p class="service-description">Propose un plan comptable détaillé pour une organisation optimale des comptes.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="service-card text-center">
                            <i class="fas fa-chart-pie service-icon"></i>
                            <h3 class="service-title">Rapports</h3>
                            <p class="service-description">Génère des rapports financiers pour les administrateurs et les comptables.</p>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </div>

    <!-- Contactez-nous -->
    <div id="contact-us-section" class="container mt-5">
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
                        <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Entrez le nom" required>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Adresse e-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez l'adresse e-mail" required>
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
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add logout confirmation dialog
        function confirmLogout(event) {
            event.preventDefault();
            const confirmationDialog = document.createElement('div');
            confirmationDialog.className = 'confirmation-dialog';
            confirmationDialog.innerHTML = `
                <div>Êtes-vous sûr de vouloir vous déconnecter ?</div>
                <button class="btn btn-confirm" onclick="document.getElementById('logout-form').submit();">Oui</button>
                <button class="btn btn-cancel" onclick="this.parentElement.remove();">Non</button>
            `;
            document.body.appendChild(confirmationDialog);
        }

        // Toggle night mode
        $(document).ready(function() {
            $('#night-mode-toggle').click(function() {
                $('body').toggleClass('night-mode');
            });
        });
    </script>
</body>
</html>
