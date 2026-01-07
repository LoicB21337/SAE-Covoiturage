<?php
require('../../includes/pdo.php');

// Récupération des données du formulaire
$nom      = $_POST['nom'] ?? null;
$prenom   = $_POST['prenom'] ?? null;
$age      = $_POST['age'] ?? null;
$mail     = $_POST['email'] ?? null;
$phone    = $_POST['telephone'] ?? null;
$password = $_POST['mot_de_passe'] ?? null;
$confirm  = $_POST['confirm_password'] ?? null; // champ "réentrer votre mdp"


// Vérification des champs
if ($nom && $prenom && $age && $mail && $phone && $password && $confirm) {
    
    // Vérifier que le mail n'est pas déjà utilisé
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE email = :mail");
    $stmt->execute([':mail' => $mail]);
    if ($stmt->fetchColumn() == 0) {
        // Hashage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Préparation de la requête sécurisée
        $stmt = $pdo->prepare("
            INSERT INTO UTILISATEUR (nom, prenom, age, email, telephone, mot_de_passe, type_utilisateur) 
            VALUES (:nom, :prenom, :age, :mail, :phone, :password, 'utilisateur')
        ");

        // Exécution
        $stmt->execute([
            ':nom'      => $nom,
            ':prenom'   => $prenom,
            ':age'      => $age,
            ':mail'     => $mail,
            ':phone'    => $phone,
            ':password' => $hashedPassword
        ]);

        echo "✅ Compte créé avec succès !";
    } else {
        echo "❌ L'adresse email est déjà utilisée.";
    }
} else {
    echo "⚠️ Veuillez remplir tous les champs. ";
}
?>