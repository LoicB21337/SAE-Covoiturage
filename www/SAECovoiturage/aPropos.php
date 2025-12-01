<?php
require_once('./../includes/session_start.php');
?>


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
    <link href="../fichiers/css/aPropos.css" rel="stylesheet" />
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
                    <li class="nav-item"><a class="nav-link" href="./proposerTrajet.php">Proposer un trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mes Réservations</a></li>
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
                    <?php if (isset($_SESSION['user'])){
                        echo '<a href="SAECovoiturage/profile.php" class="btn btn-outline-primary">Mon profil</a>';
                        echo '<a href="../fichiers/php/deconnexion.php" class="btn btn-primary">Se déconnecter</a>';
                    }else {
                        echo '<a href="./signup.html" class="btn btn-outline-primary">S\'inscrire</a>';
                        echo '<a href="./login.html" class="btn btn-primary">Se connecter</a>';
                    }
                      ?>
                </div>
            </div>
        </div>
    </nav>
    <div>
        <h1>A Propos</h1>
        <div class="texte">
            <p>
                Bienvenue sur Way Together, la plateforme de covoiturage créée par et
                pour les étudiants de l’IUT d’Amiens. Notre mission est de faciliter
                les trajets domicile–campus en permettant aux étudiants de partager
                leurs déplacements sur l’ensemble de la région amiénoise, et même
                au-delà. En rassemblant conducteurs et passagers autour d’un service
                simple, économique et responsable, nous souhaitons encourager une
                mobilité plus durable pour tous.
            </p>
            <p>
                Depuis la création du projet, nous nous engageons à offrir un
                environnement sécurisé, transparent et facile à utiliser. Grâce à une
                interface intuitive, une messagerie intégrée et un système d’avis
                fiable, chacun peut organiser ses trajets en toute confiance.
            </p>
            <p>
                Que vous souhaitiez réduire vos frais de transport, optimiser vos
                trajets quotidiens ou simplement rencontrer d’autres étudiants, Way
                Together vous accompagne au quotidien.
            </p>
            <p>
                Rejoignez la communauté de l’IUT d’Amiens et faisons du covoiturage
                une solution conviviale et durable pour nos déplacements.
            </p>
            Createurs : <br />
        </div>
        <div class="texteCreateur">
            Alison Pierre-louis<br />
            Loïc Brunet<br />
            Shana Brimeux<br />
            Gabriel Vaucher<br />
            Côme Vermeulen<br />
            Lukas Langue
        </div>
        <p></p>
    </div>

    <footer class="bg-light py-4 mt-auto border-top text-center">
        <div class="container">
            <small class="text-muted">
                © 2025 Way Together — Tous droits réservés
            </small>
        </div>
    </footer>
</body>

</html>