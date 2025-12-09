<?php
require('./../../includes/pdo.php');

// changerMDP.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ./../../SAECovoiturage/login.html');
        exit();
    }

    $userId = $_SESSION['user'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Vérifier que le nouveau mot de passe et la confirmation correspondent
    if ($newPassword !== $confirmNewPassword) {
        die('Le nouveau mot de passe et la confirmation ne correspondent pas.');
    }

    // Récupérer le mot de passe actuel de l'utilisateur
    $stmt = $pdo->prepare('SELECT mot_de_passe FROM UTILISATEUR WHERE id_utilisateur = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($currentPassword, $user['mot_de_passe'])) {
        die('Mot de passe incorrect.');
    }

    // Mettre à jour le mot de passe
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt = $pdo->prepare('UPDATE UTILISATEUR SET mot_de_passe = ? WHERE id_utilisateur = ?');
    $updateStmt->execute([$hashedNewPassword, $userId]);

    echo 'Mot de passe changé avec succès.';
    header('Location: ./../../SAECovoiturage/profil.php');
    exit();
} else {
    header('Location: ./../../SAECovoiturage/profil.php');
    exit();
}