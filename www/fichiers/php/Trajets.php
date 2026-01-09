<?php 
require(__DIR__.'/../../includes/pdo.php');

function rechercherTrajets($depart = null, $arrivee = null, $date = null, $heure = null) {
    global $pdo;

    $sql = "SELECT
                t.id_trajet, t.id_conducteur, t.depart, t.arrivee, t.date_depart,
                t.nb_places_dispo, t.prix, u.prenom
            FROM TRAJET t
            JOIN UTILISATEUR u ON t.id_conducteur = u.id_utilisateur
            WHERE t.nb_places_dispo > 0";
    $params = [];

    // Exclure les trajets de l'utilisateur connecté
    if (isset($_SESSION['user']) && $_SESSION['user'] !== '') {
        $sql .= " AND t.id_conducteur != ?";
        $params[] = $_SESSION['user'];
    }

    // Départ
    if (!empty($depart)) {
        $sql .= " AND UPPER(TRIM(t.depart)) like UPPER(TRIM(?))";
        $params[] = "%" . $depart . "%";
    }

    // Arrivée
    if (!empty($arrivee)) {
        $sql .= " AND UPPER(TRIM(t.arrivee)) like UPPER(TRIM(?))";
        $params[] = "%" . $arrivee . "%";
    }

    // Gestion date/heure
    if (!empty($date) && !empty($heure)) {
        // Date + heure → seuil exact
        // Normaliser l'heure en HH:MM:SS
        if (preg_match('/^\d{2}:\d{2}$/', $heure)) {
            $heure .= ":00";
        }
        $threshold = $date . " " . $heure;
        $sql .= " AND t.date_depart >= ?";
        $params[] = $threshold;

    } elseif (!empty($date) && empty($heure)) {
        // Date seule → toute la journée
        $start = $date . " 00:00:00";
        $sql .= " AND t.date_depart >= ?";
        $params[] = $start;

    } elseif (empty($date) && !empty($heure)) {
        // Heure seule → aujourd'hui à partir de cette heure
        if (preg_match('/^\d{2}:\d{2}$/', $heure)) {
            $heure .= ":00";
        }
        $today = date('Y-m-d');
        $threshold = $today . " " . $heure;
        $sql .= " AND t.date_depart >= ?";
        $params[] = $threshold;

    } else {
        // Aucun paramètre → trajets futurs
        $sql .= " AND t.date_depart >= CURRENT_TIMESTAMP";
    }

    $sql .= " ORDER BY t.date_depart ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    afficherTrajets($trajets);
}

function afficherTrajets($trajets) {
    if (!$trajets) {echo '<div>Aucun trajet disponible pour le moment.</div>';}else{
    $cpt=0;
    foreach($trajets as $ligne) {
    ?>

<div class="card h-70" id="trajet">
    <div class="card-body d-flex flex-column justify-content-between">
        <a href="trajetDetails.php?id_trajet=<?php echo $ligne['id_trajet']; ?>" class="text-decoration-none text-dark">
            <h5 class="card-title"><?php echo $ligne['depart'] ." → " . $ligne['arrivee']; ?></h5>
        </a>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <p class="card-text text-muted small">
                <?php echo $ligne['date_depart'] . " • " . $ligne['nb_places_dispo'] . " place(s) • Conducteur : " . $ligne['prenom'];?>
            </p>
            <?php if(isset($_SESSION['user']) && $_SESSION['nom'] !== 'admin'){?>
            <button onclick="openReservationPopup(
                <?php echo $ligne['id_trajet'] . ", '" . $ligne['depart']. " → ". $ligne['arrivee'] ; ?>')"
                class="btn btn-outline-primary btn-primary">
                Réserver
            </button>
            <?php }elseif (isset($_SESSION['user']) && basename($_SERVER['PHP_SELF'], ".php") == 'trajet') { ?>
            <a href="/fichiers/php/supprimerTrajet.php?supprimer_trajet=<?php echo $ligne['id_trajet']; ?>"
                class="btn btn-danger btn-danger">
                Supprimer
            </a>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="fw-bold fs-5"><?php echo $ligne['prix'] . " €";?></span>
            <!-- Si la page est la page d'accueil ne pas afficher -->
            <?php if (basename($_SERVER['PHP_SELF'], ".php") == 'trajet') { ?>
            <a href="trajetDetails.php?id_trajet=<?php echo $ligne['id_trajet']; ?>"
                class="btn btn-outline-primary btn-sm">Voir les détails</a>
            <?php } else { ?>
            <a href="./SAECovoiturage/trajetDetails.php?id_trajet=<?php echo $ligne['id_trajet']; ?>"
                class="btn btn-outline-primary btn-sm">Voir les détails</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php
    $cpt++;
    }
}
}
?>