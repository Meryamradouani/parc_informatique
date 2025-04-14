<!-- article_stock.index.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Liste du Stock des Articles</h1>

    <a href="{{ route('stock.create') }}" class="btn btn-primary mb-3">Ajouter un Stock d'Article</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table id="stockTable" class="table">
        <thead>
            <tr>
                <th>Article</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articleStocks as $articleStock)
                <tr>
                    <td>{{ $articleStock->article->libelle }}</td>
                    <td>{{ $articleStock->quantite }}</td>
                    <td>
                        <a href="{{ route('stock.edit', $articleStock->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                        <form action="{{ route('stock.destroy', $articleStock->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock d\'article ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#stockTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" // Utilisation du fichier de langue française pour DataTables
                }
            });
        });
    </script>
@endsection
