
<div class="container">
    <h1><i class="fas fa-chart-line"></i> Compte de Résultat</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table id="compteResultat" class="table">
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
                    <button class="btn btn-primary" onclick="editModal({{ $compteDeResultat }})"><i class="fas fa-edit"></i> Éditer</button>
                    <form action="{{ route('compte-resultat.destroy', $compteDeResultat->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Supprimer</button>
                    </form>
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

    <button onclick="openModal()" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter Ligne</button>
</div>

<!-- Modal -->
<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"><i class="fas fa-edit"></i> Ajouter / Modifier Ligne</h2>
        <form id="modalForm" method="POST">
            @csrf
            <input type="hidden" id="modalMethod" name="_method" value="POST">

            <label for="charge">Charge</label>
            <input type="text" id="charge" name="charge" required>

            <label for="montantCharge">Montant Charge</label>
            <input type="number" id="montantCharge" name="montant_charge" oninput="updateTotals()" required>

            <label for="produit">Produit</label>
            <input type="text" id="produit" name="produit" required>

            <label for="montantProduit">Montant Produit</label>
            <input type="number" id="montantProduit" name="montant_produit" oninput="updateTotals()">

            <button type="submit" id="modalSaveButton" class="btn btn-primary"><i class="fas fa-save"></i> Sauvegarder</button>
        </form>
    </div>
</div>

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
        // Update totals logic if needed
    }
</script>



@section('styles')
<style>
    body {
        font-family: Arial, sans-serif;
        color: teal;
        /* Sets the default font family and color for the entire document */
    }

    .container {
        width: 80%;
        margin: auto;
        margin-top: 20px;
        /* Centers the content with 80% width and adds margin */
    }

    h1 {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Flexbox styles for the header, aligns items horizontally with spacing */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        /* Makes the table full width, collapses borders, adds top margin */
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
        /* Common styles for table cells and headers */
    }

    th {
        background-color: #f2f2f2;
        /* Background color for table headers */
    }

    button {
        background-color: teal;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        margin-top: 10px;
        /* Button styles */
    }

    button:hover {
        background-color: #FFC312;
        /* Button hover background color */
    }

    button i {
        margin-right: 5px;
        /* Adds margin between icon and text inside buttons */
    }

    input {
        width: 90%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        /* Input field styles */
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
        /* Modal styles - hidden by default, positioned fixed with overlay */
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        /* Modal content styles */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
        /* Close button styles */
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        /* Close button hover and focus styles */
    }

    .modal-content form {
        display: flex;
        flex-direction: column;
        /* Styles for form inside modal content */
    }

    .modal-content label {
        margin-bottom: 5px;
        font-weight: bold;
        /* Label styles */
    }

    .modal-content input {
        margin-bottom: 15px;
        /* Input styles inside modal */
    }

    #modalSaveButton {
        background-color: teal;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        align-self: flex-end;
        /* Save button styles */
    }

    #modalSaveButton:hover {
        background-color: #FFC312;
        /* Save button hover background color */
    }

</style>

