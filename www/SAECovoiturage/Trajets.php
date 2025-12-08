<?php
require('./../includes/session_start.php');
require('../fichiers/php/Trajets.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
    <link href="../fichiers/css/Trajets.css" rel="stylesheet" />
    <style>
    html,
    body {
        height: 100%; 
        /* occupe toute la hauteur */
    }

    body {
        display: flex;
        flex-direction: column;
        /* empile en colonne */
        min-height: 100vh;
        /* hauteur minimum = fenêtre */
    }

    main {
        flex: 1;
        /* prend tout l’espace dispo */
    }
    </style>
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
                    <li class="nav-item"><a class="nav-link active" href="proposerTrajet.php">Proposer un trajet</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">Trajets</a></li>
                    <li class="nav-item"><a class="nav-link" href="./aPropos.php">À propos</a></li>
                </ul>
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

    <!-- Contenu principal -->
    
    <h2 class="h4 fw-semibold mb-3">Trajets disponibles</h2>
        <section class="container mb-5">
        <div class="flex-container">

    <?php
    $trajets=$stmt -> fetchAll(PDO::FETCH_ASSOC );
    foreach($trajets as $ligne) {  
    ?>
        
            <div class="card h-100" id="trajet">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title"><?php echo $ligne['depart'] ." → " . $ligne['arrivee']; ?></h5>
                        <p class="card-text text-muted small">
                            <?php echo $ligne['date_depart'] . " • " . $ligne['nb_places_dispo'] . "place(s) • Conducteur : " . $ligne['prenom'];?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="fw-bold fs-5"><?php echo $ligne['prix'] . " €";?></span>
                        <button class="btn btn-outline-primary btn-sm">Contacter</button>
                    </div>
                </div>
            </div> <!-- Tu peux dupliquer ce bloc pour ajouter d'autres trajets -->

     <?php
    } 
    ?>
    </div>
    </section>

    <!-- Footer collé en bas -->
    <footer class="bg-light py-4 border-top text-center">
        <div class="container">
            <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>