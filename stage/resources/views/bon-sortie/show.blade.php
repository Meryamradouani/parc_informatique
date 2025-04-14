@extends('layouts.navuser')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title custom-title">Détails du Bon de Sortie</h1>
            <p class="card-text"><strong>Numéro de Sortie : </strong>{{ $stockSortie->numero_serie }}</p>
            <p class="card-text"><strong>Date : </strong>{{ \Carbon\Carbon::parse($stockSortie->date)->format('d-m-Y') }}</p>
            <p class="card-text"><strong>Article : </strong>{{ optional($stockSortie->article)->libelle ?: 'Inconnu' }}</p>
            <p class="card-text"><strong>Récepteur : </strong>{{ $stockSortie->recepteur ? $stockSortie->recepteur->nom : 'Inconnu' }}</p>
            <p class="card-text"><strong>Émetteur : </strong>{{ $stockSortie->emetteur ? $stockSortie->emetteur->nom : 'Inconnu' }}</p>
            <p class="card-text"><strong>Observation : </strong>{{ $stockSortie->observation ?: 'Aucune' }}</p>
            <p class="card-text"><strong>Quantité : </strong>{{ $stockSortie->quantite }}</p>

            <a href="{{ route('bon-sortie.index') }}" class="btn btn-primary">Retour à la liste</a>
        </div>
    </div>
</div>

<style>
    .custom-title {
        font-size: 28px;
        color: #333333;
        text-align: center;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 600px;
        margin: 20px auto;
    }

    .card-title {
        font-size: 1.25rem;
        color: #333;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
    }

    .btn-primary {
        margin-top: 10px;
    }
</style>

@endsection
