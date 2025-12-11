<?php
require('../../includes/pdo.php');
require('../../includes/session_start.php');
// Récupération des données du formulaire
$depart      = $_POST['depart'] ?? null;
$arrivee   = $_POST['arrivee'] ?? null;
$date      = $_POST['date'] ?? null;
$heure     = $_POST['heure'] ?? null;
$immatriculation = $_POST['cars'] ?? null;
$nbr_places = $_POST['places'] ?? null;
$prix_place = $_POST['prix'] ?? null;
$user_id = $_SESSION['user'] ?? null;

// Vérification des champs
if ($depart && $arrivee && $date && $heure && $immatriculation && $nbr_places && $prix_place) {
    if (!$user_id) {
        echo "⚠️ Vous devez être connecté pour proposer un trajet.";
        exit;
    }else{
        // recuperer l'id du vehicule a partir de l'immatriculation
        $stmt = $pdo->prepare("SELECT id_vehicule FROM VEHICULE WHERE immatriculation = ?");
        $stmt->execute([$immatriculation]);
        $vehicule = $stmt->fetch();
        if (!$vehicule) {
            echo "⚠️ Véhicule non trouvé.";
            exit;
        }
        $vehicule_id = $vehicule['id_vehicule'];
        // Insertion du trajet dans la base de données
        $stmt = $pdo->prepare("INSERT INTO TRAJET (id_conducteur, id_vehicule, depart, arrivee, date_depart, nb_places_dispo, prix) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $vehicule_id, $depart, $arrivee, $date ." ". $heure, $nbr_places, $prix_place]);
        if ($stmt) {
            echo "✅ Trajet publié avec succès.";
        } else {
            echo "⚠️ Erreur lors de la proposition du trajet.";
        }
    }
}else {
    echo "⚠️ Veuillez remplir tous les champs.";
}
?>