@extends('adminlte::page')

@section('content')

<div class="container">
    <h1>Liste des Bons d'Entrée</h1>

    <a href="{{ route('stock_entrer.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Ajouter un Bon d'Entrée
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro d'Entrée</th>
                    <th>Date</th>
                    <th>Code Matériel</th>
                    <th>Récepteur</th>
                    <th>Émetteur</th>
                    <th>Observation</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stockEntrers as $stockEntrer)
                    <tr>

                        <td>{{ $stockEntrer->entry_numero }}</td>
                        <td>{{ \Carbon\Carbon::parse($stockEntrer->date)->format('d-m-Y') }}</td>
                        <td>{{ $stockEntrer->article->libelle }}</td>
                        <td>{{ $stockEntrer->recepteur ? $stockEntrer->recepteur->nom : 'Inconnu' }}</td>
                        <td>{{ $stockEntrer->emetteur ? $stockEntrer->emetteur->nom : 'Inconnu' }}</td>
                        <td>{{ $stockEntrer->observation }}</td>
                        <td>{{ $stockEntrer->quantite }}</td>
                        <td>
                            <a href="{{ route('stock_entrer.show', $stockEntrer->entry_id) }}" class="btn btn-info view-detail" data-entry-id="{{ $stockEntrer->entry_id }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('stock_entrer.edit', $stockEntrer->entry_id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('stock_entrer.destroy', $stockEntrer->entry_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon d\'entrée ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal pour la vue détaillée -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Détails du Bon d'Entrée</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Numéro d'Entrée:</strong> <span id="entryNumero"></span></p>
                <p><strong>Date:</strong> <span id="entryDate"></span></p>
                <p><strong>Code Matériel:</strong> <span id="entryArticle"></span></p>
                <p><strong>Récepteur:</strong> <span id="entryRecepteur"></span></p>
                <p><strong>Émetteur:</strong> <span id="entryEmetteur"></span></p>
                <p><strong>Observation:</strong> <span id="entryObservation"></span></p>
                <p><strong>Quantité:</strong> <span id="entryQuantite"></span></p>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .table {
            font-size: 14px;
        }

        .btn {
            font-size: 12px;
            padding: 8px;
        }
    }
</style>

    @section('js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        });
    </script>
@endsection
</script>

@endsection
