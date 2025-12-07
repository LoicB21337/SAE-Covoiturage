<?php
require('../../includes/pdo.php');

$mail     = $_POST['mail'] ?? null;
$password = $_POST['password'] ?? null;

if ($mail && $password) {
    $stmt = $pdo->prepare("SELECT id_utilisateur, nom, prenom, email, mot_de_passe FROM UTILISATEUR WHERE email = :mail");
    $stmt->execute([':mail' => $mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['mot_de_passe'])) {
            session_start();
            $_SESSION['user'] = $user['id_utilisateur'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['prenom'] = $user['prenom'];
            echo "✅ Connexion réussie. Bienvenue " . htmlspecialchars($user['prenom']) . "!";
        } else {
            echo "❌ Mot de passe incorrect.";
        }
    } else {
        echo "❌ Aucun compte trouvé avec cet email.";
    }
} else {
    echo "⚠️ Veuillez remplir tous les champs.";
}
?>