<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Comptable</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global styles */
        body {
            background-color: #f0f0f0;
            color: white;
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 20px;
            background-color: teal;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo img {
            width: 80px;
            border: 5px solid #FFC312;
            border-radius: 20px;
            margin-right: 10px;
        }
        .logout {
            background-color: #FFC312;
            color: teal;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .logout:hover {
            background-color: #c9302c;
        }
        .account-info {
            background-color: teal;
            color: white;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px #333;
            text-align: left;
            width: 90%;
            max-width: 600px;
        }
        .account-info h2 {
            margin-top: 0;
            font-size: 20px;
            color: #FFC312;
            cursor: pointer;
        }
        .account-info p {
            margin: 5px 0;
        }
        .account-info i {
            color: #FFC312;
        }
        .container {
            text-align: center;
            width: 90%;
            max-width: 1200px;
            margin-top: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: teal;
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
            height: 100px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-icon {
            font-size: 30px;
            margin-bottom: 10px;
            color: #FFC312;
        }
        .card a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
            <h1>Dashboard Comptable</h1>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout">
                <i class="fas fa-sign-out-alt"></i> Se Déconnecter
            </button>
        </form>
    </div>

    <div class="account-info">
        <h2><i class="fas fa-user"></i> Informations du Comptable</h2>
        <p><i class="fas fa-user-circle"></i> Nom : {{ Auth::user()->username }}</p>
    </div>

    <div class="container">
        <div class="grid">
            <div class="card">
                <div class="card-icon"><i class="fas fa-book"></i></div>
                <div><a href="{{ route('journals.index') }}">Journal</a></div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-book-open"></i></div>
                <div><a href="{{ route('entries.index') }}">Grand Livre</a></div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-balance-scale"></i></div>
                <div><a href="{{ route('balances.index') }}">Balance</a></div>
            </div>
            <div class="card">
                <div class="card-icon"><i class="fas fa-file"></i></div>
                <div><a href="{{ route('reports.index') }}">Rapports</a></div>
            </div>
        </div>
    </div>
</body>
</html>
