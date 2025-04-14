@extends('layouts.nav')

@section('content')
<style>
    .content {
        height: 90vh; /* Remplit toute la hauteur de la fenêtre */
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('{{ config('admin.login_background_image') }}') no-repeat center center;
        background-size: cover;
    }

    .main {
        background-color: rgba(255, 255, 255, 0.9); /* Ajout de transparence pour un effet de profondeur */
        border-radius: 12px; /* Arrondi des coins */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Ombre douce */
        padding: 30px;
        width: 550px; /* Largeur uniforme */
        text-align: center;
    }

    h1 {
        font-size: 36px; /* Taille du texte */
        margin: 0 0 20px; /* Espacement simplifié */
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: stretch; /* Alignement des éléments */
    }

    label {
        font-size: 16px; /* Taille du texte */
        font-weight: 600; /* Poids du texte */
        color: #333;
        margin-bottom: 3px;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px; /* Réduit l'espace entre les champs */
        border: 1px solid #ccc;
        border-radius: 6px; /* Bordure arrondie */
        box-sizing: border-box;
        transition: border-color 0.3s; /* Effet de transition */
    }

    input:focus {
        border-color: #22427C; /* Changement de couleur au focus */
        outline: none; /* Retirer le contour par défaut */
    }

    input[type="submit"] {
        background-color: #22427C;
        color: #fff;
        padding: 14px;
        border: none;
        border-radius: 6px; /* Bordure arrondie */
        cursor: pointer;
        transition: background-color 0.3s; /* Transition pour l'effet de survol */
    }

    input[type="submit"]:hover {
        background-color: #1a2e5a; /* Couleur au survol */
    }

    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: left; /* Aligne le texte à gauche */
    }
</style>

<div class="content">
    <div class="main">
        <h1>Inscription</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required>

            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" name="password" required>

            <label for="password_confirmation">Confirmer le mot de passe:</label>
            <input type="password" name="password_confirmation" required>

            <input type="submit" value="S'inscrire">
        </form>
    </div>
</div>

@endsection
