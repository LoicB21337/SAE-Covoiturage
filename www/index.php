<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Accueil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS personnalisé -->
    <link href="fichiers/css/base.css" rel="stylesheet" />
    <link href="fichiers/css/navbar.css" rel="stylesheet" />
    <link href="fichiers/css/buttons.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="./images/logo.png" alt="Way Together" height="60" />
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
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./SAECovoiturage/carte.php">Carte</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Proposer un trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
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
                    <a href="SAECovoiturage/signup.php" class="btn btn-outline-primary">S'inscrire</a>
                    <a href="SAECovoiturage/login.php" class="btn btn-primary">Se connecter</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Présentation -->
    <div class="hero d-flex flex-column justify-content-center align-items-center text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                Partagez vos trajets, économisez et rencontrez des gens
            </h1>
            <p class="lead mb-4">
                Rejoignez notre communauté pour voyager malin et réduire vos coûts.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-primary btn-lg">
                    Contacter un conducteur
                </button>
                <button class="btn btn-primary btn-lg">Proposer un trajet</button>
            </div>
        </div>
    </div>

    <!-- Section Trajets Disponibles -->
    <section class="container mb-5">
        <h2 class="h4 fw-semibold mb-3">Trajets disponibles</h2>
        <div id="results" class="row g-3">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">Paris → Lyon</h5>
                            <p class="card-text text-muted small">
                                15/11/2025 • 3 places • Conducteur : Marc
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="fw-bold fs-5">€22</span>
                            <button class="btn btn-outline-primary btn-sm">
                                Contacter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajouter d'autres trajets ici -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-auto border-top text-center">
        <div class="container">
            <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>