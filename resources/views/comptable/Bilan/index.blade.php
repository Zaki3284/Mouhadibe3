<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilan Actif et Passif</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #ffffff;
        }
        tfoot {
            font-weight: bold;
        }
        .btn-group {
            margin-bottom: 20px;
        }
        .section-header {
            background-color: #e0e0e0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Bilan Actif et Passif</h2>
    <div class="btn-group" role="group">
        <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimer</button>
        <button onclick="exportTableToExcel('bilanTable', 'bilan_actif_passif')" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="exportTableToPDF('bilanTable', 'bilan_actif_passif.pdf')" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
    </div>
    <table id="bilanTable">
        <thead>
            <tr>
                <th>Actif</th>
                <th>Montant</th>
                <th>Passif</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bilans as $bilan)
                @if ($bilan->type == 'Actif' || $bilan->type == 'Actif Immobilisé' || $bilan->type == 'Actif Circulant')
                    <tr>
                        <td>{{ $bilan->nom }}</td>
                        <td>{{ number_format($bilan->amount, 2) }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ $bilan->nom }}</td>
                        <td>{{ number_format($bilan->amount, 2) }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>Total Actif</td>
                <td>{{ number_format($total_actif, 2) }}</td>
                <td>Total Passif</td>
                <td>{{ number_format($total_passif, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <script>
        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            
            downloadLink = document.createElement("a");
            
            document.body.appendChild(downloadLink);
            
            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }

        function exportTableToPDF(tableID, filename = '') {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ html: `#${tableID}` });
            doc.save(filename);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>
</body>
</html>
