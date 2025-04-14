@extends('adminlte::page')

@section('content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #eaeff1; /* Couleur d'arrière-plan alternative */
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px; /* Largeur maximale pour le conteneur */
        margin: 50px auto; /* Centre le conteneur sur la page */
        background-color: #ffffff; /* Fond blanc pour le conteneur */
        padding: 40px;
        border-radius: 10px; /* Coins arrondis */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée */
    }

    h1 {
        color: #2c3e50; /* Couleur du titre */
        margin-bottom: 20px;
        text-align: center; /* Centre le titre */
        font-size: 32px; /* Taille de police plus grande */
    }

    ul.list-group {
        list-style: none; /* Supprime les puces */
        padding: 0; /* Supprime le padding */
    }

    li.list-group-item {
        border: 1px solid #dcdcdc; /* Bordure légère */
        padding: 15px;
        font-size: 16px; /* Taille de la police */
        color: #34495e; /* Couleur du texte */
        background-color: #f9f9f9; /* Fond légèrement gris */
        border-radius: 5px; /* Coins arrondis */
        margin-bottom: 15px; /* Espace entre les éléments */
    }

    .btn-info {
        background-color: #3498db; /* Couleur principale */
        border: none;
        border-radius: 5px; /* Coins arrondis */
        padding: 12px 25px; /* Espacement intérieur */
        color: #fff; /* Couleur du texte */
        font-size: 18px; /* Taille de la police */
        cursor: pointer; /* Pointeur pour le bouton */
    }

    .btn-info:hover {
        background-color: #2980b9; /* Couleur au survol */
        transition: background-color 0.3s; /* Animation de transition */
    }

    .alert {
        margin-bottom: 20px; /* Espace sous les alertes */
        border-radius: 5px; /* Coins arrondis pour les alertes */
        padding: 15px; /* Padding pour les alertes */
        background-color: #dff0d8; /* Couleur d'alerte */
        color: #3c763d; /* Couleur du texte d'alerte */
    }

    .modal-content {
        border-radius: 10px; /* Coins arrondis pour la modale */
    }

    .form-label {
        font-weight: bold; /* Texte en gras pour les étiquettes */
        margin-bottom: 5px; /* Espace sous les étiquettes */
    }
</style>
<div class="container">
    <h1>Profil de {{ $user->nom }} {{ $user->prenom }}</h1>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Nom:</strong> {{ $user->nom }}</li>
        <li class="list-group-item"><strong>Prénom:</strong> {{ $user->prenom }}</li>
        <li class="list-group-item"><strong>Téléphone:</strong> {{ $user->tel }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Fonctionalité:</strong> {{ $user->fonctionalite }}</li>
    </ul>

    <div class="text-center">
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#updateModal">
            Modifier le profil
        </button>
    </div>

    <!-- Modale -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Modifier le profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="tel" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="{{ $user->tel }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="fonctionalite" class="form-label">Fonctionalité</label>
                            <input type="text" class="form-control" id="fonctionalite" name="fonctionalite" value="{{ $user->fonctionalite }}" required>
                        </div>

                        <hr>

                        <h5>Changer le mot de passe</h5>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mot de passe actuel</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <button type="submit" class="btn btn-info">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
