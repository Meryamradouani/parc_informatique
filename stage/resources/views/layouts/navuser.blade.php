<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous">
    <title>@yield('Title')</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Language File (optional, pour le français par exemple) -->
    <script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"></script>


    <style>
        body {
            background-color: #fbfbfb;
            display: flex;
            margin: 0;
            font-family: 'Roboto', sans-serif; /* Exemple: changer la police par défaut */
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            padding-top: 1rem;
            background-color: #343a40;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 600;
            overflow-y: auto; /* Ajouter un défilement vertical si nécessaire */
        }

        .list-group-item {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 10px;
            font-size: 18px;
            color: #444;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .sidebar .navbar-brand {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
        }

        .sidebar .navbar-brand img {
            width: 300px;
            height: 100px;
            padding-left: 10PX;
            padding-right: 10PX;

        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #fff;
            padding: 10px 15px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background-color: #e9ecef;
            color: #007bff;
        }

        .content {
            margin-left: 260px; /* Ajuster la marge en fonction de la largeur de la sidebar */
            flex-grow: 1;
            padding: 20px; /* Augmenter l'espacement intérieur */
        }

        .container {
            max-width: 1200px; /* Limiter la largeur du contenu pour une meilleure lisibilité */
            margin: auto; /* Centrer le contenu horizontalement */
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
                padding-top: 80px; /* Ajouter un espace au-dessus du contenu pour compenser la hauteur de la navbar */
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 20px;
                box-shadow: none;
                overflow-y: auto;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="navbar-brand">
            <img src="{{ asset('image/logo1.jpeg') }}" alt="Logo">
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ route('utilisateur') }}" class="list-group-item">
                <i class="fas fa-users fa-fw me-3"></i><span>Liste d'utilisateurs</span>
            </a>
            <a href="{{ route('article.index') }}" class="list-group-item">
                <i class="fas fa-file-alt fa-fw me-3"></i><span>Liste des Articles</span>
            </a>
            <a href="{{ route('stocks.index') }}" class="list-group-item">
                <i class="fas fa-boxes fa-fw me-3"></i><span>Voir Stock</span>
            </a>
            <a href="{{ route('bon-entree.index') }}" class="list-group-item">
                <i class="fas fa-gift fa-fw me-3"></i><span>Bon d'entrée</span>
            </a>
            <a href="{{ route('bon-sortie.index') }}" class="list-group-item">
                <i class="fas fa-gift fa-fw me-3"></i><span>Bon de sortie</span>
            </a>
            <a href="{{ route('profile') }}" class="list-group-item">
                <i class="fas fa-user fa-fw me-3"></i><span>Profil</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <a href="{{ route('login') }}" class="list-group-item">
                    <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Déconnexion</span>
                </a>
            </form>

        </div>
    </div>
    <div class="content">
        <!-- Contenu principal, y compris la navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Vos éléments de navbar ici -->
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <a href="{{ route('login') }}" class="nav-link" >
                                    <i class="fas fa-sign-out-alt fa-fw me-3"></i>Déconnexion
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @yield('content') <!-- Contenu spécifique à chaque page -->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
