@extends('adminlte::page') <!-- ou votre layout principal -->

@section('title', 'Page Utilisateurs')

@section('content')
<div class="container">
    <h1>Liste des Utilisateurs</h1>
    <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">Ajouter un Utilisateur</button>
    <table id="myTable" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Fonctionnalité</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($utilisateurs as $utilisateur)
                <tr>
                    <td>{{ $utilisateur->nom }}</td>
                    <td>{{ $utilisateur->prenom }}</td>
                    <td>{{ $utilisateur->tel }}</td>
                    <td>{{ $utilisateur->email }}</td>
                    <td>{{ $utilisateur->fonctionalite }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <button class="btn btn-info btn-details mr-2" data-toggle="modal" data-target="#detailsUserModal" data-nom="{{ $utilisateur->nom }}" data-prenom="{{ $utilisateur->prenom }}" data-tel="{{ $utilisateur->tel }}" data-email="{{ $utilisateur->email }}" data-fonctionalite="{{ $utilisateur->fonctionalite }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('admin.utilisateur.edit', $utilisateur->id_utilisateur) }}" class="btn btn-warning mr-2">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteUserModal" data-id="{{ $utilisateur->id_utilisateur }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
{{-- Modal Détails Utilisateur --}}
<div class="modal fade" id="detailsUserModal" tabindex="-1" role="dialog" aria-labelledby="detailsUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsUserModalLabel">Détails de l'utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nom:</strong> <span id="detailsNom"></span></p>
                <p><strong>Prénom:</strong> <span id="detailsPrenom"></span></p>
                <p><strong>Téléphone:</strong> <span id="detailsTel"></span></p>
                <p><strong>Email:</strong> <span id="detailsEmail"></span></p>
                <p><strong>Fonctionnalité:</strong> <span id="detailsFonctionalite"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


{{-- Modale Ajouter Utilisateur --}}
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('utilisateurs.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Ajouter un Utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="tel">Téléphone</label>
                        <input type="text" class="form-control" name="tel" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="fonctionalite">Fonctionnalité</label>
                        <input type="text" class="form-control" name="fonctionalite" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modale Modifier Utilisateur --}}
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.utilisateur.update', $utilisateur->id_utilisateur) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Modifier un Utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach (['nom', 'prenom', 'tel', 'email', 'fonctionalite'] as $field)
                        <div class="form-group">
                            <label for="edit_{{ $field }}">{{ ucfirst($field) }}</label>
                            <input type="text" class="form-control" name="{{ $field }}" id="edit_{{ $field }}" required>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modale Supprimer Utilisateur --}}
{{-- Modale Supprimer Utilisateur --}}
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="deleteUserForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json" // Utilisation du fichier de langue française pour DataTables
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Gestion de l'événement clic sur le bouton "Détails"
        $('.btn-details').on('click', function() {
            var nom = $(this).data('nom');
            var prenom = $(this).data('prenom');
            var tel = $(this).data('tel');
            var email = $(this).data('email');
            var fonctionalite = $(this).data('fonctionalite');

            $('#detailsNom').text(nom);
            $('#detailsPrenom').text(prenom);
            $('#detailsTel').text(tel);
            $('#detailsEmail').text(email);
            $('#detailsFonctionalite').text(fonctionalite);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Gestion de l'événement clic sur le bouton "Supprimer"
        $('.btn-delete').on('click', function() {
            var utilisateurId = $(this).data('id');
            var formAction = "{{ route('admin.utilisateur.destroy', ':id') }}".replace(':id', utilisateurId);
            $('#deleteUserForm').attr('action', formAction);
        });
    });
</script>


@endsection
