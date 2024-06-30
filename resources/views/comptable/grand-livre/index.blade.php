<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Livre Comptable</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap for modal and button styling (optional if you're not using Bootstrap features) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- JavaScript libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
</head>
<body>
    <div class="header">
        <h1>GRAND-LIVRE COMPTABLE au {{ date('d/m/Y') }}</h1>
        <form method="GET" action="{{ route('entries.index') }}">
            <label for="month">Mois:</label>
            <input type="month" id="month" name="month" value="{{ $month }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
        <div class="btn-group" role="group">
            <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimer</button>
            <button onclick="exportTableToExcel('tableData', 'grand-livre')" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
            <button onclick="exportTableToPDF()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
        </div>
    </div>
    <table id="tableData">
        <thead>
            <tr>
                <th colspan="6">GRAND-LIVRE COMPTABLE au {{ date('d/m/Y') }}</th>
                <th><img src="{{ asset('images/logo.jpeg') }}" alt="LIBEO Logo"></th>
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
                    <td colspan="6">COMPTE {{ $compte->numero_compte ?? 'N/A' }} {{ $compte->nom ?? 'N/A' }}</td>
                </tr>
                <!-- Account Entries -->
                @foreach($compteEntries as $entry)
                    <tr>
                        <td>{{ $entry->date }}</td>
                        <td>{{ $compte->numero_compte ?? 'N/A' }}</td>
                        <td>{{ $compte->nom ?? 'N/A' }}</td>
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
                    <td>{{ date('d/m/Y') }}</td>
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
        color: teal
    }

    table {
        margin-top: 20px;
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center; /* Center align text in table cells */
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    td[colspan="4"], td[colspan="6"] {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .btn {
        padding: 8px 12px;
        margin-right: 5px;
    }

    .btn i {
        margin-right: 5px;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .header h1 {
        font-size: 24px;
        margin: 0;
    }

    .header form {
        display: flex;
        align-items: center;
    }

    .header form label {
        margin-right: 10px;
    }
    /* CSS for image */
img {
    width: 50px; /* Adjust the width as needed */
    height: auto; /* Maintain aspect ratio */
    display: block; /* Ensures the image behaves like a block-level element */
    margin-left: auto; /* Aligns image to the right within its container */
}

/* CSS for input */
input[type="month"] {
    padding: 8px; /* Padding inside the input field */
    font-size: 14px; /* Font size of the input text */
    border: 1px solid #ccc; /* Border style */
    border-radius: 4px; /* Rounded corners */
    width: 150px; /* Width of the input field */
    box-sizing: border-box; /* Ensures padding and border are included in the width */
}

input[type="month"]:focus {
    outline: none; /* Remove the default focus outline */
    border-color: #66afe9; /* Border color on focus */
    box-shadow: 0 0 5px rgba(102, 175, 233, 0.5); /* Box shadow on focus */
}


</style>

<script>
    function exportTableToExcel(tableID, filename = '') {
        var table = document.getElementById(tableID);
        var wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
        var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        var blob = new Blob([s2ab(wbout)], { type: "application/octet-stream" });
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = filename ? filename + '.xlsx' : 'excel_data.xlsx';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }

    function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.autoTable({ html: '#tableData' });
        doc.save('grand-livre.pdf');
    }
</script>
