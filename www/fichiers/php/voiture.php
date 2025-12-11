<?php
require(__DIR__.'/../../includes/pdo.php');

function afficherVoitures() {
    global $pdo;
    $stmt = $pdo->query("SELECT marque, modele, immatriculation FROM VEHICULE WHERE id_utilisateur = " . $_SESSION['user']);
    $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($voitures as $voiture) {
        echo "<li class='list-group-item'>";
        echo "<strong>Marque :</strong> " . htmlspecialchars($voiture['marque']) . "<br>";
        echo "<strong>Modèle :</strong> " . htmlspecialchars($voiture['modele']) . "<br>";
        echo "<strong>Immatriculation :</strong> " . htmlspecialchars($voiture['immatriculation']);
        echo "</li>";
    }
}