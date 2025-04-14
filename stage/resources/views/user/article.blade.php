@extends('layouts.navuser')
@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
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
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }
        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }
        table.table th, table.table td {
            border-color: #e9e9e9;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        .modal-header {
            background: #f5f5f5;
        }
    </style>
    <style>
        .btn-primary {
            background-color: #007bff; /* Couleur de fond */
            border-color: #007bff; /* Couleur de bordure */
            font-weight: bold; /* Texte en gras */
            transition: background-color 0.3s; /* Transition douce */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Couleur au survol */
            border-color: #0056b3; /* Couleur de bordure au survol */
        }
    </style>

</head>
<body>
    <div class="container mt-5">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-8"><h2>Liste des <b>Article</b></h2></div><br>
                <div class="col-sm-6">
                    <a href="#addArticleModal" class="btn btn-success" data-toggle="modal">
                        <i class="fa fa-search" aria-hidden="true"></i> Créer un Nouvel Article
                    </a>
                </div>


            </div><br>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table id="table" class="table table-striped table-hover table-bordered">
            <thead>
                <tr>

                    <th>Numéro de Série</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr>

                        <td>{{ $article->numeroserie }}</td>
                        <td>{{ $article->marque }}</td>
                        <td>{{ $article->model }}</td>
                        <td>{{ $article->libelle }}</td>
                        <td>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal"
                                    data-id="{{ $article->code_article }}"
                                    data-numeroserie="{{ $article->numeroserie }}"
                                    data-marque="{{ $article->marque }}"
                                    data-model="{{ $article->model }}"
                                    data-libelle="{{ $article->libelle }}"
                                    data-description="{{ $article->description }}"
                                    data-accessoires="{{ $article->accessoires }}">
                                    <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#detailsModal"
                                    data-numeroserie="{{ $article->numeroserie }}"
                                    data-marque="{{ $article->marque }}"
                                    data-model="{{ $article->model }}"
                                    data-libelle="{{ $article->libelle }}"
                                    data-description="{{ $article->description }}"
                                    data-accessoires="{{ $article->accessoires }}">
                                    <i class="fas fa-eye"></i>
                            </button>
                            <form action="{{ route('article.destroy', $article->code_article) }}" method="POST" style="display:inline;" id="deleteForm{{ $article->code_article }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $article->code_article }}')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $articles->links() }} <!-- Liens de pagination -->
    </div>

    <!-- Modal Détails -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Détails de l'Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Numéro de Série:</strong> <span id="detailNumeroserie"></span></p>
                    <p><strong>Marque:</strong> <span id="detailMarque"></span></p>
                    <p><strong>Modèle:</strong> <span id="detailModel"></span></p>
                    <p><strong>Libellé:</strong> <span id="detailLibelle"></span></p>
                    <p><strong>Description:</strong> <span id="detailDescription"></span></p>
                    <p><strong>Accessoires:</strong> <span id="detailAccessoires"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier l'Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="articleId">
                        <div class="form-group">
                            <label for="numeroserie">Numéro de Série</label>
                            <input type="text" class="form-control" name="numeroserie" id="numeroserie" required>
                        </div>
                        <div class="form-group">
                            <label for="marque">Marque</label>
                            <input type="text" class="form-control" name="marque" id="marque" required>
                        </div>
                        <div class="form-group">
                            <label for="model">Modèle</label>
                            <input type="text" class="form-control" name="model" id="model" required>
                        </div>
                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input type="text" class="form-control" name="libelle" id="libelle" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="form-group">
                            <label for="accessoires">Accessoires</label>
                            <input type="text" class="form-control" name="accessoires" id="accessoires" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Ajouter Article -->
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addArticleModalLabel">Ajouter un Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addArticleForm" method="POST" action="{{ route('article.store') }}">
                @csrf
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="modal-body">
                    <div class="form-group">
                        <label for="numeroserie">Numéro de Série</label>
                        <input type="text" class="form-control" name="numeroserie" required>
                    </div>
                    <div class="form-group">
                        <label for="marque">Marque</label>
                        <input type="text" class="form-control" name="marque" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Modèle</label>
                        <input type="text" class="form-control" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="text" class="form-control" name="libelle" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label for="accessoires">Accessoires</label>
                        <input type="text" class="form-control" name="accessoires" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter l'Article</button>
                </div>
            </form>
        </div>
    </div>

</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Bouton qui a ouvert le modal
            var id = button.data('id');
            var numeroserie = button.data('numeroserie');
            var marque = button.data('marque');
            var model = button.data('model');
            var libelle = button.data('libelle');
            var description = button.data('description');
            var accessoires = button.data('accessoires');

            var modal = $(this);
            modal.find('#articleId').val(id);
            modal.find('#numeroserie').val(numeroserie);
            modal.find('#marque').val(marque);
            modal.find('#model').val(model);
            modal.find('#libelle').val(libelle);
            modal.find('#description').val(description);
            modal.find('#accessoires').val(accessoires);
            modal.find('#editForm').attr('action', '/articles/' + id); // Mettre à jour l'URL du formulaire
        });
    </script>
    <script>
        $('#detailsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Bouton qui a ouvert le modal
            var numeroserie = button.data('numeroserie');
            var marque = button.data('marque');
            var model = button.data('model');
            var libelle = button.data('libelle');
            var description = button.data('description');
            var accessoires = button.data('accessoires');

            var modal = $(this);
            modal.find('#detailNumeroserie').text(numeroserie);
            modal.find('#detailMarque').text(marque);
            modal.find('#detailModel').text(model);
            modal.find('#detailLibelle').text(libelle);
            modal.find('#detailDescription').text(description);
            modal.find('#detailAccessoires').text(accessoires);
        });

    </script>
    <script>
        function confirmDelete(articleId) {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
                // Soumettre le formulaire de suppression correspondant
                document.getElementById('deleteForm' + articleId).submit();
            } else {
                // Annuler l'action de suppression
                return false;
            }
        }
    </script>
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 <script>
     $(document).ready(function() {
         $('#table').DataTable({
             "language": {
                 "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/French.json"
             }
         });
     });
 </script>
</body>
</html>
@endsection
