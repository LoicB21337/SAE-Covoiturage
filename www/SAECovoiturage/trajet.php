<?php
require('./../includes/session_start.php');
require('../fichiers/php/Trajets.php');

$depart = isset($_GET['depart']) ? $_GET['depart'] : null;
$arrivee = isset($_GET['arrivee']) ? $_GET['arrivee'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : null;
$heure = isset($_GET['heure']) ? $_GET['heure'] : null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../images/icon.png">
    <title>Way Together — Trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
    <link href="../fichiers/css/Trajets.css" rel="stylesheet" />
    <link href="../fichiers/css/popupReservation.css" rel="stylesheet" />
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../images/logo.png" alt="Way Together" height="60" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./carte.php">Carte</a></li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['nom'] !== 'admin') { echo '<li class="nav-item"><a class="nav-link" href="./SAECovoiturage/proposerTrajet.php">Proposer un
                            trajet</a></li>'; } ?>
                    <li class="nav-item"><a class="nav-link active" href="#">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="./aPropos.php">À propos</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['user'])){
                        if ($_SESSION['nom'] === 'admin') {
                            echo '<a>Administrateur</a>';
                        } else {
                        echo '<a href="profil.php" class="btn btn-outline-primary">Mon profil</a>';
                        }
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

    <!-- Contenu principal -->
    <section class="container my-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Trajets disponibles</h1>
        </div>
    </section>
    <section class="container mb-5">
        <search>
            <div class="input-group mb-4">
                <form action="./trajet.php" method="GET" class="d-flex gap-2 w-100">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="text" name="depart" class="form-control" placeholder="Départ"
                                    value="<?php echo $depart ?>" />
                            </div>
                            <div class="col-6">
                                <input type="text" name="arrivee" class="form-control" placeholder="Arrivée"
                                    value="<?php echo $arrivee ?>" />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <input type="date" name="date" class="form-control" value="<?php echo $date ?>" />
                            </div>
                            <div class="col-6">
                                <input type="time" name="heure" class="form-control" value="<?php echo $heure ?>" />
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5"></div>
                            <div class="col-2">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary">Rechercher</button>
                                    <button onclick="window.location.href='./trajet.php'" type="reset"
                                        class="btn btn-secondary">Effacer
                                        la recherche</button>
                                </div>

                            </div>
                            <div class="col-5"></div>
                        </div>
                    </div>
            </div>
            </div>

            </form>
            </div>
        </search>
        <div id="liste" class="flex-container">
            <?php rechercherTrajets($depart, $arrivee, $date, $heure);?>
        </div>
    </section>

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
            window.location.href = "./../fichiers/php/reserver.php?id_trajet=" + trajetId;
        }
    });
    </script>

    <!-- Footer collé en bas -->
    <footer class="bg-light py-4 border-top text-center">
        <div class="container">
            <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>