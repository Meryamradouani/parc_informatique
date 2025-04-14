@extends('adminlte::page')

@section('title', 'Modifier Utilisateur')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="font-weight: bold; font-size: 24px;">Modifier Utilisateur</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.utilisateur.update', $utilisateur->id_utilisateur) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $utilisateur->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ $utilisateur->prenom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tel" class="form-label">Téléphone</label>
                            <input type="text" id="tel" name="tel" class="form-control" value="{{ $utilisateur->tel }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $utilisateur->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="fonctionalite" class="form-label">Fonctionnalité</label>
                            <input type="text" id="fonctionalite" name="fonctionalite" class="form-control" value="{{ $utilisateur->fonctionalite }}" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                            <a href="{{ route('admin.utilisateur') }}" class="btn btn-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
