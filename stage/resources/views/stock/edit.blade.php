<!-- article_stock.edit.blade.php -->

@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 m-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Modifier le Stock d'Article</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock.update', $articleStock->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}" {{ $article->code_article == $articleStock->code_article ? 'selected' : '' }}>{{ $article->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="{{ $articleStock->quantite }}" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <a href="{{ route('stock.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
