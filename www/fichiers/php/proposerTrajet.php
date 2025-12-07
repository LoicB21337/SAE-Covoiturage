<?php
require('../../includes/pdo.php');
require('../../includes/session_start.php');
// Récupération des données du formulaire
$depart      = $_POST['depart'] ?? null;
$arrivee   = $_POST['arrivee'] ?? null;
$date      = $_POST['date'] ?? null;
$heure     = $_POST['heure'] ?? null;
$immatriculation    = $_POST['immatriculation'] ?? null;
$marque = $_POST['marque'] ?? null;
$modele  = $_POST['modele'] ?? null;
$nbr_places = $_POST['places'] ?? null;
$prix_place = $_POST['prix'] ?? null;
$user_id = $_SESSION['user'] ?? null;

// Vérification des champs
if ($depart && $arrivee && $date && $heure && $immatriculation && $marque && $modele && $nbr_places && $prix_place) {
    if (!$user_id) {
        echo "⚠️ Vous devez être connecté pour proposer un trajet.";
        exit;
    }
        $stmt = $pdo->query("SELECT id_utilisateur, id_vehicule FROM VEHICULE WHERE immatriculation = " . $pdo->quote($immatriculation));;
        $vehicule = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($vehicule['id_utilisateur']!=$user_id) {
            echo "⚠️ Erreur : Cette immatriculation est déjà enregistrée";
            exit;
        }
        if ($vehicule['id_vehicule']) {
            // Véhicule déjà existant, on peut récupérer son id si besoin
            $vehicule_id = $vehicule['id_vehicule'];
        } else {
            // Véhicule n'existe pas, on l'insère dans la base de données
            $stmt = $pdo->prepare("
            INSERT INTO VEHICULE (id_utilisateur, marque, modele, immatriculation)
            VALUES (:id_utilisateur, :marque, :modele, :immatriculation)
        ");

        // Exécution
        $stmt->execute([
            ':id_utilisateur'      => $user_id,
            ':marque'   => $marque,
            ':modele'      => $modele,
            ':immatriculation' => $immatriculation
        ]);
        }

        // Préparation de la requête sécurisée
        


        $stmt = $pdo->prepare("
            INSERT INTO TRAJET (id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix)
            VALUES (:id_conducteur, :depart, :arrivee, :date_depart, :nb_places_dispo, :prix)
        ");

        // Exécution
        $stmt->execute([
            ':id_conducteur'      => $user_id,
            ':depart'   => $depart,
            ':arrivee'      => $arrivee,
            ':date_depart' => $date . ' ' . $heure . ':00',
            ':nb_places_dispo' => $nbr_places,
            ':prix' => $prix_place
        ]);

        echo "✅ Trajet publié avec succès !";
    }else {
    echo "⚠️ Veuillez remplir tous les champs.";
}
?>