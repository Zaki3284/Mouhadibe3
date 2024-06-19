<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Comptable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
    <style>
        .section {
            display: none;
        }
        #dashboard {
            display: block;
        }
        .modal-title {
            font-weight: bold;
        }
        .main-cards .card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="home">
<div class="container-fluid display-table">
    <div class="row display-table-row">
        <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
            <div class="logo">
                <a href="#"><img src="{{ asset('images/logo.jpeg') }}" alt="accountant_logo" class="hidden-xs hidden-sm">
                    <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="accountant_logo" class="visible-xs visible-sm circle-logo">
                </a>
            </div>
            <div class="navi">
                <ul>
                    <li class="active"><a href="#dashboard" class="menu-link"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></li>
                    <li><a href="#journal" class="menu-link"><i class="fa fa-book" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Journal</span></a></li>
                    <li><a href="#grand-livre" class="menu-link"><i class="fa fa-book" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Grand Livre</span></a></li>
                    <li><a href="#balance" class="menu-link"><i class="fa fa-balance-scale" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Balance</span></a></li>
                    <li><a href="#compte-resultat" class="menu-link"><i class="fa fa-balance-scale" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Compte de Résultat</span></a></li>
                    <li><a href="#products" class="menu-link"><i class="fa fa-cubes" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Products</span></a></li>
                    <li><a href="#settings" class="menu-link"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Settings</span></a></li>
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
                                <li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#crudModal" style="background-color: #FFC312;">Add Entry</a></li>
                                <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                                <li>
                                    <a href="#" class="icon-info">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                        <span class="label label-primary">3</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://jskrishna.com/work/merkury/images/user-pic.jpg" alt="user">
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span>Accountant Name</span>
                                                <p class="text-muted small">email@example.com</p>
                                                <div class="divider"></div>
                                               
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                
                                                <a href="#" class="logout btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout <i class="fas fa-sign-out-alt"></i>
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
                        <p class="font-weight-bold">DASHBOARD</p>
                    </div>
                    <div class="main-cards">
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">PRODUCTS</p>
                                <i class="fas fa-box-open text-blue" style="font-size: 40px;"></i>
                            </div>
                            <span class="text-primary font-weight-bold">249</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">JOURNALS</p>
                                <i class="fas fa-book-open text-orange" style="font-size: 40px;"></i>
                            </div>
                            <span class="text-primary font-weight-bold">83</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">REPORTS</p>
                                <i class="fas fa-chart-bar text-green" style="font-size: 40px;"></i>
                            </div>
                            <span class="text-primary font-weight-bold">79</span>
                        </div>
                        <div class="card">
                            <div class="card-inner">
                                <p class="text-primary">INVENTORY ALERTS</p>
                                <span class="material-icons-outlined text-red">notification_important</span>
                            </div>
                            <span class="text-primary font-weight-bold">56</span>
                        </div>
                    </div>
                    
                    <div class="charts">
                        <div class="charts-card">
                            <p class="chart-title">Top 5 Products</p>
                            <div id="bar-chart"></div>
                        </div>
                        <div class="charts-card">
                            <p class="chart-title">Seueil de rentabilite</p>
                            <div id="area-chart"></div>
                        </div>
                    </div>
                </div>

                <div id="journal" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">JOURNAL ENTRIES</p>
                    </div>
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>N° Compte Débit</th>
                                <th>N° Compte Crédit</th>
                                <th>Emplois</th>
                                <th>Date</th>
                                <th>Ressources</th>
                                <th>Montant Débit</th>
                                <th>Montant Crédit</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example row -->
                            <tr>
                                <td>1001</td>
                                <td>2001</td>
                                <td>Cash</td>
                                <td>2023-05-01</td>
                                <td>Sales</td>
                                <td>1000.00</td>
                                <td>1000.00</td>
                                <td>
                                    <button class="btn btn-primary btn-edit">Edit</button>
                                    <button class="btn btn-danger btn-delete">Delete</button>
                                </td>
                            </tr>
                            <!-- More rows as needed -->
                        </tbody>
                    </table>
                </div>

                <div id="compte-resultat" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">COMPTE DE RÉSULTAT</p>
                    </div>
                    <!-- Add your Compte de Résultat content here -->
                </div>

                <div id="grand-livre" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">GRAND LIVRE</p>
                    </div>
                    <!-- Add your Grand Livre content here -->
                </div>

                <div id="balance" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">BALANCE</p>
                    </div>
                    <!-- Add your Balance content here -->
                </div>

                <div id="products" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">PRODUCTS</p>
                    </div>
                    <!-- Add your Products content here -->
                </div>

                <div id="settings" class="section">
                    <div class="main-title">
                        <p class="font-weight-bold">SETTINGS</p>
                    </div>
                    <!-- Add your Settings content here -->
                </div>
            </main>
        </div>
    </div>
</div>

<!-- CRUD Modal -->
<div class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FFC312;">
                <h4 class="modal-title" id="crudModalLabel">Add Journal Entry</h4>
            </div>
            <div class="modal-body">
                <form id="crudForm">
                    <div class="form-group">
                        <label for="debitAccount">N° Compte Débit</label>
                        <input type="text" class="form-control" id="debitAccount" required>
                    </div>
                    <div class="form-group">
                        <label for="creditAccount">N° Compte Crédit</label>
                        <input type="text" class="form-control" id="creditAccount" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Emplois</label>
                        <input type="text" class="form-control" id="description" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="form-group">
                        <label for="ressources">Ressources</label>
                        <input type="text" class="form-control" id="ressources" required>
                    </div>
                    <div class="form-group">
                        <label for="debitAmount">Montant Débit</label>
                        <input type="number" class="form-control" id="debitAmount" required>
                    </div>
                    <div class="form-group">
                        <label for="creditAmount">Montant Crédit</label>
                        <input type="number" class="form-control" id="creditAmount" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background-color: #FFC312;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="crudForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!-- Custom Script -->
<script>
    $(document).ready(function () {
        $('.menu-link').click(function (e) {
            e.preventDefault();
            $('.section').hide();
            $($(this).attr('href')).show();
            $('.navi ul li').removeClass('active');
            $(this).parent().addClass('active');
        });
    });
</script>
</body>
</html>
