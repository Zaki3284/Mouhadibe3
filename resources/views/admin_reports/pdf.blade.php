<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Journalier pour Admin</title>
    <style>
        /* Reset default browser styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; /* Light gray background */
            color: #333; /* Darker text color */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: teal;
            padding: 10px 0;
            text-align: center;
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-top: 20px;
            color: teal;
        }

        h2 {
            color: teal;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff; /* White background for the table */
            border: 1px solid #ddd; /* Light gray border */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        {{-- <div class="container">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Company Logo" class="logo">
        </div> --}}
    </header>

    <main>
        <div class="container">
            <h1>Rapport du {{ \Carbon\Carbon::parse($adminReport->date)->format('d/m/Y') }}</h1>
            <p>{{ $adminReport->comments }}</p>

            <h2>Rapport Journalier pour Admin</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>N° Compte</th>
                        <th>Libellé</th>
                        <th>Montant Débit</th>
                        <th>Montant Crédit</th>
                        <th>Code Journal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($journals as $journal)
                        <tr>
                            <td>{{ $journal->Date }}</td>
                            <td>{{ $journal->Numero_de_Compte }}</td>
                            <td>{{ $journal->Libelle }}</td>
                            <td>{{ $journal->Montant_Debit }}</td>
                            <td>{{ $journal->Montant_Credit }}</td>
                            <td>{{ $journal->Code_Journal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
