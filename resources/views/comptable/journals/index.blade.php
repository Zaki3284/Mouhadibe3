<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journal Table</title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap for modal and button styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Styles for custom elements -->
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
        .modal-dialog {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <h2>Enregistrement des opérations réalisées par l’entreprise BETA dans un journal :</h2>

    <div class="btn-group" role="group">
        <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Imprimer</button>
        <button onclick="exportTableToExcel('tableData', 'journal')" class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
        <button onclick="exportTableToPDF()" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
        <button onclick="showAddForm()" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</button>
    </div>

    <!-- Success and Error Messages - Modal -->
    <div id="successModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Opération réussie!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>L'opération a été effectuée avec succès.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div id="errorModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Erreur lors de l'opération!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Une erreur est survenue lors du traitement de votre demande.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
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
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="text" class="form-control" id="date" name="date" placeholder="JJ/MM">
                        </div>
                        <div class="form-group">
                            <label for="debitAccount">N° Compte de Piece:</label>
                            <input type="text" class="form-control" id="debitAccount" name="debitAccount">
                        </div>
                        <div class="form-group">
                            <label for="creditAccount">N° Compte:</label>
                            <input type="text" class="form-control" id="creditAccount" name="creditAccount">
                        </div>
                        <div class="form-group">
                            <label for="emplois">Libellé:</label>
                            <input type="text" class="form-control" id="emplois" name="emplois">
                        </div>
                        <div class="form-group">
                            <label for="montantDebit">Montant Débit:</label>
                            <input type="text" class="form-control" id="montantDebit" name="montantDebit">
                        </div>
                        <div class="form-group">
                            <label for="montantCredit">Montant Crédit:</label>
                            <input type="text" class="form-control" id="montantCredit" name="montantCredit">
                        </div>
                        <div class="form-group">
                            <label for="journalCode">Code Journal:</label>
                            <select class="form-control" id="journalCode">
                                <option value="Achet">Achet</option>
                                <option value="Vent">Vent</option>
                                <option value="General">General</option>
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

    <table id="tableData" class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>N° Compte Piece</th>
                <th>N° Compte</th>
                <th>Libellé</th>
                <th>Montant Débit</th>
                <th>Montant Crédit</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample row (you can dynamically populate rows using JavaScript) -->
            <tr>
                <td>08/10</td>
                <td>210</td>
                <td>550</td>
                <td>Terrains</td>
                <td>3 000 000</td>
                <td></td>
                <td>
                    <button onclick="editEntry(this)" class="btn btn-info"><i class="fas fa-edit"></i> Modifier</button>
                    <button onclick="deleteEntry(this)" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAUX</td>
                <td>11 125 000</td>
                <td>11 125 000</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Scripts -->
    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

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

        function exportTableToPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.autoTable({ html: '#tableData' });
            doc.save('journal.pdf');
        }

        function showAddForm() {
            document.getElementById("journalForm").reset();
            document.getElementById("formModalTitle").innerText = "Ajouter une entrée";
            $('#journalFormModal').modal('show');
        }

        function saveJournalEntry() {
            // Example validation - you can add your own validation logic here
            var isValid = true;

            // Example: Check if required fields are filled
            var date = document.getElementById("date").value.trim();
            var debitAccount = document.getElementById("debitAccount").value.trim();
            var creditAccount = document.getElementById("creditAccount").value.trim();
            var emplois = document.getElementById("emplois").value.trim();
            var montantDebit = document.getElementById("montantDebit").value.trim();
            var montantCredit = document.getElementById("montantCredit").value.trim();

            if (date === '' || debitAccount === '' || creditAccount === '' || emplois === '' || montantDebit === '' || montantCredit === '') {
                isValid = false;
            }

            if (isValid) {
                // Add your logic here to save the form data and update the table
                // Example: create a new row in the table with entered data
                var table = document.getElementById("tableData").getElementsByTagName('tbody')[0];
                var newRow = table.insertRow();

                var dateCell = newRow.insertCell(0);
                var debitAccountCell = newRow.insertCell(1);
                var creditAccountCell = newRow.insertCell(2);
                var emploisCell = newRow.insertCell(3);
                var montantDebitCell = newRow.insertCell(4);
                var montantCreditCell = newRow.insertCell(5);
                var actionsCell = newRow.insertCell(6);

                dateCell.innerText = date;
                debitAccountCell.innerText = debitAccount;
                creditAccountCell.innerText = creditAccount;
                emploisCell.innerText = emplois;
                montantDebitCell.innerText = montantDebit;
                montantCreditCell.innerText = montantCredit;
                actionsCell.innerHTML = '<button onclick="editEntry(this)" class="btn btn-info"><i class="fas fa-edit"></i> Modifier</button> ' +
                                        '<button onclick="deleteEntry(this)" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</button>';

                $('#journalFormModal').modal('hide'); // Hide modal after adding entry
                $('#successModal').modal('show'); // Show success modal
            } else {
                $('#errorModal').modal('show'); // Show error modal if validation fails
            }
        }

        function editEntry(button) {
            var row = button.closest("tr");
            var cells = row.getElementsByTagName("td");

            // Populate form fields with row data for editing
            document.getElementById("date").value = cells[0].innerText;
            document.getElementById("debitAccount").value = cells[1].innerText;
            document.getElementById("creditAccount").value = cells[2].innerText;
            document.getElementById("emplois").value = cells[3].innerText;
            document.getElementById("montantDebit").value = cells[4].innerText;
            document.getElementById("montantCredit").value = cells[5].innerText;

            document.getElementById("formModalTitle").innerText = "Modifier une entrée";
            $('#journalFormModal').modal('show'); // Show modal for editing
        }

        function deleteEntry(button) {
            var row = button.closest("tr");
            row.remove(); // Remove row from table
        }
    </script>
    <!-- jspdf and jspdf-autotable for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.15/jspdf.plugin.autotable.min.js"></script>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
    // Function to delete a table row
    function deleteEntry(button) {
        var row = button.closest("tr");

        // Ask for confirmation before deleting
        if (confirm("Êtes-vous sûr de vouloir supprimer cette entrée ?")) {
            row.remove(); // Remove row from table

            // Hide any success or error messages if displayed
            $('#successModal').modal('hide');
            $('#errorModal').modal('hide');
        }
    }

    // Other functions remain unchanged from your previous code
    // Make sure you have included all necessary scripts and styles in your HTML
</script>
