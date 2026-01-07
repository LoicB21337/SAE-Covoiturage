<?php

require(__DIR__ . '/../../includes/pdo.php');
require(__DIR__ . '/../../includes/session_start.php');


$idToDelete = (int) $_GET['supprimer_trajet'] ?? null;


// Traitement de la suppression si demandé
if (isset($_GET['supprimer_trajet'])) {
    if ($idToDelete != null) {
        $del = $pdo->prepare("DELETE FROM TRAJET WHERE id_trajet = :id_trajet");
        $del->execute(['id_trajet' => $idToDelete]);
    }
    if ($_SESSION['nom'] !== 'admin') {
        header("Location: ../../SAECovoiturage/profil.php");
    } else {
        header("Location: ../../SAECovoiturage/trajet.php");
    }
    exit();
}

echo "Suppression du trajet ID : " . $idToDelete . "<br>";
echo "Utilisateur ID : " . $userId;