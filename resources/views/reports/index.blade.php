<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports Journaliers</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            margin-bottom: 10px;
        }
        .modal-dialog {
            width: 100%;
            max-width: 800px;
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
    <div class="container">
        <h1>Rapports Journaliers</h1>

        <!-- Form for creating a daily report -->
        <form action="{{ route('reports.create') }}" method="POST" id="reportForm">
            @csrf
            <div class="form-group">
                <label for="reportDate">Date:</label>
                <input type="date" class="form-control" id="reportDate" name="date" required>
            </div>
            <div class="form-group">
                <label for="comments">Commentaires:</label>
                <textarea class="form-control" id="comments" name="comments" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Créer Rapport</button>
        </form>

        <!-- Table to display reports -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Commentaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->date }}</td>
                        <td>{{ $report->comments }}</td>
                        <td>
                            <div class="btn-group">
                                <!-- Export PDF button -->
                                <a href="{{ route('reports.export', $report->id) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exporter PDF</a>

                                <!-- Edit button -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal{{ $report->id }}">
                                  <i class="fas fa-sync-alt"></i> Mise a jour
                              </button>
                              
                                
                                <!-- Delete button -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $report->id }}"><i class="fas fa-trash"></i> Supprimer</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $report->id }}">Modifier le rapport du {{ $report->date }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('reports.update', $report->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="editDate">Date:</label>
                                            <input type="date" class="form-control" id="editDate" name="date" value="{{ $report->date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="editComments">Commentaires:</label>
                                            <textarea class="form-control" id="editComments" name="comments" required>{{ $report->comments }}</textarea>
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

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $report->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $report->id }}">Confirmer la suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('reports.delete', $report->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body" style="color: teal">
                                        Êtes-vous sûr de vouloir supprimer le rapport du {{ $report->date }} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{ route('comptable.dashboard') }}" class="back-button"><i class="fas fa-home"></i> Retour à la page comptable dashboard</a>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
