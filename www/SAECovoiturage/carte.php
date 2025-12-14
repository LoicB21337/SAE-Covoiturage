<?php
require_once('./../includes/session_start.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="../images/icon.png">
    <title>Way Together — Carte</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CSS personnalisé -->
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/navbar.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
    <link href="../fichiers/css/map.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
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
                    <li class="nav-item"><a class="nav-link active" href="./carte.php">Carte</a></li>
                    <li class="nav-item"><a class="nav-link" href="./proposerTrajet.php">Proposer un trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="./trajet.php">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="./aPropos.php">À propos</a></li>
                </ul>


                <!-- Boutons -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['user'])){
                        echo '<a href="profil.php" class="btn btn-outline-primary">Mon profil</a>';
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

    <div id="map"></div>

    <script>
    var map = L.map("map").setView([49.9, 2.3], 13);

    // Fond de carte OpenStreetMap
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
    }).addTo(map);

    // Contrôle de routage
    L.Routing.control({
        waypoints: [
            L.latLng(49.9, 2.3), // Départ
            L.latLng(49.91, 2.25), // Arrivée
        ],
        routeWhileDragging: true,
        show: false, // cache le panneau directions
        createMarker: function(i, wp, nWps) {
            var label = i === 0 ? "Départ" : "Arrivée";

            // Crée le marqueur avec popup ouverte et non fermable
            var marker = L.marker(wp.latLng, {
                draggable: false
            }).bindPopup(
                label, {
                    autoClose: false,
                    closeOnClick: false,
                    closeButton: false,
                }
            );

            // Ouvre la popup immédiatement
            marker.openPopup();

            return marker;
        },
    }).addTo(map);
    </script>
</body>
<footer class="bg-light py-4 mt-auto border-top text-center">
    <div class="container">
        <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
    </div>
</footer>

</html>