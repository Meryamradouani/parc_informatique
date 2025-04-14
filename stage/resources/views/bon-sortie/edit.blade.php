@extends('layouts.navuser')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Modifier le Bon de Sortie</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('bon-sortie.update', $stockSortie->sortie_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="numero_serie" class="form-label">Numéro de Série</label>
                            <input type="text" class="form-control" id="numero_serie" name="numero_serie" value="{{ $stockSortie->numero_serie }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $stockSortie->date }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Code Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}" {{ $article->code_article == $stockSortie->code_article ? 'selected' : '' }}>
                                        {{ $article->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" value="{{ $stockSortie->quantite }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="recepteur" class="form-label">Récepteur</label>
                            <select class="form-control" id="recepteur" name="recepteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $utilisateur->id_utilisateur == $stockSortie->recepteur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="emetteur" class="form-label">Émetteur</label>
                            <select class="form-control" id="emetteur" name="emetteur" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $utilisateur->id_utilisateur == $stockSortie->emetteur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }} {{ $utilisateur->prenom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="observation" class="form-label">Observation</label>
                            <textarea class="form-control" id="observation" name="observation" rows="3">{{ $stockSortie->observation }}</textarea>
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
