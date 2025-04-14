@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Ajouter un Bon d'Entrée</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('stock_entrer.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="mb-3">
                            <label for="recepteur" class="form-label">Récepteur</label>
                            <select class="form-control" id="recepteur" name="recepteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="emetteur" class="form-label">Émetteur</label>
                            <select class="form-control" id="emetteur" name="emetteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="observation" class="form-label">Observation</label>
                            <textarea class="form-control" id="observation" name="observation"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="entry_numero" class="form-label">Numéro d'Entrée</label>
                            <input type="text" class="form-control" id="entry_numero" name="entry_numero" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Code Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}">{{ $article->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite">Quantité</label>
                            <input type="number" name="quantite" class="form-control" id="quantite" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <a href="{{ route('stock_entrer.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
