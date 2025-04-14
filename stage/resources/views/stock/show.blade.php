@extends('adminlte::page')

@section('content')
<div class="container">
    <h1>Stock de l'Article : {{ $article->libelle }}</h1>

    <p>Code Article : {{ $article->code_article }}</p>

    <p>Quantité en Stock : {{ $stock->quantite }}</p>

    <a href="{{ route('articles.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Retour à la liste des articles
    </a>
</div>
@endsection
