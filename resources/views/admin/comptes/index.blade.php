<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Comptable</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
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
            display: inline-block; /* Set display to inline-block to align buttons horizontally */
        }
        .btn-group button {
            margin-right: 10px; /* Optional: Add margin between buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Plan Comptable</h1>

        <!-- Button to toggle the create modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#createCompteModal">
            Ajouter un Compte
        </button>

        <!-- Table to display existing comptes -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Classe</th>
                    <th>Numéro de Compte</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="comptesList">
                @foreach ($comptes as $compte)
            <tr>
                <td>{{ $compte->nom }}</td>
                <td>{{ $compte->type }}</td>
                <td>{{ $compte->classe }}</td>
                <td>{{ $compte->numero_compte }}</td>
                <td>
                    <!-- Include your actions here (edit, delete buttons) -->
                    <button><i class="fas fa-edit"></i>Edit</button>
                    <button><i class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Create Compte Modal -->
    <div class="modal fade" id="createCompteModal" tabindex="-1" role="dialog" aria-labelledby="createCompteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCompteModalLabel">Ajouter un Compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="compteForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="">Sélectionner un type</option>
                                <option value="Actif">Actif</option>
                                <option value="Passif">Passif</option>
                                <option value="Capitaux propres">Capitaux propres</option>
                                <option value="Revenu">Revenu</option>
                                <option value="Dépense">Dépense</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="classe">Classe:</label>
                            <select class="form-control" id="classe" name="classe" required>
                                <option value="">Sélectionner une classe</option>
                                <option value="Classe 1 : Comptes de Capitaux">Classe 1 : Comptes de Capitaux</option>
                                <option value="Classe 2 : Comptes d'Immobilisations">Classe 2 : Comptes d'Immobilisations</option>
                                <option value="Classe 3 : Comptes de Stocks et en-cours">Classe 3 : Comptes de Stocks et en-cours</option>
                                <option value="Classe 4 : Comptes de Tiers">Classe 4 : Comptes de Tiers</option>
                                <option value="Classe 5 : Comptes financiers">Classe 5 : Comptes financiers</option>
                                <option value="Classe 6 : Comptes de charges">Classe 6 : Comptes de charges</option>
                                <option value="Classe 7 : Comptes de produits">Classe 7 : Comptes de produits</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numero_compte">Numéro de Compte:</label>
                            <input type="text" class="form-control" id="numero_compte" name="numero_compte" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Ajouter Compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Compte Modal -->
    <div class="modal fade" id="editCompteModal" tabindex="-1" role="dialog" aria-labelledby="editCompteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCompteModalLabel">Modifier le Compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCompteForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editCompteId" name="id">
                        <div class="form-group">
                            <label for="editNom">Nom:</label>
                            <input type="text" class="form-control" id="editNom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="editType">Type:</label>
                            <select class="form-control" id="editType" name="type" required>
                                <option value="">Sélectionner un type</option>
                                <option value="Actif">Actif</option>
                                <option value="Passif">Passif</option>
                                <option value="Capitaux propres">Capitaux propres</option>
                                <option value="Revenu">Revenu</option>
                                <option value="Dépense">Dépense</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editClasse">Classe:</label>
                            <select class="form-control" id="editClasse" name="classe" required>
                                <option value="">Sélectionner une classe</option>
                                <option value="Classe 1 : Comptes de Capitaux">Classe 1 : Comptes de Capitaux</option>
                                <option value="Classe 2 : Comptes d'Immobilisations">Classe 2 : Comptes d'Immobilisations</option>
                                <option value="Classe 3 : Comptes de Stocks et en-cours">Classe 3 : Comptes de Stocks et en-cours</option>
                                <option value="Classe 4 : Comptes de Tiers">Classe 4 : Comptes de Tiers</option>
                                <option value="Classe 5 : Comptes financiers">Classe 5 : Comptes financiers</option>
                                <option value="Classe 6 : Comptes de charges">Classe 6 : Comptes de charges</option>
                                <option value="Classe 7 : Comptes de produits">Classe 7 : Comptes de produits</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editNumeroCompte">Numéro de Compte:</label>
                            <input type="text" class="form-control" id="editNumeroCompte" name="numero_compte" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Axios (for Ajax requests) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle form submission for creating a new Compte
            $('#compteForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();

                axios.post('{{ route('comptes.store') }}', formData)
                    .then(response => {
                        let compte = response.data.compte;
                        // Append new row to table
                        let newRow = `<tr data-id="${compte.id}">
                                        <td>${compte.nom}</td>
                                        <td>${compte.type}</td>
                                        <td>${compte.classe}</td>
                                        <td>${compte.numero_compte}</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm editCompte" data-id="${compte.id}" data-toggle="modal" data-target="#editCompteModal">Modifier</button>
                                            <button class="btn btn-danger btn-sm deleteCompte" data-id="${compte.id}">Supprimer</button>
                                        </td>
                                    </tr>`;
                        $('#comptesList').append(newRow);

                        // Clear form fields and close modal
                        $('#compteForm').trigger('reset');
                        $('#createCompteModal').modal('hide');
                    })
                    .catch(error => {
                        alert('Une erreur s\'est produite. Veuillez réessayer.');
                    });
            });

            // Handle form submission for editing a Compte
            $('#editCompteForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();
                let compteId = $('#editCompteId').val();

                axios.put(`/comptes/${compteId}`, formData)
                    .then(response => {
                        let updatedCompte = response.data.compte;
                        // Update existing row in the table
                        let editedRow = `<tr data-id="${updatedCompte.id}">
                                            <td>${updatedCompte.nom}</td>
                                            <td>${updatedCompte.type}</td>
                                            <td>${updatedCompte.classe}</td>
                                            <td>${updatedCompte.numero_compte}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm editCompte" data-id="${updatedCompte.id}" data-toggle="modal" data-target="#editCompteModal">Modifier</button>
                                                <button class="btn btn-danger btn-sm deleteCompte" data-id="${updatedCompte.id}">Supprimer</button>
                                            </td>
                                        </tr>`;
                        $(`#comptesList tr[data-id="${updatedCompte.id}"]`).replaceWith(editedRow);

                        // Close the modal
                        $('#editCompteModal').modal('hide');

                        alert('Compte mis à jour avec succès.');
                    })
                    .catch(error => {
                        alert('Une erreur s\'est produite lors de la mise à jour du compte. Veuillez réessayer.');
                    });
            });

            // Populate edit modal fields when clicking edit button
            $('#comptesList').on('click', '.editCompte', function() {
                let compteId = $(this).data('id');

                axios.get(`/comptes/${compteId}/edit`)
                    .then(response => {
                        let compte = response.data.compte;

                        // Populate form fields with the fetched data
                        $('#editCompteId').val(compte.id);
                        $('#editNom').val(compte.nom);
                        $('#editType').val(compte.type);
                        $('#editClasse').val(compte.classe);
                        $('#editNumeroCompte').val(compte.numero_compte);

                        // Show the edit modal
                        $('#editCompteModal').modal('show');
                    })
                    .catch(error => {
                        alert('Une erreur s\'est produite lors du chargement des données pour la modification. Veuillez réessayer.');
                    });
            });

            // Example of handling delete button (Ajax request)
            $('#comptesList').on('click', '.deleteCompte', function() {
                let compteId = $(this).data('id');

                axios.delete(`/comptes/${compteId}`)
                    .then(response => {
                        // Remove the deleted row from the table
                        $(`#comptesList tr[data-id="${compteId}"]`).remove();
                        alert('Compte supprimé avec succès.');
                    })
                    .catch(error => {
                        alert('Une erreur s\'est produite lors de la suppression du compte. Veuillez réessayer.');
                    });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
