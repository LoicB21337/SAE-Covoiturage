<?php
require(__DIR__.'/../../includes/pdo.php');
require(__DIR__.'/../../includes/session_start.php');

# reservation d'un trajet
if (isset($_GET['id_trajet']) && isset($_SESSION['user'])) {
    $id_trajet = $_GET['id_trajet'];
    $id_passager = $_SESSION['user'];

    // Vérifier la disponibilité des places
    $stmt = $pdo->prepare("SELECT nb_places_dispo FROM TRAJET WHERE id_trajet = ?");
    $stmt->execute([$id_trajet]);
    $trajet = $stmt->fetch();

    if ($trajet && $trajet['nb_places_dispo'] > 0) {
        // Réserver le trajet : insérer dans RESERVATION et décrémenter les places dispo
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO RESERVATION (id_trajet, id_passager, date_reservation) VALUES (?, ?, NOW())");
            $stmt->execute([$id_trajet, $id_passager]);

            $stmt = $pdo->prepare("UPDATE TRAJET SET nb_places_dispo = nb_places_dispo - 1 WHERE id_trajet = ?");
            $stmt->execute([$id_trajet]);

            $pdo->commit();
            header("Location: ./../../SAECovoiturage/profil.php?reservation=success");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: ./../../SAECovoiturage/trajet.php?reservation=error");
            exit();
        }
    } else {
        // Pas de places dispo
        header("Location: ./../../SAECovoiturage/trajet.php?reservation=full");
        exit();
    }
} else {
    // Paramètres manquants
    header("Location: ./../../SAECovoiturage/trajet.php?reservation=invalid");
    exit();
}