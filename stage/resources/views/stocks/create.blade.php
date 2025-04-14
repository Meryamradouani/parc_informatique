@extends('layouts.navuser')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Ajouter un Stock d'Article</h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('stocks.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="code_article" class="form-label">Article</label>
                            <select class="form-control" id="code_article" name="code_article" required>
                                @foreach($articles as $item)
                                    <option value="{{ $item->code_article }}">{{ $item->libelle }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantite" class="form-label">Quantité</label>
                            <input type="number" class="form-control" id="quantite" name="quantite" required>
                        </div>

                        <div class="d-flex justify-content mr-3">
                            <button type="submit" class="btn btn-primary" style="width: 20%;">Ajouter</button>
                            <a href="{{ route('stocks.index') }}" class="btn btn-secondary" style="width: 20%;">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
