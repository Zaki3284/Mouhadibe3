<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports Journaliers pour Admin</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Rapports Journaliers pour Admin</h1>

        <!-- Table to display admin reports -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Commentaires</th>
                    <th>Lu par Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adminReports as $adminReport)
                    <tr>
                        <td>{{ $adminReport->date }}</td>
                        <td>{{ $adminReport->comments }}</td>
                        <td>{{ $adminReport->read_by_admin ? 'Oui' : 'Non' }}</td>
                        <td>
                            <div class="btn-group">
                                <!-- Mark as read button -->
                                <form action="{{ route('admin_reports.markAsRead', $adminReport->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $adminReport->read_by_admin ? 'btn-success' : 'btn-danger' }}">
                                        <i class="fas fa-check"></i> 
                                        {{ $adminReport->read_by_admin ? 'Lu' : 'Marquer comme lu' }}
                                    </button>
                                </form>
                                <!-- Export to PDF button -->
                                <a href="{{ route('admin_reports.export', $adminReport->id) }}" class="btn btn-primary"><i class="fas fa-file-pdf"></i> Exporter PDF</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
