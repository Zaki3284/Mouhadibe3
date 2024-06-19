<!-- resources/views/accounts/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Livre et Balance</title>
    <link rel="stylesheet" href="{{ asset('css/GrandLivre.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <h1>Grand Livre des Comptes de l'Entreprise BETA</h1>

    <div class="form">
        <h2>Ajouter un compte</h2>
        <form action="{{ route('accounts.store') }}" method="POST">
            @csrf
            <label for="new-account-name">Nom du compte:</label>
            <input type="text" id="new-account-name" name="name" placeholder="Ex: 210 : Terrains" required>
            <button type="submit"><i class="fas fa-plus"></i> Créer Compte</button>
        </form>
    </div>

    <div id="accounts-container" class="accounts-container">
        @foreach($accounts as $account)
            <div class="account-table" id="account-{{ $account->id }}">
                <h2>{{ $account->name }}</h2>
                <form action="{{ route('accounts.update', $account->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $account->name }}" required>
                    <button type="submit" class="update"><i class="fas fa-edit"></i> Mettre à jour</button>
                </form>
                <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete"><i class="fas fa-trash"></i> Supprimer</button>
                </form>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Débit</th>
                            <th>Crédit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account->operations as $operation)
                            <tr>
                                <td>{{ $operation->date }}</td>
                                <td>{{ $operation->description }}</td>
                                <td>{{ $operation->debit }}</td>
                                <td>{{ $operation->credit }}</td>
                                <td>
                                    <button class="edit" onclick="openModal('{{ $operation->id }}', '{{ $operation->account_id }}', '{{ $operation->date }}', '{{ $operation->description }}', '{{ $operation->debit }}', '{{ $operation->credit }}')"><i class="fas fa-edit"></i> Modifier</button>
                                    <form action="{{ route('operations.destroy', $operation->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete"><i class="fas fa-trash"></i> Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="add-operation" onclick="openModal(null, {{ $account->id }})"><i class="fas fa-plus"></i> Ajouter Opération</button>
            </div>
        @endforeach
    </div>

    <div class="totals">
        <h2><i class="fas fa-balance-scale"></i> Balance</h2>
        <div>Total Débit: <span id="total-debit">{{ $accounts->sum(fn($account) => $account->operations->sum('debit')) }}</span></div>
        <div>Total Crédit: <span id="total-credit">{{ $accounts->sum(fn($account) => $account->operations->sum('credit')) }}</span></div>
    </div>

    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-title">Ajouter Opération</h2>
            <form id="operation-form" action="{{ route('operations.store') }}" method="POST">
                @csrf
                <input type="hidden" id="modal-operation-id">
                <input type="hidden" id="modal-account-id" name="account_id">
                <label for="modal-date">Date:</label>
                <input type="date" id="modal-date" name="date" required>
                <label for="modal-description">Description:</label>
                <input type="text" id="modal-description" name="description" placeholder="Description de l'opération" required>
                <label for="modal-debit">Débit:</label>
                <input type="number" id="modal-debit" name="debit" step="0.01" placeholder="0.00">
                <label for="modal-credit">Crédit:</label>
                <input type="number" id="modal-credit" name="credit" step="0.01" placeholder="0.00">
                <button type="submit"><i class="fas fa-save"></i> Enregistrer</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(operationId, accountId, date = '', description = '', debit = '', credit = '') {
            const modalTitle = operationId ? 'Modifier Opération' : 'Ajouter Opération';
            document.getElementById('modal-title').textContent = modalTitle;

            document.getElementById('modal-operation-id').value = operationId ? operationId : '';
            document.getElementById('modal-account-id').value = accountId;
            document.getElementById('modal-date').value = date;
            document.getElementById('modal-description').value = description;
            document.getElementById('modal-debit').value = debit;
            document.getElementById('modal-credit').value = credit;

            if (operationId) {
                const form = document.getElementById('operation-form');
                form.action = `/operations/${operationId}`;
                form.method = 'POST';
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                form.appendChild(methodInput);
            } else {
                document.getElementById('operation-form').action = '{{ route('operations.store') }}';
                document.getElementById('operation-form').method = 'POST';
                const existingMethodInput = document.querySelector('input[name="_method"]');
                if (existingMethodInput) existingMethodInput.remove();
            }

            document.getElementById('modal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }
    </script>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

</body>
</html>
