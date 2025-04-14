
@extends('layouts.navuser')

@section('content')
<div class="container">
    <h1>Liste des Bons d'Entrée</h1>

    <a href="{{ route('bon-entree.create') }}" class="btn btn-success mb-3">
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
        <table class="table table-striped" id="dataTable">
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
                        <a href="{{ route('bon-entree.show', $stockEntrer->entry_id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('bon-entree.edit', $stockEntrer->entry_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('bon-entree.destroy', $stockEntrer->entry_id) }}" method="POST" style="display:inline;">
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
