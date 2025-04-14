@extends('layouts.navuser')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Ajouter un Bon de Sortie</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('bon-sortie.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="numero_serie">Numéro de Série</label>
                            <input type="text" name="numero_serie" id="numero_serie" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="code_article">Code Article</label>
                            <select name="code_article" id="code_article" class="form-control" required>
                                <option value="">Sélectionner un article</option>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}">{{ $article->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" name="quantite" class="form-control" id="quantite" required>
                        </div>

                        <div class="form-group">
                            <label for="recepteur">Récepteur</label>
                            <select name="recepteur" id="recepteur" class="form-control" required>
                                <option value="">Sélectionner un récepteur</option>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="emetteur">Émetteur</label>
                            <select name="emetteur" id="emetteur" class="form-control" required>
                                <option value="">Sélectionner un émetteur</option>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observation">Observation</label>
                            <textarea name="observation" id="observation" class="form-control"></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <a href="{{ route('bon-sortie.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
