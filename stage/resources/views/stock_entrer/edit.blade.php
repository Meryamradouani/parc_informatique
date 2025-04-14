@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Modifier Bon d'Entrée</h1>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('stock_entrer.update', $stockEntrer->entry_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', $stockEntrer->date) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="recepteur" class="form-label">Récepteur</label>
                            <select name="recepteur" class="form-control" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $stockEntrer->recepteur == $utilisateur->id_utilisateur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="emetteur" class="form-label">Émetteur</label>
                            <select name="emetteur" class="form-control" required>
                                @foreach($utilisateurs as $utilisateur)
                                    <option value="{{ $utilisateur->id_utilisateur }}" {{ $stockEntrer->emetteur == $utilisateur->id_utilisateur ? 'selected' : '' }}>
                                        {{ $utilisateur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="entry_numero" class="form-label">Numéro d'Entrée</label>
                            <input type="text" name="entry_numero" class="form-control" value="{{ old('entry_numero', $stockEntrer->entry_numero) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Article</label>
                            <select name="code_article" class="form-control" required>
                                @foreach($articles as $article)
                                    <option value="{{ $article->code_article }}" {{ $stockEntrer->code_article == $article->code_article ? 'selected' : '' }}>
                                        {{ $article->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" name="quantite" class="form-control" value="{{ old('quantite', $stockEntrer->quantite) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="observation" class="form-label">Observation</label>
                            <textarea name="observation" class="form-control">{{ old('observation', $stockEntrer->observation) }}</textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('stock_entrer.index') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
