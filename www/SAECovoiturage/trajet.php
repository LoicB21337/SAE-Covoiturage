<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Accueil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS personnalisé -->
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/navbar.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="./../index.php">
                <img src="./../images/logo.png" alt="Way Together" height="60" />
            </a>

            <!-- Bouton hamburger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenu de la navbar -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Liens -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./carte.php">Carte</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Proposer un trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="./aPropos.php">À propos</a></li>
                </ul>

                <!-- Barre de recherche -->
                <form class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Rechercher un trajet"
                        aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Chercher
                    </button>
                </form>

                <!-- Boutons -->
                <div class="d-flex align-items-center gap-2">
                    <a href="./signup.php" class="btn btn-outline-primary">S'inscrire</a>
                    <a href="./login.php" class="btn btn-primary">Se connecter</a>
                </div>
            </div>
        </div>
    </nav>

    <section>
        <div class="search-bar">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Rechercher un trajet" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Chercher</button>
            </form>
        </div>
    </section>



</body>
<footer class="bg-light py-4 mt-auto border-top text-center">
    <div class="container">
        <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
    </div>
</footer>

</html>