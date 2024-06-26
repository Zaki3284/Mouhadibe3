<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
body {
    font-family: 'Montserrat', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.logo {
    text-align: center;
    margin: 20px 0;
}

.logo img {
    width: 150px;
    height: auto;
}

.btn-group {
    margin: 20px 0;
}

.btn-group .btn {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
}

.btn-group .btn:hover {
    background-color: #0056b3;
}

.section {
    display: none;
    padding: 20px;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

#dashboard {
    display: block;
}

h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

.table {
    width: 100%;
    margin-bottom: 20px;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border-top: 1px solid #dee2e6;
}

.table thead th {
    border-bottom: 2px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

@media (min-width: 768px) {
    .hidden-xs {
        display: inline-block !important;
    }
}

@media (max-width: 767px) {
    .hidden-xs {
        display: none !important;
    }
    .btn-group {
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    .btn-group .btn {
        margin-bottom: 10px;
    }
    .logo img {
        width: 100px;
    }
    h2 {
        font-size: 20px;
    }
    .table th, .table td {
        padding: 8px;
    }
}

.header-rightside {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.header-top {
    margin: 0;
    padding: 0;
    list-style: none;
}

.header-top li {
    display: inline-block;
    margin-left: 15px;
}

.header-top li a {
    color: #fff;
    text-decoration: none;
    font-size: 18px;
}

.add-project {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
}

.add-project:hover {
    background-color: #0056b3;
}

.icon-info i {
    font-size: 18px;
}

.navbar-default {
    background-color: teal;
    border: none;
}

.navbar-toggle {
    border: none;
    background: none;
}

.navbar-toggle .icon-bar {
    background-color: white;
}

.search input {
    width: 300px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 16px;
}

.search input:focus {
    outline: none;
    border-color: #007bff;
}

.modal-header {
    background-color: #007bff;
    color: white;
}

.modal-header .close {
    color: white;
}

.modal-body input, .modal-body textarea {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ddd;
    font-size: 16px;
    margin-bottom: 10px;
}

.modal-body input:focus, .modal-body textarea:focus {
    outline: none;
    border-color: #007bff;
}

.modal-body .btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    font-size: 16px;
}

.modal-body .btn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body class="home">


            <div class="logo">
                <a href="#"><img src="{{ asset('images/logo.jpeg') }}" alt="admin_logo" class="hidden-xs hidden-sm">
                    <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="admin_logo" class="visible-xs visible-sm circle-logo">
                </a>
            </div>

                                <h2>Rapport</h2>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-secondary">Aujourd'hui</button>
                                    <button type="button" class="btn btn-secondary">Cette semaine</button>
                                    <button type="button" class="btn btn-secondary">Ce mois</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</body>
</html>
