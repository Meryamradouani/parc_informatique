@extends('layouts.navuser')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Modifier le Bon d'Entrée</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('bon-entree.update', $stockEntrer->entry_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $stockEntrer->date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="recepteur" class="form-label">Récepteur</label>
                            <select class="form-control" id="recepteur" name="recepteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $utilisateur->id_utilisateur == $stockEntrer->recepteur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="emetteur" class="form-label">Émetteur</label>
                            <select class="form-control" id="emetteur" name="emetteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $utilisateur->id_utilisateur == $stockEntrer->emetteur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="observation" class="form-label">Observation</label>
                            <textarea class="form-control" id="observation" name="observation" rows="3">{{ $stockEntrer->observation }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="entry_numero" class="form-label">Numéro d'Entrée</label>
                            <input type="text" class="form-control" id="entry_numero" name="entry_numero" value="{{ $stockEntrer->entry_numero }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Code Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}" {{ $article->code_article == $stockEntrer->code_article ? 'selected' : '' }}>
                                        {{ $article->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="{{ $stockEntrer->quantite }}" required>
                        </div>

                        <div class="d-flex justify-content mr-3">
                            <button type="submit" class="btn btn-primary btn-sm">Enregistrer</button>
                            <a href="{{ route('bon-entree.index') }}" class="btn btn-secondary btn-sm">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
