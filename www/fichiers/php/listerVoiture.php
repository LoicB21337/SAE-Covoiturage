<?php
require(__DIR__.'/../../includes/pdo.php');

function listerVoitures() {
    global $pdo;
    $stmt = $pdo->query("SELECT marque, modele, immatriculation FROM VEHICULE WHERE id_utilisateur = " . $_SESSION['user']);
    $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($voitures)) {
        echo '<option value="">Aucun véhicule enregistré</option>';
        return;
    }
    foreach ($voitures as $voiture) {
        echo '<option value="'.$voiture['immatriculation'].'">'.$voiture['marque']." ".$voiture['modele']." (".$voiture['immatriculation'].') </option>';
    }
}