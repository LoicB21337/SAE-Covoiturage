<?php
require(__DIR__ . '/../../includes/pdo.php');
session_start();
$id_trajet = $_GET['id'] ?? null;
$stmt = $pdo->prepare('DELETE FROM RESERVATION WHERE id_passager = :id_passager AND id_trajet = :id_trajet');
$stmt->execute(['id_passager' => $_SESSION['user'], 'id_trajet' => $id_trajet]);
// Ajout d'une place disponible dans le trajet
$stmt2 = $pdo->prepare('UPDATE TRAJET SET nb_places_dispo = nb_places_dispo + 1 WHERE id_trajet = :id_trajet');
$stmt2->execute(['id_trajet' => $id_trajet]);
// Redirection vers la page des réservations
header('Location: ../../SAECovoiturage/reservations.php');
exit();
?>