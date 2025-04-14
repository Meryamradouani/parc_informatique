@extends('layouts.navuser')
@section('content')
<br><br>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Liste des <b>Utilisateurs</b></h2></div><br>
                    <div class="col-sm-4">
                        <div class="search-box">
                            <i class="material-icons">&#xE8B6;</i>
                            <input type="text" id="searchInput" class="form-control" placeholder="Search&hellip;">
                        </div>
                    </div>
                </div><br>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($utilisateurs as $utilisateur)
                    <tr>
                        
                        <td>{{ $utilisateur->nom }}</td>
                        <td>{{ $utilisateur->prenom }}</td>
                        <td>{{ $utilisateur->email }}</td>
                        <td>
                            <a href="#" class="btn btn-info" data-utilisateur="{{ json_encode($utilisateur) }}">Détails</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="hint-text">Showing <b>{{ $utilisateurs->count() }}</b> out of <b>{{ $utilisateurs->total() }}</b> entries</div>
            {{ $utilisateurs->links() }} <!-- Pagination -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="utilisateurModal" tabindex="-1" role="dialog" aria-labelledby="utilisateurModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="utilisateurModalLabel">Détails de l'utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalNom"></p>
                <p id="modalPrenom"></p>
                <p id="modalTel"></p>
                <p id="modalEmail"></p>
                <p id="modalFonctionalite"></p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $('.btn-info').on('click', function() {
            var utilisateur = $(this).data('utilisateur');

            $('#modalNom').text('Nom: ' + utilisateur.nom);
            $('#modalPrenom').text('Prénom: ' + utilisateur.prenom);
            $('#modalTel').text('Téléphone: ' + utilisateur.tel);
            $('#modalEmail').text('Email: ' + utilisateur.email);
            $('#modalFonctionalite').text('Fonctionnalité: ' + utilisateur.fonctionalite);

            $('#utilisateurModal').modal('show');
        });
    });

    // Fonction de filtrage pour la recherche
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
</script>

</body>
</html>
@endsection
