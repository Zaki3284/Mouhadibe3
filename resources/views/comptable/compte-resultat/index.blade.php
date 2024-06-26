<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Compte de Résultat</title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark/dark.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: teal;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #f2f2f2;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo img {
            height: 50px;
        }
        .title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .container {
            width: 80%;
            margin: auto;
            margin-top: 20px;
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
            margin-top: 10px;
        }
        button:hover {
            background-color: #FFC312;
        }
        button i {
            margin-right: 5px;
        }
        input {
            width: calc(100% - 20px); /* Adjusted for padding */
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
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
        i{
            color: #FFC312;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        </div>
        <div class="title">
            <h1><i class="fas fa-chart-line"></i> Compte de Résultat</h1>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <button onclick="openModal()"><i class="fas fa-plus"></i> Ajouter Ligne</button>

        <table id="compteResultat">
            <thead>
                <tr>
                    <th>Charges</th>
                    <th>Montant</th>
                    <th>Produits</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compteDeResultats as $compteDeResultat)
                <tr>
                    <td>{{ $compteDeResultat->charge }}</td>
                    <td>{{ $compteDeResultat->montant_charge }}</td>
                    <td>{{ $compteDeResultat->produit }}</td>
                    <td>{{ $compteDeResultat->montant_produit }}</td>
                    <td>
                        <button onclick="editModal({{ json_encode($compteDeResultat) }})"><i class="fas fa-edit"></i> Éditer</button>
                        <button onclick="deleteCompteResultat({{ $compteDeResultat->id }})"><i class="fas fa-trash-alt"></i> Supprimer</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total Charges</td>
                    <td id="totalCharges">0</td>
                    <td>Total Produits</td>
                    <td id="totalProduits">0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle"></h2>
            <form id="modalForm">
                @csrf
                <input type="hidden" id="modalMethod" name="_method" value="POST">

                <label for="charge">Charge</label>
                <input type="text" id="charge" name="charge" required>

                <label for="montantCharge">Montant Charge</label>
                <input type="number" id="montantCharge" name="montant_charge">

                <label for="produit">Produit</label>
                <input type="text" id="produit" name="produit" required>

                <label for="montantProduit">Montant Produit</label>
                <input type="number" id="montantProduit" name="montant_produit">

                <button type="submit" id="modalSaveButton">Sauvegarder</button>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function openModal() {
            document.getElementById('modal').style.display = 'block';
            document.getElementById('modalTitle').innerText = 'Ajouter Ligne';
            document.getElementById('modalForm').action = "{{ route('compte-resultat.store') }}";
            document.getElementById('modalMethod').value = 'POST';
            clearForm();
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function editModal(resultat) {
            document.getElementById('modal').style.display = 'block';
            document.getElementById('modalTitle').innerText = 'Modifier Ligne';
            document.getElementById('modalForm').action = `/compte-resultat/${resultat.id}`;
            document.getElementById('modalMethod').value = 'PUT';

            document.getElementById('charge').value = resultat.charge;
            document.getElementById('montantCharge').value = resultat.montant_charge;
            document.getElementById('produit').value = resultat.produit;
            document.getElementById('montantProduit').value = resultat.montant_produit;
        }

        function clearForm() {
            document.getElementById('charge').value = '';
            document.getElementById('montantCharge').value = '';
            document.getElementById('produit').value = '';
            document.getElementById('montantProduit').value = '';
        }

        function updateTotals() {
            let totalCharges = 0;
            let totalProduits = 0;

            document.querySelectorAll('#compteResultat tbody tr').forEach((row) => {
                let montantCharge = parseFloat(row.cells[1].innerText) || 0;
                let montantProduit = parseFloat(row.cells[3].innerText) || 0;

                totalCharges += montantCharge;
                totalProduits += montantProduit;
            });

            document.getElementById('totalCharges').innerText = totalCharges.toFixed(2);
            document.getElementById('totalProduits').innerText = totalProduits.toFixed(2);
        }

        document.getElementById('modalForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let url = form.getAttribute('action');
            let method = form.querySelector('input[name="_method"]').value || 'POST';

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success'
                    }).then(() => {
                        closeModal();
                        window.location.reload();
                    });
                } else if (data.error) {
                    Swal.fire({
                        title: 'Error!',
                        text: data.error,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing your request. Please try again.',
                    icon: 'error'
                });
            });
        });

        function deleteCompteResultat(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this compte de resultat!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/compte-resultat/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: data.message,
                                icon: 'success'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else if (data.error) {
                            Swal.fire({
                                title: 'Error!',
                                text: data.error,
                                icon: 'error'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again.',
                            icon: 'error'
                        });
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateTotals();
        });
    </script>
</body>
</html>
