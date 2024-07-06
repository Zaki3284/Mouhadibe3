<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal des Opérations</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include Bootstrap CSS and Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Your custom styles -->
    <style> 
               body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: teal;
            color: white;
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
        .modal-dialog {
            width: 900px;
            background-color: teal;
            color: teal;
        }
        h1 {
            text-align: center;
            font-size: 2rem;
            margin-top: 20px;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            color:#FFC312;
            text-decoration: none;
            font-size: 16px;
        }

        .back-button:hover {
            text-decoration: underline;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <h2>Journal des Opérations</h2>

    <div class="btn-group" role="group">
        <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimer</button>
        <button onclick="exportTableToExcel('tableData', 'journal')" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="exportTableToPDF()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#journalFormModal"><i class="fas fa-plus"></i> Ajouter</button>
    </div>

    <!-- Search Inputs -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="searchCodeJournal">Rechercher par Code Journal:</label>
            <select class="form-control" id="searchCodeJournal" onchange="filterTable()">
                <option value="">Tous</option>
                <option value="Achat">Achat</option>
                <option value="Vente">Vente</option>
                <option value="General">Général</option>
                <option value="Banque">Banque</option>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="searchMonth">Rechercher par Mois:</label>
            <input type="month" class="form-control" id="searchMonth" onchange="filterTable()">
        </div>
    </div>

    <!-- Add/Edit Form - Modal -->
    <div id="journalFormModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalTitle">Ajouter une entrée</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="journalForm">
                        @csrf
                        <input type="hidden" id="journal_id" name="journal_id">
                        <div class="form-group">
                            <label for="Date">Date:</label>
                            <input type="date" class="form-control" id="Date" name="Date" required>
                        </div>
                        <div class="form-group">
                            <label for="Numero_de_Compte">N° Compte:</label>
                            <input type="text" class="form-control" id="Numero_de_Compte" name="Numero_de_Compte" required>
                        </div>
                        <div class="form-group">
                            <label for="Libelle">Libellé:</label>
                            <input type="text" class="form-control" id="Libelle" name="Libelle" required>
                        </div>
                        <div class="form-group">
                            <label for="Montant_Debit">Montant Débit:</label>
                            <input type="number" step="0.01" class="form-control" id="Montant_Debit" name="Montant_Debit">
                        </div>
                        <div class="form-group">
                            <label for="Montant_Credit">Montant Crédit:</label>
                            <input type="number" step="0.01" class="form-control" id="Montant_Credit" name="Montant_Credit">
                        </div>
                        <div class="form-group">
                            <label for="Code_Journal">Code Journal:</label>
                            <select class="form-control" id="Code_Journal" name="Code_Journal" required>
                                <option value="Achat">Achat</option>
                                <option value="Vente">Vente</option>
                                <option value="General">Général</option>
                                <option value="Banque">Banque</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveJournalEntry()">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table to display journals -->
    <table id="tableData" class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>N° Compte</th>
                <th>Libellé</th>
                <th>Montant Débit</th>
                <th>Montant Crédit</th>
                <th>Code Journal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $journal)
                <tr id="row_{{ $journal->id }}">
                    <td>{{ $journal->Date }}</td>
                    <td>{{ $journal->Numero_de_Compte }}</td>
                    <td>{{ $journal->Libelle }}</td>
                    <td>{{ $journal->Montant_Debit }}</td>
                    <td>{{ $journal->Montant_Credit }}</td>
                    <td>{{ $journal->Code_Journal }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="editJournalEntry({{ $journal->id }})"><i class="fas fa-edit"></i> Modifier</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmDeleteJournalEntry({{ $journal->id }})"><i class="fas fa-trash"></i> Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="totals">
            <tr>
                <td colspan="3">Total</td>
                <td id="totalDebit">0.00</td>
                <td id="totalCredit">0.00</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <!-- Success Modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Succès</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Opération effectuée avec succès.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('comptable.dashboard') }}" class="back-button"><i class="fas fa-home"></i> Retour à la page comptable dashboard</a>
    <!-- Error Modal -->
    <div id="errorModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Erreur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette entrée ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteButton">Supprimer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    
    <script>
        // Setup CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': getCsrfToken()
    }
});


function filterTable() {
            const searchCodeJournal = $('#searchCodeJournal').val().toLowerCase();
            const searchMonth = $('#searchMonth').val();

            $('#tableData tbody tr').each(function() {
                const row = $(this);
                const codeJournal = row.find('td:nth-child(6)').text().toLowerCase();
                const date = row.find('td:nth-child(1)').text();
                const rowMonth = date ? date.slice(0, 7) : '';

                if ((searchCodeJournal === '' || codeJournal.includes(searchCodeJournal)) &&
                    (searchMonth === '' || rowMonth === searchMonth)) {
                    row.show();
                } else {
                    row.hide();
                }
            });
        }

$(document).ready(function() {
    // Call calculateTotals when the page loads
    calculateTotals();
});

// Function to calculate totals
function calculateTotals() {
    let totalDebit = 0;
    let totalCredit = 0;

    $('#tableData tbody tr').each(function() {
        let debit = parseFloat($(this).find('td').eq(3).text()) || 0;
        let credit = parseFloat($(this).find('td').eq(4).text()) || 0;
        totalDebit += debit;
        totalCredit += credit;
    });

    $('#totalDebit').text(totalDebit.toFixed(2));
    $('#totalCredit').text(totalCredit.toFixed(2));

    // Determine background color based on totals comparison
    if (totalDebit === totalCredit) {
        $('#totalDebit, #totalCredit').css('color', 'green');
    } else {
        $('#totalDebit, #totalCredit').css('color', 'red');
    }
}

// Function to get CSRF token from meta tag
function getCsrfToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

// Setup CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': getCsrfToken()
    }
});

// Function to save a journal entry (Create or Update)
function saveJournalEntry() {
    var formData = $('#journalForm').serialize();
    var journalId = $('#journal_id').val();
    var methodType = (journalId != '') ? 'PUT' : 'POST';
    var url = (journalId != '') ? '/journals/' + journalId : '/journals';

    $.ajax({
        type: methodType,
        url: url,
        data: formData,
        success: function(response) {
            $('#journalFormModal').modal('hide');
            $('#successModal').modal('show');
            clearFormFields();
            if (methodType === 'PUT') {
                // Update existing row in table
                $('#row_' + response.id + ' td:eq(0)').text(response.Date);
                $('#row_' + response.id + ' td:eq(1)').text(response.Numero_de_Compte);
                $('#row_' + response.id + ' td:eq(2)').text(response.Libelle);
                $('#row_' + response.id + ' td:eq(3)').text(response.Montant_Debit);
                $('#row_' + response.id + ' td:eq(4)').text(response.Montant_Credit);
                $('#row_' + response.id + ' td:eq(5)').text(response.Code_Journal);
            } else {
                // Add new row to table
                var newRow = '<tr id="row_' + response.id + '">';
                newRow += '<td>' + response.Date + '</td>';
                newRow += '<td>' + response.Numero_de_Compte + '</td>';
                newRow += '<td>' + response.Libelle + '</td>';
                newRow += '<td>' + response.Montant_Debit + '</td>';
                newRow += '<td>' + response.Montant_Credit + '</td>';
                newRow += '<td>' + response.Code_Journal + '</td>';
                newRow += '<td>';
                newRow += '<button class="btn btn-primary btn-sm" onclick="editJournalEntry(' + response.id + ')"><i class="fas fa-edit"></i> Modifier</button>';
                newRow += '<button class="btn btn-danger btn-sm" onclick="confirmDeleteJournalEntry(' + response.id + ')"><i class="fas fa-trash"></i> Supprimer</button>';
                newRow += '</td>';
                newRow += '</tr>';
                $('#tableData tbody').append(newRow);
            }
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.responseJSON.message;
            $('#errorModal .modal-body p').text(errorMessage);
            $('#errorModal').modal('show');
        }
    });
}

// Function to edit a journal entry
// Function to edit a journal entry
function editJournalEntry(id) {
    $.get('/journals/' + id, function(response) {
        $('#journal_id').val(response.id);
        $('#Date').val(response.Date);
        $('#Numero_de_Compte').val(response.Numero_de_Compte);
        $('#Libelle').val(response.Libelle);
        $('#Montant_Debit').val(response.Montant_Debit);
        $('#Montant_Credit').val(response.Montant_Credit);
        $('#Code_Journal').val(response.Code_Journal);
        $('#formModalTitle').text('Modifier une entrée');
        $('#journalFormModal').modal('show');
    }).fail(function(xhr, status, error) {
        var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Erreur lors de la récupération des données';
        $('#errorModal .modal-body p').text(errorMessage);
        $('#errorModal').modal('show');
    });
}


// Function to show the confirmation modal and set the delete button's onclick handler
function confirmDeleteJournalEntry(id) {
    $('#confirmModal').modal('show');
    $('#deleteButton').off('click').on('click', function() {
        deleteJournalEntry(id);
    });
}

// Function to delete a journal entry
function deleteJournalEntry(id) {
    $.ajax({
        url: '/journals/' + id,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken()
        },
        success: function(response) {
            $('#confirmModal').modal('hide');
            $('#row_' + id).remove();
            $('#successModal').modal('show');
        },
        error: function(xhr, status, error) {
            var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'Erreur lors de la suppression des données';
            $('#errorModal .modal-body p').text(errorMessage);
            $('#errorModal').modal('show');
        }
    });
}

// Function to export table data to Excel
function exportTableToExcel(tableID, filename = '') {
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename ? filename + '.xls' : 'export_excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    } else {
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        // Triggering the function
        downloadLink.click();
    }
}

// Function to export table data to PDF
function exportTableToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text('Journal des Opérations', 14, 16);
    doc.autoTable({
        html: '#tableData',
        startY: 20,
        headStyles: { fillColor: [40, 40, 40] },
        alternateRowStyles: { fillColor: [240, 240, 240] },
        tableLineColor: [0, 0, 0],
        tableLineWidth: 0.1,
        margin: { top: 30 },
    });

    doc.save('journal.pdf');
}

// Function to clear form fields
function clearFormFields() {
    $('#journal_id').val('');
    $('#Date').val('');
    $('#Numero_de_Compte').val('');
    $('#Libelle').val('');
    $('#Montant_Debit').val('');
    $('#Montant_Credit').val('');
    $('#Code_Journal').val('');
    $('#formModalTitle').text('Ajouter une entrée');
}

    </script>
</body>
</html>
