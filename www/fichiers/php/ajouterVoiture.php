<?php
require(__DIR__.'/../../includes/pdo.php');
session_start();

// verifier si la voiture existe deja
$stmt = $pdo->prepare("SELECT * FROM VEHICULE WHERE immatriculation = :immatriculation");
$stmt->execute([':immatriculation' => $_POST['immatriculation']]);
if ($stmt->rowCount() > 0) {
    // La voiture existe deja
    echo "❌ Erreur : Cette immatriculation est déjà enregistrée.";
    exit();
}else {
$stmt = $pdo->prepare("INSERT INTO VEHICULE (id_utilisateur, marque, modele, immatriculation) VALUES (:id_utilisateur, :marque, :modele, :immatriculation)");
    $stmt->execute([
        ':id_utilisateur' => $_SESSION['user'],
        ':marque' => $_POST['marque'],
        ':modele' => $_POST['modele'],
        ':immatriculation' => $_POST['immatriculation']
        
    ]);
    echo "✅ Voiture ajoutée avec succès.";
    header('../../SAECovoiturage/profil.php');
}
?>