<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Tableau de Bord Super Admin</title>
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
            margin-left: 100px
        }
        .main-title p {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .main-cards, .charts, .user-management, .role-management, .system-settings, .fournisseur-section {
            margin-bottom: 20px;
        }
        td{
            color: white
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
                    <li><a href="#user-management" class="menu-link"><i class="fa fa-users" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gestion des Utilisateurs</span></a></li>
                    <li><a href="#contact-us-section" class="menu-link"><i class="fa fa-envelope" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Messages Contactez-Nous</span></a></li>

                    <li><a href="#issue-management" class="menu-link"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Problèmes Signalés</span></a></li>
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ asset('images/superAdmin.png') }}" alt="utilisateur">
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
                                <p class="text-primary">TOTAL UTILISATEURS</p>
                                <span class="material-icons-outlined text-blue">groups</span>
                            </div>
                            <span class="text-primary font-weight-bold">{{ $totalUsers }}</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">PROBLÈMES SIGNALÉS</p>
                                <span class="material-icons-outlined text-red">report_problem</span>
                            </div>
                            <span class="text-primary font-weight-bold">{{ $totalProblems }}</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">NOUVELLES FONCTIONNALITÉS</p>
                                <span class="material-icons-outlined text-green">new_releases</span>
                            </div>
                            <span class="text-primary font-weight-bold">10</span>
                        </div>
                    </div>
                </div>

            <!-- User Management Section -->
            <div id="user-management" class="section">
                <h2>Gestion des Utilisateurs</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <button class="btn btn-primary">Modifier</button>
                                <button class="btn btn-danger">Supprimer</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End User Management Section -->
            
            <!-- Issue Management Section -->
            <div id="issue-management" class="section">
                <h2>Problèmes Signalés</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Priorité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    @foreach($problems as $problem)
            <tr>
                <td>{{ $problem->description }}</td>
                <td>{{ ucfirst($problem->priority) }}</td>
                <td>{{ $problem->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>

        </table>
            </div>
            <!-- End Issue Management Section -->
            
            <div id="contact-us-section" class="section">
                <div class="main-title">
                    <p class="font-weight-bold">Messages Contactez-Nous</p>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th>Date Reçue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactMessages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            

    <
            
            <!-- System Settings Section -->
            <div id="system-settings" class="section">
                <h2>Paramètres du Système</h2>
                <div class="settings-content">
                    <div class="setting-option">
                        {{-- <a href="{{ route('importer') }}" class="btn btn-primary">Importer des Données</a> --}}
                        <a  class="btn btn-primary">Importer des Données</a>
                    </div>
                    <div class="setting-option">
                        {{-- <a href="{{ route('exporter') }}" class="btn btn-secondary">Exporter des Données</a> --}}
                        <a  class="btn btn-secondary">Exporter des Données</a>
                    </div>
                    <div class="setting-option">
                        {{-- <a href="{{ route('logs') }}" class="btn btn-warning">Voir les Logs</a> --}}
                        <a  class="btn btn-warning">Voir les Logs</a>
                    </div>
                </div>
            </div>
            <!-- End System Settings Section -->
        </main>
    </div>
</div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(".menu-link").click(function() {
            var target = $(this).attr("href");
            $(".section").hide();
            $(target).show();
        });
    });
</script>
</body>
</html>