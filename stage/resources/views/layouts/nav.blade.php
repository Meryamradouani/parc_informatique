<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <!-- Vite Assets -->
    <link rel="stylesheet" href="resources/css/app.css">
    <script src="resources/js/app.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 20px; /* Ajoute une marge de 20px autour du corps */
            text-align: center; /* Centre le contenu horizontalement */
        }
        .navbar {
            background-color: #343a40; /* Couleur de fond de la navbar */
            padding: 1rem; /* Espacement interne */
            height: 100PX;

        }
        .navbar-brand img {
            width: 230px;
            height: 80px; /* Adaptation d'image */
            padding-bottom: 10PX;

        }
        .navbar-nav .nav-link {
            color: #dff2ff; /* Couleur du texte des liens */
            font-size: 16px;
            font-weight: 500;
            padding: 10px 15px; /* Espacement interne des liens */
        }
        .navbar-nav .nav-link:hover {
            color: #a8c0ff; /* Couleur du texte au survol */
            background-color: #828996; /* Couleur de fond au survol */
            border-radius: 5px; /* Arrondi des coins */
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out; /* Animation au survol */
        }
        .form-control {
            background-color: rgba(255, 255, 255, 0.1); /* Couleur de fond des champs de recherche */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure */
            color: #fff; /* Couleur du texte */
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Couleur du texte des placeholders */
        }
        .btn-success {
            background-color: #28a745; /* Couleur de fond du bouton */
            border-color: #28a745; /* Couleur de la bordure */
        }
        .btn-success:hover {
            background-color: #218838; /* Couleur de fond au survol */
            border-color: #1e7e34; /* Couleur de la bordure au survol */
        }
    footer {
        position: fixed; /* Fixe le footer en bas */
        bottom: 0; /* Aligne le footer en bas */
        left: 0; /* Aligne à gauche */
        width: 100%; /* Prend toute la largeur */
       /* Couleur de fond du footer */
        /* Couleur du texte */
        padding: 10px 0; /* Espacement interne */
    }
    .text-center {
        text-align: center; /* Centre le texte horizontalement */
    }

    </style>

</head>
<body>

<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('image/logo1.jpeg') }}" alt="Logo">
        </a>
        <div class="d-flex align-items-center"> <!-- Conteneur pour les boutons -->
            <a class="btn btn-outline-light me-2" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </a>
            <a class="btn btn-outline-light" href="{{ route('register') }}">
                <i class="fas fa-user-plus"></i> S'inscrire
            </a>
        </div>
    </div>
</nav>

<br><br><br>  <br><br><br>
<!-- Main Content -->
<main class="container mt-4">
    @yield('content')
</main>
<footer class="text-center">
    <div>ONEEP BRACHE D'EAU 2024-2025</div>
</footer>
<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
