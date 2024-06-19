<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Journal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: teal;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h1 {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            background-color: teal;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0097a7;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
        }

        .modal-content label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .modal-content input {
            margin-bottom: 15px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #modalSaveButton {
            background-color: teal;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-end;
        }

        #modalSaveButton:hover {
            background-color: #FFC312;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-book"></i> Journal</h1>
        <button onclick="openModal()"><i class="fas fa-plus"></i> Ajouter Ligne</button>
        <table id="journal">
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
            <tbody id="journalSection">
                <!-- Journal entries will be dynamically added here -->
            </tbody>
            <tfoot>
                <tr>
                    <td>Total Débit</td>
                    <td id="totalDebit"></td>
                    <td>Total Crédit</td>
                    <td id="totalCredit"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle"><i class="fas fa-edit"></i> Ajouter / Modifier Ligne</h2>
            <span class="close" onclick="closeModal()">&times;</span>
            <form id="modalForm">
                <input type="hidden" id="journalId">
                <label for="compteDebit">N° Compte Débit</label>
                <input type="text" id="compteDebit" name="compteDebit" required>
                <label for="compteCredit">N° Compte Crédit</label>
                <input type="text" id="compteCredit" name="compteCredit" required>
                <label for="emplois">Emplois</label>
                <input type="text" id="emplois" name="emplois" required>
                <label for="date">Date</label>
                <input type="date" id="date" name="date" required>
                <label for="ressources">Ressources</label>
                <input type="text" id="ressources" name="ressources" required>
                <label for="montantDebit">Montant Débit</label>
                <input type="number" id="montantDebit" name="montantDebit" required>
                <label for="montantCredit">Montant Crédit</label>
                <input type="number" id="montantCredit" name="montantCredit">
                <button type="button" id="modalSaveButton" onclick="saveModalData()"><i class="fas fa-save"></i> Sauvegarder</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchJournals();
        });

        let journalData = @json($journals); // Assuming you pass $journals from your Laravel controller

        function openModal(id = null) {
            document.getElementById("modal").style.display = "block";
            document.getElementById("modalForm").reset();
            if (id) {
                const journal = journalData.find(j => j.id === id);
                document.getElementById("journalId").value = journal.id;
                document.getElementById("compteDebit").value = journal.compteDebit;
                document.getElementById("compteCredit").value = journal.compteCredit;
                document.getElementById("emplois").value = journal.emplois;
                document.getElementById("date").value = journal.date;
                document.getElementById("ressources").value = journal.ressources;
                document.getElementById("montantDebit").value = journal.montantDebit;
                document.getElementById("montantCredit").value = journal.montantCredit;
                document.getElementById("modalTitle").innerHTML = "<i class='fas fa-edit'></i> Modifier Ligne";
            } else {
                document.getElementById("modalTitle").innerHTML = "<i class='fas fa-plus'></i> Ajouter Ligne";
            }
        }

        function closeModal() {
            document.getElementById("modal").style.display = "none";
            document.getElementById("modalForm").reset();
        }

        function fetchJournals() {
            updateJournalSection();
        }

        function saveModalData() {
            const id = document.getElementById("journalId").value;
            const formData = new FormData(document.getElementById("modalForm"));
            const journal = {};
            formData.forEach((value, key) => journal[key] = value);

            let url = '/journals';
            let method = 'POST';

            if (id) {
                url = `/journals/${id}`;
                method = 'PUT';
                journal._method = 'PUT'; // Add this line to spoof the PUT method
            }

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(journal)
            })
            .then(response => response.json())
            .then(data => {
                closeModal();
                if (!id) {
                    journal.id = data.id; // Assuming the response returns the new journal ID
                    journalData.push(journal);
                } else {
                    const index = journalData.findIndex(j => j.id === parseInt(id));
                    journalData[index] = journal;
                }
                updateJournalSection();
            })
            .catch(error => console.error('Error:', error));
        }

        function deleteRow(id) {
            if (confirm('Are you sure you want to delete this entry?')) {
                fetch(`/journals/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    journalData = journalData.filter(j => j.id !== id);
                    updateJournalSection();
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function updateJournalSection() {
            const journalSection = document.getElementById('journalSection');
            journalSection.innerHTML = '';
            journalData.forEach(journal => {
                journalSection.innerHTML += `
                    <tr>
                        <td>${journal.compteDebit}</td>
                        <td>${journal.compteCredit}</td>
                        <td>${journal.emplois}</td>
                        <td>${journal.date}</td>
                        <td>${journal.ressources}</td>
                        <td>${journal.montantDebit}</td>
                        <td>${journal.montantCredit}</td>
                        <td>
                            <button onclick="openModal(${journal.id})"><i class="fas fa-edit"></i> Modifier</button>
                            <button onclick="deleteRow(${journal.id})"><i class="fas fa-trash"></i> Supprimer</button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById('totalDebit').innerText = journalData.reduce((sum, journal) => sum + parseFloat(journal.montantDebit), 0);
            document.getElementById('totalCredit').innerText = journalData.reduce((sum, journal) => sum + parseFloat(journal.montantCredit), 0);
        }
    </script>
</body>
</html>

