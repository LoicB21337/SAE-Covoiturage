<?php

require(__DIR__ . '/../../includes/pdo.php');
require(__DIR__ . '/../../includes/session_start.php');

$userId = (int) $_SESSION['user'];
$idToDelete = (int) $_GET['supprimer_trajet'] ?? null;


// Traitement de la suppression si demandé
if (isset($_GET['supprimer_trajet'])) {
    if ($idToDelete != null) {
        $del = $pdo->prepare("DELETE FROM TRAJET WHERE id_trajet = :id_trajet AND id_conducteur = :id_conducteur");
        $del->execute(['id_trajet' => $idToDelete, 'id_conducteur' => $userId]);
    }
    header("Location: ../../SAECovoiturage/profil.php");
    exit();
}

echo "Suppression du trajet ID : " . $idToDelete . "<br>";
echo "Utilisateur ID : " . $userId;