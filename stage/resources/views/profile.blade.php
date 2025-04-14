@extends('layouts.navuser')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="card-title text-center mb-4">Profil de {{ $user->nom }} {{ $user->prenom }}</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <ul class="list-group list-group-flush mb-4">
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-info">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    /* Ajoutez ce CSS à votre fichier CSS global ou à un fichier dédié */

body {
    font-family: 'Arial', sans-serif;
    background-color: #eaeff1; /* Couleur d'arrière-plan alternative */
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px; /* Largeur maximale pour le conteneur */
    margin: 10px auto; /* Centre le conteneur sur la page */
    padding: 10px; /* Réduit le padding pour une apparence plus légère */
}

.card {
    border-radius: 10px; /* Coins arrondis pour la carte */
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée */
}

.card-title {
    color: #2c3e50; /* Couleur du titre */
    text-align: center; /* Centre le titre */
    font-size: 28px; /* Taille de police légèrement réduite */
    margin-bottom: 20px;
}

.list-group-item {
    border: 1px solid #dcdcdc; /* Bordure légère */
    padding: 15px;
    font-size: 16px; /* Taille de la police */
    color: #34495e; /* Couleur du texte */
    background-color: #f9f9f9; /* Fond légèrement gris */
    border-radius: 5px; /* Coins arrondis */
    margin-bottom: 15px; /* Espace entre les éléments */
}

.btn-info {
     /* Couleur principale */
    border: none;
    border-radius: 5px; /* Coins arrondis */
    padding: 12px /* Espacement intérieur */
    color: #fff; /* Couleur du texte */
    font-size: 18px; /* Taille de la police */
    cursor: pointer; /* Pointeur pour le bouton */
}

.btn-info:hover {
    background-color: #2980b9; /* Couleur au survol */
    transition: background-color 0.3s; /* Animation de transition */
}

.modal-content {
    border-radius: 10px; /* Coins arrondis pour la modale */
}

.modal-header {
    border-bottom: none; /* Supprime la bordure inférieure de l'en-tête */
}

.modal-title {
    color: #3498db; /* Couleur du titre de la modale */
}

.modal-body {
    padding: 20px; /* Ajoute du padding pour un meilleur espacement */
}

.modal-footer {
    border-top: none; /* Supprime la bordure supérieure du pied de page */
    justify-content: space-between; /* Espacement équitable entre les boutons */
}

</style>
@endsection
