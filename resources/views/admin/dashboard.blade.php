<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Tableau de Bord Administrateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Dashbord.css') }}">
    <style>
        .section {
            display: none;
        }
        #dashboard {
            display: block;
        }
        .main-container {
            padding: 20px;
        }
        .main-title p {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .main-cards, .charts, .user-management, .role-management, .system-settings, .fournisseur-section {
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body class="home">
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <div class="logo">
                <a href="#"><img src="{{ asset('images/logo.jpeg') }}" alt="admin_logo" class="hidden-xs hidden-sm">
                    <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="admin_logo" class="visible-xs visible-sm circle-logo">
                </a>
            </div>
            <div class="navi">
                <ul>
                    <li class="active"><a href="#dashboard" class="menu-link"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Tableau de Bord</span></a></li>
                    <li><a href="#reports" class="menu-link"><i class="fa fa-file-alt" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Rapports</span></a></li>
                    <li><a href="#fournisseur" class="menu-link"><i class="fa fa-comments" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Salle Fournisseur</span></a></li>
                    <li><a href="#system-settings" class="menu-link"><i class="fa fa-cogs" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Paramètres du Système</span></a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-10 col-sm-11 display-table-cell v-align" style="background-color: teal;">
            <div class="row">
                <header style="background-color: teal;">
                    <div class="col-md-7">
                        <nav class="navbar-default pull-left">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-5">
                        <div class="header-rightside">
                            <ul class="list-inline header-top pull-right">
                                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                <li>
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        <span class="label label-primary">3</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('images/Admin.png') }}" alt="utilisateur">
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                @if(Auth::check())
                                                <span>{{ Auth::user()->name }}</span>
                                                <p class="text-muted small">{{ Auth::user()->email }}</p>
                                                @if(Auth::user()->company)
                                                    <p class="text-muted small">Nom de l'entreprise: {{ Auth::user()->company->company_name }}</p>
                                                @else
                                                    <p class="text-muted small">Nom de l'entreprise non défini</p>
                                                @endif
                                            @else
                                                <span>Invité</span>
                                                <p class="text-muted small">guest@example.com</p>
                                            @endif
                                                <div class="divider"></div>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                
                                                <a href="#" class="logout btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Déconnexion <i class="fas fa-sign-out-alt"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>
            </div>
            <!-- Main -->
            <main class="main-container">
                <div id="dashboard" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">TABLEAU DE BORD</p>
                    </div>
                    <div class="main-cards">
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">TOTAL RAPPORTS</p>
                                <span class="material-icons-outlined text-blue">description</span>
                            </div>
                            <span class="text-primary font-weight-bold">1200</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">TAUX D'AVANCEMENT</p>
                                <span class="material-icons-outlined text-orange">hourglass_top</span>
                            </div>
                            <span class="text-primary font-weight-bold">45</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">RAPPORTS DÉJÀ LUS</p>
                                <span class="material-icons-outlined text-green">done_all</span>
                            </div>
                            <span class="text-primary font-weight-bold">30</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">ALERTES SYSTÈME</p>
                                <span class="material-icons-outlined text-red">notification_important</span>
                            </div>
                            <span class="text-primary font-weight-bold">8</span>
                        </div>
                    </div>
                </div>
                
                <!-- Reports Section -->
                <div id="reports" class="section">
                    <h2>Rapports</h2>
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Nom du Comptable</th>
                                <th>Charge Totale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Fournisseur Section -->
                <div id="fournisseur" class="section">
                    <h2>Salle Fournisseur</h2>
                    <!-- Input fields for message content, product name, quantity, and price -->
                    <div id="messageForm">
                        <div class="inputWithIcon">
                            <i class="fas fa-shopping-cart"></i>
                            <select id="productNameSelect">
                                <option value="">Sélectionner un produit</option>
                                <option value="product1">Produit 1</option>
                                <option value="product2">Produit 2</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="inputWithIcon">
                            <i class="fas fa-boxes"></i>
                            <input type="number" id="quantityInput" placeholder="Quantité">
                        </div>
                        <div class="inputWithIcon">
                            <i class="fas fa-comment"></i>
                            <input type="text" id="messageInput" placeholder="Tapez votre message ici...">
                        </div>
                        <button id="sendMessageButton"><i class="fas fa-paper-plane"></i> Envoyer le message</button>
                    </div>
                </div>
                
                <!-- System Settings Section -->
                <!-- System Settings Section -->
<div id="system-settings" class="section">
    <h2>Paramètres du Système</h2>
    <div class="settings-content">
        <div class="setting-option">
            <a href="{{ route('comptes.index') }}" data-toggle="modal">
                <i class="fas fa-plus-circle fa-5x setting-icon"></i>
                <p>Ajouter un Compte au Plan Comptable</p>
            </a>
        </div>
        <div class="setting-option">
            <a href="#" data-toggle="modal" data-target="#addComptableModal">
                <i class="fas fa-user-plus fa-5x setting-icon"></i>
                <p>Ajouter un Nouveau Comptable</p>
            </a>
        </div>
        
        <div class="setting-option">
            <a href="#" data-toggle="modal" data-target="#reportProblemModal">
                <i class="fas fa-exclamation-triangle fa-5x setting-icon"></i>
                <p>Signaler un Problème</p>
            </a>
        </div>
        
    </div>
</div>


<!-- Add Comptable Modal -->
<div class="modal fade" id="addComptableModal" tabindex="-1" role="dialog" aria-labelledby="addComptableModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addComptableModalLabel">Ajouter un Nouveau Comptable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addComptableForm">
                    <div class="form-group">
                        <label for="comptableName">Nom</label>
                        <input type="text" class="form-control" id="comptableName" placeholder="Entrer le nom">
                    </div>
                    <div class="form-group">
                        <label for="comptableEmail">Email</label>
                        <input type="email" class="form-control" id="comptableEmail" placeholder="Entrer l'email">
                    </div>
                    <div class="form-group">
                        <label for="comptablePhone">Téléphone</label>
                        <input type="text" class="form-control" id="comptablePhone" placeholder="Entrer le numéro de téléphone">
                    </div>
                    <div class="form-group">
                        <label for="comptablePassword">Mot de Passe</label>
                        <input type="password" class="form-control" id="comptablePassword" placeholder="Entrer le mot de passe">
                    </div>
                    <div class="form-group">
                        <label for="comptableConfirmPassword">Confirmer le Mot de Passe</label>
                        <input type="password" class="form-control" id="comptableConfirmPassword" placeholder="Confirmer le mot de passe">
                    </div>
                    <!-- Add other fields as needed -->
                    <button type="submit" class="btn">Ajouter le Comptable</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Compte Modal -->
<div class="modal fade" id="addCompteModal" tabindex="-1" role="dialog" aria-labelledby="addCompteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompteModalLabel">Ajouter un Compte au Plan Comptable</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCompteForm" action="{{ route('comptes.store') }}" method="POST">
                    <div class="form-group">
                        <label for="compteNom">Nom du Compte</label>
                        <input type="text" class="form-control" id="compteNom" placeholder="Entrer le nom du compte">
                    </div>
                    <div class="form-group">
                        <label for="compteType">Type</label>
                        <select class="form-control" id="compteType">
                            <option value="actif">Actif</option>
                            <option value="passif">Passif</option>
                            <option value="capitaux propres">Capitaux Propres</option>
                            <option value="revenu">Revenu</option>
                            <option value="dépense">Dépense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="compteClasse">Classe</label>
                        <select class="form-control" id="compteClasse">
                            <option value="1">Classe 1 : Comptes de Capitaux</option>
                            <option value="2">Classe 2 : Comptes d'Immobilisations</option>
                            <option value="3">Classe 3 : Comptes de Stocks et en-cours</option>
                            <option value="4">Classe 4 : Comptes de Tiers</option>
                            <option value="5">Classe 5 : Comptes Financiers</option>
                            <option value="6">Classe 6 : Comptes de Charges</option>
                            <option value="7">Classe 7 : Comptes de Produits</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="compteNumero">Numéro de Compte</label>
                        <input type="text" class="form-control" id="compteNumero" placeholder="Entrer le numéro de compte">
                    </div>
                    <button type="submit" class="btn">Ajouter le Compte</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Report Problem Modal -->
<div class="modal fade" id="reportProblemModal" tabindex="-1" role="dialog" aria-labelledby="reportProblemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportProblemModalLabel">Signaler un Problème</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reportProblemForm">
                    <div class="form-group">
                        <label for="problemDescription">Description</label>
                        <textarea class="form-control" id="problemDescription" placeholder="Décrire le problème"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="problemPriority">Priorité</label>
                        <select class="form-control" id="problemPriority">
                            <option value="low">Basse</option>
                            <option value="medium">Moyenne</option>
                            <option value="high">Haute</option>
                        </select>
                    </div>
                    <button type="submit" class="btn">Envoyer le Rapport</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn{
    background-color: teal;
    border-color: teal;
    color: white;
}
</style>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $(".menu-link").click(function(){
        var sectionId = $(this).attr("href");
        $(".section").hide();
        $(sectionId).show();
    });
});
</script>
</body>
</html>
