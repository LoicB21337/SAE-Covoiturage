<?php
require (__DIR__ . '/../../includes/pdo.php');
session_start();
$id_user = $_SESSION['user'] ?? null;
$id_trajet = $_POST['id_trajet'] ?? null;
$id_conducteur = $_POST['id_conducteur'] ?? null;
$note = $_POST['note'] ?? null;
$commentaire = $_POST['commentaire'] ?? null;


if ($id_user && $id_trajet && $note && $id_conducteur) {
    $stmt = $pdo->prepare('INSERT INTO AVIS (id_utilisateur, id_trajet, note, commentaire) VALUES (:id_utilisateur, :id_trajet, :note, :commentaire)');
    $stmt->execute([
        'id_utilisateur' => $id_user,
        'id_trajet' => $id_trajet,
        'note' => $note,
        'commentaire' => $commentaire
    ]);
    // Recalculate average note for the conducteur and update UTILISATEUR.note_moyenne
    $avgStmt = $pdo->prepare('SELECT AVG(a.note) AS avg_note FROM AVIS a JOIN TRAJET t ON a.id_trajet = t.id_trajet WHERE t.id_conducteur = :id_conducteur');
    $avgStmt->execute(['id_conducteur' => $id_conducteur]);
    $avg = $avgStmt->fetchColumn();
    if ($avg === null) $avg = 0;
    $update = $pdo->prepare('UPDATE UTILISATEUR SET moyenne_note = :avg WHERE id_utilisateur = :id_conducteur');
    $update->execute(['avg' => $avg, 'id_conducteur' => $id_conducteur]);

    header('Location: ../../SAECovoiturage/reservations.php');
    exit();
} else {
        header('Location: ../../SAECovoiturage/reservations.php?error=missing_data');
        exit();
}
?>