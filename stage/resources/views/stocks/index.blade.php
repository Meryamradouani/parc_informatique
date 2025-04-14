<!-- article_stock.index.blade.php -->

@extends('layouts.navuser')

@section('content')
<div class="container">
    <h1>Liste du Stock des Articles</h1>

    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Ajouter un Stock d'Article</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table id="articleStocksTable" class="table table-striped custom-table">
            <thead>
                <tr>
                <th style="width: 30%;">Article</th>
                <th style="width: 20%;">Quantité</th>
                <th style="width: 50%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articleStocks as $articleStock)
                    <tr>
                        <td>{{ $articleStock->article->libelle }}</td>
                        <td>{{ $articleStock->quantite }}</td>
                        <td>
                            <a href="{{ route('stocks.edit', $articleStock->id) }}"  class="btn btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('stocks.destroy', $articleStock->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stock d\'article ?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<style>
   <style>
    .custom-table {
        width: 600px;
        font-size: 14px;
        /* Autres styles personnalisés */
    }
</style>
</style>
<script>
    $(document).ready(function() {
        $('#articleStocksTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        });
    });
</script>
@endsection

