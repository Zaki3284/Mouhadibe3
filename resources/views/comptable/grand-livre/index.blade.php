<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Livre Comptable</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="6">GRAND-LIVRE COMPTABLE au 31/06/2023</th>
                <th><img src="{{ asset('libeo.png') }}" alt="LIBEO Logo"></th>
            </tr>
            <tr>
                <th>Date</th>
                <th>Numéro de Compte</th>
                <th>Nom de Compte</th>
                <th>Libellé</th>
                <th>Débit</th>
                <th>Crédit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($entries as $compte_id => $compteEntries)
                @php
                    $compte = $compteEntries->first()->compte;
                    $totalDebit = $compteEntries->sum('debit');
                    $totalCredit = $compteEntries->sum('credit');
                    $balance = $totalDebit - $totalCredit;
                @endphp
                <!-- Account Header -->
                <tr>
                    <td colspan="6">COMPTE {{ $compte ? $compte->numero_compte : 'N/A' }} {{ $compte ? $compte->nom : 'N/A' }}</td>
                </tr>
                <!-- Account Entries -->
                @foreach($compteEntries as $entry)
                    <tr>
                        <td>{{ $entry->date }}</td>
                        <td>{{ $compte ? $compte->numero_compte : 'N/A' }}</td>
                        <td>{{ $compte ? $compte->nom : 'N/A' }}</td>
                        <td>{{ $entry->description }}</td>
                        <td>{{ number_format($entry->debit, 2) }}</td>
                        <td>{{ number_format($entry->credit, 2) }}</td>
                    </tr>
                @endforeach
                <!-- Totals and Balance -->
                <tr>
                    <td>31/06/2023</td>
                    <td colspan="3">Total</td>
                    <td>{{ number_format($totalDebit, 2) }}</td>
                    <td>{{ number_format($totalCredit, 2) }}</td>
                </tr>
                <tr>
                    <td>31/06/2023</td>
                    <td colspan="3">Solde</td>
                    <td>{{ number_format(max($balance, 0), 2) }}</td>
                    <td>{{ number_format(max(-$balance, 0), 2) }}</td>
                </tr>
            @endforeach
            <!-- Grand Total -->
            @php
                $grandTotalDebit = $entries->flatten()->sum('debit');
                $grandTotalCredit = $entries->flatten()->sum('credit');
            @endphp
            <tr>
                <td colspan="2">TOTAL DU GRAND LIVRE</td>
                <td colspan="2"></td>
                <td>{{ number_format($grandTotalDebit, 2) }}</td>
                <td>{{ number_format($grandTotalCredit, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    thead th {
        text-align: center;
    }

    th[colspan="6"] {
        text-align: left;
    }

    img {
        width: 50px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    td[colspan="4"], td[colspan="6"] {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>
