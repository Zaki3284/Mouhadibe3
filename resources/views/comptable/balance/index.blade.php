<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Générale</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap for modal and button styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jsPDF and autoTable for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <!-- XLSX for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
</head>
<body>
    <div class="header">
        <h1>BALANCE GÉNÉRALE au {{ \Carbon\Carbon::parse($month)->endOfMonth()->format('d/m/Y') }}</h1>
        <form method="GET" action="{{ route('balances.index') }}" class="form-inline">
            <div class="form-group mb-2">
                <label for="month" class="sr-only">Month</label>
                <input type="month" class="form-control" id="month" name="month" value="{{ $month }}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>
        <div class="btn-group" role="group">
            <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimer</button>
            <button onclick="exportTablesToExcel()" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
            <button onclick="exportTablesToPDF()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
        </div>
    </div>
    
    <div class="form-group">
        <label for="codeJournal">Afficher par Code Journal:</label>
        <select id="codeJournal" class="form-control" onchange="filterTableByCodeJournal()">
            <option value="all">Tous</option>
            @foreach($balances as $codeJournal => $balanceGroup)
                <option value="{{ $codeJournal }}">{{ $codeJournal }}</option>
            @endforeach
        </select>
    </div>

    <!-- Table for All Accounts -->
    <table id="balance-table-all" class="balance-table">
        <caption>BALANCE GÉNÉRALE au {{ \Carbon\Carbon::parse($month)->endOfMonth()->format('d/m/Y') }}</caption>
        <thead>
            <tr>
                <th rowspan="2">Numéro de Compte</th>
                <th rowspan="2">Nom du Compte</th>
                <th colspan="2">Mouvements</th>
                <th colspan="2">Soldes</th>
            </tr>
            <tr>
                <th>Débit</th>
                <th>Crédit</th>
                <th>Débit</th>
                <th>Crédit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($balances->flatten() as $balance)
                <tr>
                    <td>{{ $balance->account }}</td>
                    <td>{{ $balance->compte->nom ?? '' }}</td>
                    <td>{{ number_format($balance->movement_debit, 2) }}</td>
                    <td>{{ number_format($balance->movement_credit, 2) }}</td>
                    <td>{{ number_format($balance->balance_debit, 2) }}</td>
                    <td>{{ number_format($balance->balance_credit, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total Balance</td>
                <td>{{ number_format($balances->flatten()->sum('movement_debit'), 2) }}</td>
                <td>{{ number_format($balances->flatten()->sum('movement_credit'), 2) }}</td>
                <td>{{ number_format($balances->flatten()->sum('balance_debit'), 2) }}</td>
                <td>{{ number_format($balances->flatten()->sum('balance_credit'), 2) }}</td>
            </tr>
        </tfoot>
    </table>

    @foreach($balances as $codeJournal => $balanceGroup)
        <table id="balance-table-{{ $codeJournal }}" class="balance-table d-none">
            <caption>BALANCE GÉNÉRALE ({{ $codeJournal }}) au {{ \Carbon\Carbon::parse($month)->endOfMonth()->format('d/m/Y') }}</caption>
            <thead>
                <tr>
                    <th rowspan="2">Numéro de Compte</th>
                    <th rowspan="2">Nom du Compte</th>
                    <th colspan="2">Mouvements</th>
                    <th colspan="2">Soldes</th>
                </tr>
                <tr>
                    <th>Débit</th>
                    <th>Crédit</th>
                    <th>Débit</th>
                    <th>Crédit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balanceGroup as $balance)
                    <tr>
                        <td>{{ $balance->account }}</td>
                        <td>{{ $balance->compte->nom ?? '' }}</td>
                        <td>{{ number_format($balance->movement_debit, 2) }}</td>
                        <td>{{ number_format($balance->movement_credit, 2) }}</td>
                        <td>{{ number_format($balance->balance_debit, 2) }}</td>
                        <td>{{ number_format($balance->balance_credit, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total Balance</td>
                    <td>{{ number_format($balanceGroup->sum('movement_debit'), 2) }}</td>
                    <td>{{ number_format($balanceGroup->sum('movement_credit'), 2) }}</td>
                    <td>{{ number_format($balanceGroup->sum('balance_debit'), 2) }}</td>
                    <td>{{ number_format($balanceGroup->sum('balance_credit'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    @endforeach

    <a href="{{ route('comptable.dashboard') }}" class="back-button"><i class="fas fa-home"></i> Retour à la page comptable dashboard</a>
    <script>
        function filterTableByCodeJournal() {
            const selectedCodeJournal = document.getElementById('codeJournal').value;
            const allTables = document.querySelectorAll('.balance-table');
            allTables.forEach(table => table.classList.add('d-none'));

            if (selectedCodeJournal === 'all') {
                document.getElementById('balance-table-all').classList.remove('d-none');
            } else {
                document.getElementById(`balance-table-${selectedCodeJournal}`).classList.remove('d-none');
            }
        }

        function exportTablesToExcel() {
            const tables = document.querySelectorAll('table');
            tables.forEach((table, index) => {
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.table_to_sheet(table);
                XLSX.utils.book_append_sheet(wb, ws, `Balance ${index}`);
                XLSX.writeFile(wb, `balance_generale_${index}.xlsx`);
            });
        }

        function exportTablesToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const tables = document.querySelectorAll('table');

            tables.forEach((table, index) => {
                const title = table.querySelector('caption').textContent.trim(); // Get the caption text as title
                doc.text(title, 10, 10);
                doc.autoTable({ html: table });
                if (index < tables.length - 1) {
                    doc.addPage();
                }
            });

            doc.save('balance_generale.pdf');
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: teal;
        }

        .header {
            margin-bottom: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }

        .form-inline .form-control {
            margin-right: 10px;
            width: 150px; /* Adjust width as needed */
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-inline .btn-primary {
            padding: 8px 16px;
        }

        .btn-group {
            margin-bottom: 20px;
        }

        .btn-group .btn {
            padding: 8px 16px;
            margin-right: 10px;
        }

        .btn-group .btn i {
            margin-right: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 18px;
        }

        table caption {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        table thead tr {
            background-color: #f2f2f2;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        table th {
            font-weight: bold;
            text-align: center;
        }

        table tfoot tr {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Alternating row background color */
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            color: #FFC312;
            text-decoration: none;
            font-size: 16px;
        }

        .back-button:hover {
            text-decoration: underline;
            color: teal;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-group label {
            margin-right: 10px;
            font-weight: bold;
        }

        .form-group select {
            width: 200px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .d-none {
            display: none;
        }
    </style>
</body>
</html>
