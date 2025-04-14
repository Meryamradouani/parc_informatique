@extends('layouts.navuser')

@section('content')
<div class="container">
    <h1>Liste des Bons de Sortie</h1>

    <a href="{{ route('bon-sortie.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Ajouter un Bon de Sortie
    </a>

    <table class="table">
        <thead>
            <tr>
                
                <th>Numéro de Série</th>
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
            @foreach($stockSorties as $sortie)
            <tr>

                <td>{{ $sortie->numero_serie }}</td>
                <td>{{ \Carbon\Carbon::parse($sortie->date)->format('d-m-Y') }}</td>
                <td>{{ $sortie->article ? $sortie->article->libelle : 'Inconnu' }}</td>
                <td>{{ $sortie->recepteur ? $sortie->recepteur->nom : 'Inconnu' }}</td>
                <td>{{ $sortie->emetteur ? $sortie->emetteur->nom : 'Inconnu' }}</td>
                <td>{{ $sortie->observation }}</td>
                <td>{{ $sortie->quantite }}</td>
                <td>
                    <a href="{{ route('bon-sortie.show', $sortie->sortie_id) }}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('bon-sortie.edit', $sortie->sortie_id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('bon-sortie.destroy', $sortie->sortie_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce bon de sortie ?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
