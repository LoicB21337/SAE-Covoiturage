<?php
session_start();

// Supprime toutes les variables de session
$_SESSION = [];

// Détruit la session côté serveur
session_destroy();

// Supprime le cookie de session côté client
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Redirige vers l'accueil
header("Location: ./../../../index.php");
exit;
?>