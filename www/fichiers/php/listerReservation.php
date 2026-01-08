<?php 
require(__DIR__ . '/../../includes/pdo.php');

$stmt = $pdo->prepare('SELECT r.id_passager, t.date_depart, t.depart, t.arrivee, t.prix, t.id_trajet
                       FROM RESERVATION r
                       JOIN TRAJET t ON r.id_trajet = t.id_trajet
                       WHERE r.id_passager = :id_passager and t.date_depart >= Current_Date
                       ORDER BY t.date_depart DESC, t.date_depart DESC');

function listerReservations() {
    global $stmt;  

$stmt->execute(['id_passager' => $_SESSION['user']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($reservations)) {
    echo '<p>Vous n\'avez aucune réservation en cours.</p>';
    return;
}
foreach ($reservations as $reservation) {
    echo '<div class="card mb-3">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Trajet de ' . htmlspecialchars($reservation['depart']) . ' à ' . htmlspecialchars($reservation['arrivee']) . '</h5>';
    echo '<p class="card-text">Date de départ : ' . htmlspecialchars($reservation['date_depart']) . '</p>';
    echo '<p class="card-text">Prix par place : ' . htmlspecialchars($reservation['prix']) . ' €</p>';
    echo '<a href="trajet.php?id=' . htmlspecialchars($reservation['id_trajet']) . '" class="btn btn-primary">Voir le trajet</a>';
    echo '</div>';
    echo '</div>';
}
}
?>