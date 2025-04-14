@extends('layouts.nav')

@section('content')

<style>
    .content {
        height: 600px; /* Remplit toute la hauteur de la fenêtre */
        display: flex;
        justify-content: center;
        align-items: center;
        background: url('{{ config('admin.login_background_image') }}') no-repeat center center;
        background-size: cover;
        padding:0;


    }

    .main {
        background-color: rgba(255, 255, 255, 0.9); /* Ajout de transparence pour un effet de profondeur */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        padding: 40px;
        width: 400px; /* Ajuste la largeur selon vos besoins */
        text-align: center;

    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #22427C;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%; /* Rendre le bouton responsive */
    }

    button:hover {
        background-color: #1b3366;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 10px;
        text-align: left;
    }
</style>

<div class="content">
    <div class="main">
        <h2 class="mb-4">connexion </h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="text" name="login" placeholder="Nom d'utilisateur" required>
            @error('login')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="email" name="email" placeholder="Email" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Mot de passe" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Se connecter</button>
        </form>
    </div>
</div>

@endsection
