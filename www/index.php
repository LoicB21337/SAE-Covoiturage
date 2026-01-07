<?php
require_once('./includes/session_start.php');
require('./fichiers/php/Trajets.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="./images/icon.png">
    <title>Way Together — Accueil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS personnalisé -->
    <link href="./fichiers/css/base.css" rel="stylesheet" />
    <link href="./fichiers/css/navbar.css" rel="stylesheet" />
    <link href="./fichiers/css/hero.css" rel="stylesheet" />
    <link href="./fichiers/css/cards.css" rel="stylesheet" />
    <link href="./fichiers/css/buttons.css" rel="stylesheet" />
    <link href="../fichiers/css/popupReservation.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="./images/logo.png" alt="Logo Way Together - Covoiturage" height="60" />
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
                    <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./SAECovoiturage/carte.php">Carte</a></li>
                    <?php if (isset($_SESSION['user'])) { echo '<li class="nav-item"><a class="nav-link" href="./SAECovoiturage/proposerTrajet.php">Proposer un
                            trajet</a></li>'; } ?>
                    <li class="nav-item"><a class="nav-link" href="./SAECovoiturage/trajet.php">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="./SAECovoiturage/aPropos.php">À propos</a></li>

                </ul>

                <!-- Boutons -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['user'])){
                        echo '<a href="./SAECovoiturage/profil.php" class="btn btn-outline-primary">Mon profil</a>';
                        echo '<a href="fichiers/php/deconnexion.php" class="btn btn-primary">Se déconnecter</a>';
                    }else {
                        echo '<a href="SAECovoiturage/signup.html" class="btn btn-outline-primary">S\'inscrire</a>';
                        echo '<a href="SAECovoiturage/login.html" class="btn btn-primary">Se connecter</a>';
                    }
                      ?>

                </div>
            </div>
        </div>
    </nav>

    <!-- Présentation -->
    <header class="hero d-flex flex-column justify-content-center align-items-center text-center mb-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">
                Partagez vos trajets, économisez et rencontrez des gens
            </h1>
            <p class="lead mb-4 fw-semibold">
                Rejoignez notre communauté pour voyager malin et réduire vos coûts
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="./SAECovoiturage/trajet.php" class="btn btn-primary btn-lg">Trouver un trajet</a>
                <a href="./SAECovoiturage/proposerTrajet.php" class="btn btn-primary btn-lg">Proposer un trajet</a>
            </div>
        </div>
    </header>

    <!-- Section Trajets Disponibles -->
    <section class="container mb-5">
        <h2 class="h4 fw-semibold mb-3">Trajets disponibles</h2>
        <div class="flex-container">
            <?php rechercherTrajets(null,null,null,null) ?>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-auto border-top text-center">
        <div class="container">
            <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
        </div>
    </footer>
</body>


<div class="overlay" id="overlay-reservation">
    <div class="popup" role="dialog" aria-modal="true" aria-labelledby="popupReservationTitle">
        <h3 id="popupReservationTitle">Confirmer la réservation</h3>
        <p id="trajet-info">Voulez-vous réserver ce trajet ?</p>

        <div class="d-flex gap-2 justify-content-center mt-3">
            <button type="button" class="btn btn-primary" id="confirmReservationBtn">Oui, réserver</button>
            <button type="button" class="btn btn-secondary" onclick="closeReservationPopup()">Annuler</button>
        </div>
    </div>
</div>

<script>
let trajetId = null;

function openReservationPopup(id, info) {
    trajetId = id;
    document.getElementById("trajet-info").textContent = "Voulez-vous réserver ce trajet : " + info + " ?";
    document.getElementById("overlay-reservation").style.display = "flex";
    document.body.classList.add("overlay-open");
}

function closeReservationPopup() {
    document.getElementById("overlay-reservation").style.display = "none";
    document.body.classList.remove("overlay-open");
}

// Action sur bouton "Oui, réserver"
document.getElementById("confirmReservationBtn").addEventListener("click", function() {
    if (trajetId) {
        window.location.href = "./fichiers/php/reserver.php?id_trajet=" + trajetId;
    }
});
</script>

</html>