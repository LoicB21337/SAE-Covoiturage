<?php 
require(__DIR__.'/../../includes/pdo.php');

function rechercherTrajets($depart, $arrivee, $date, $heure) {
    global $pdo;
    if (!isset($_SESSION['user']) && $depart && $arrivee && $date && $heure) {
        $stmt = $pdo->prepare("SELECT id_trajet, id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix, prenom FROM TRAJET,UTILISATEUR WHERE TRAJET.id_conducteur = UTILISATEUR.id_utilisateur AND depart = ? AND arrivee = ? AND date_depart >= ?");
        $stmt->execute([$depart, $arrivee, $date . ' ' . $heure]);
    }elseif(!isset($_SESSION['user']) && (!$depart || !$arrivee || !$date || !$heure)) {
        $stmt = $pdo->prepare("SELECT id_trajet, id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix, prenom FROM TRAJET,UTILISATEUR WHERE TRAJET.id_conducteur = UTILISATEUR.id_utilisateur");
        $stmt->execute();
    }elseif(!$depart || !$arrivee || !$date || !$heure) {
        $stmt = $pdo->prepare("SELECT id_trajet, id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix, prenom FROM TRAJET,UTILISATEUR WHERE TRAJET.id_conducteur = UTILISATEUR.id_utilisateur AND id_utilisateur != ?");
        $stmt->execute([$_SESSION['user']]);
    }else {
        $stmt = $pdo->prepare("SELECT id_trajet, id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix, prenom FROM TRAJET,UTILISATEUR WHERE TRAJET.id_conducteur = UTILISATEUR.id_utilisateur AND id_utilisateur != ? AND depart = ? AND arrivee = ? AND date_depart >= ?");
        $stmt->execute([$_SESSION['user'], $depart, $arrivee, $date . ' ' . $heure]);
    }
    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    afficherTrajets($trajets);
}

function afficherTrajets($trajets) {
    if (!$trajets) {echo '<div>Aucun trajet disponible pour le moment.</div>';}
    foreach($trajets as $ligne) {  
    ?>

<div class="card h-100" id="trajet">
    <div class="card-body d-flex flex-column justify-content-between">
        <div>
            <h5 class="card-title"><?php echo $ligne['depart'] ." → " . $ligne['arrivee']; ?></h5>
            <p class="card-text text-muted small">
                <?php echo $ligne['date_depart'] . " • " . $ligne['nb_places_dispo'] . " place(s) • Conducteur : " . $ligne['prenom'];?>
            </p>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="fw-bold fs-5"><?php echo $ligne['prix'] . " €";?></span>
            <button class="btn btn-outline-primary btn-sm">Contacter</button>
        </div>
    </div>
</div>

<?php
    } 
}

?>