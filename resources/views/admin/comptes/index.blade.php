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
                    <tr data-id="{{ $compte->id }}">
                        <td>{{ $compte->nom }}</td>
                        <td>{{ $compte->type }}</td>
                        <td>{{ $compte->classe }}</td>
                        <td>{{ $compte->numero_compte }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editCompte" data-id="{{ $compte->id }}" data-toggle="modal" data-target="#editCompteModal">Modifier</button>
                            <button class="btn btn-danger btn-sm deleteCompte" data-id="{{ $compte->id }}">Supprimer</button>
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
                        <button type="submit" class="btn btn-primary">Modifier Compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel"><i class="fas fa-check-circle text-success"></i> Succès</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="successModalBody">
                    <!-- Success message will appear here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-times-circle text-danger"></i> Erreur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="errorModalBody">
                    <!-- Error message will appear here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Delete Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="fas fa-exclamation-triangle text-warning"></i> Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce compte ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Axios for making AJAX requests -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to handle form submission for creating a compte
            $('#compteForm').submit(function(event) {
                event.preventDefault();
                let formData = $(this).serialize();

                axios.post('/comptes', formData)
                    .then(response => {
                        $('#createCompteModal').modal('hide');
                        $('#compteForm')[0].reset(); // Clear form inputs
                        // Append new row to the table
                        $('#comptesList').append(`
                            <tr data-id="${response.data.id}">
                                <td>${response.data.nom}</td>
                                <td>${response.data.type}</td>
                                <td>${response.data.classe}</td>
                                <td>${response.data.numero_compte}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm editCompte" data-id="${response.data.id}" data-toggle="modal" data-target="#editCompteModal">Modifier</button>
                                    <button class="btn btn-danger btn-sm deleteCompte" data-id="${response.data.id}">Supprimer</button>
                                </td>
                            </tr>
                        `);

                        // Show success message
                        $('#successModalBody').html(`<p>Compte ajouté avec succès.</p>`);
                        $('#successModal').modal('show');
                    })
                    .catch(error => {
                        // Show error message
                        $('#errorModalBody').html(`<p>Une erreur s'est produite lors de l'ajout du compte. Veuillez réessayer.</p>`);
                        $('#errorModal').modal('show');
                    });
            });

            // Function to handle click event on edit button
            $('#comptesList').on('click', '.editCompte', function() {
                let compteId = $(this).data('id');

                // Fetch compte details and fill in the edit modal form
                axios.get(`/comptes/${compteId}`)
                    .then(response => {
                        $('#editCompteId').val(response.data.id);
                        $('#editNom').val(response.data.nom);
                        $('#editType').val(response.data.type);
                        $('#editClasse').val(response.data.classe);
                        $('#editNumeroCompte').val(response.data.numero_compte);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            });

            // Function to handle form submission for editing a compte
            $('#editCompteForm').submit(function(event) {
                event.preventDefault();
                let compteId = $('#editCompteId').val();
                let formData = $(this).serialize();

                axios.put(`/comptes/${compteId}`, formData)
                    .then(response => {
                        $('#editCompteModal').modal('hide');

                        // Update the corresponding row in the table
                        let editedRow = `
                            <td>${response.data.nom}</td>
                            <td>${response.data.type}</td>
                            <td>${response.data.classe}</td>
                            <td>${response.data.numero_compte}</td>
                            <td>
                                <button class="btn btn-warning btn-sm editCompte" data-id="${response.data.id}" data-toggle="modal" data-target="#editCompteModal">Modifier</button>
                                <button class="btn btn-danger btn-sm deleteCompte" data-id="${response.data.id}">Supprimer</button>
                            </td>
                        `;
                        $(`#comptesList tr[data-id="${response.data.id}"]`).html(editedRow);

                        // Show success message
                        $('#successModalBody').html(`<p>Compte modifié avec succès.</p>`);
                        $('#successModal').modal('show');
                    })
                    .catch(error => {
                        // Show error message
                        $('#errorModalBody').html(`<p>Une erreur s'est produite lors de la modification du compte. Veuillez réessayer.</p>`);
                        $('#errorModal').modal('show');
                    });
            });

            // Function to handle click event on delete button
            $('#comptesList').on('click', '.deleteCompte', function() {
                let compteId = $(this).data('id');

                // Show confirmation modal
                $('#confirmDeleteModal').modal('show');

                // Handle delete action upon confirmation
                $('#confirmDeleteBtn').on('click', function() {
                    axios.delete(`/comptes/${compteId}`)
                        .then(response => {
                            // Remove the deleted row from the table
                            $(`#comptesList tr[data-id="${compteId}"]`).remove();
                            $('#confirmDeleteModal').modal('hide');

                            // Show success message
                            $('#successModalBody').html(`<p>Compte supprimé avec succès.</p>`);
                            $('#successModal').modal('show');
                        })
                        .catch(error => {
                            $('#confirmDeleteModal').modal('hide');

                            // Show error message
                            $('#errorModalBody').html(`<p>Une erreur s'est produite lors de la suppression du compte. Veuillez réessayer.</p>`);
                            $('#errorModal').modal('show');
                        });
                });
            });
        });
    </script>
</body>
</html>
