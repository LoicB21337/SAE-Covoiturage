<?php 
include('./../../includes/session_start.php');
include('./../../includes/pdo.php');

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    // Suppression de l'utilisateur de la base de données
    $stmt = $pdo->prepare("DELETE FROM UTILISATEUR WHERE id_utilisateur = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();

    // Destruction de la session
    session_unset();
    session_destroy();

    // Redirection vers la page d'accueil ou une autre page appropriée
    header("Location: ./../../index.php");
    exit();
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: ./../../../SAECovoiturage/login.html");
    exit();
}