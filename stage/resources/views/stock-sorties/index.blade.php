@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Liste des Bons de Sortie</h1>

    <a href="{{ route('stock-sorties.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Ajouter un Bon de Sortie
    </a>

    <table id="sortiesTable" class="table">
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
                    <td>{{ $sortie->recepteur->nom }}</td>
                    <td>{{ $sortie->emetteur->nom }}</td>
                    <td>{{ $sortie->observation }}</td>
                    <td>{{ $sortie->quantite }}</td>
                    <td>
                        <a href="{{ route('stock-sorties.show', $sortie->sortie_id) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('stock-sorties.edit', $sortie->sortie_id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('stock-sorties.destroy', $sortie->sortie_id) }}" method="POST" style="display:inline;">
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

@section('js')
    <script>
        $(document).ready(function() {
            $('#sortiesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
                }
            });
        });
    </script>
@endsection

@endsection
