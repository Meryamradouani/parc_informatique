<!-- article_stock.create.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Ajouter un Stock d'Article</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}">{{ $article->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="{{ route('stock.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
