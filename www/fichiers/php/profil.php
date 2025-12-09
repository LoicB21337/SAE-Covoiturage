<?php 
require('../includes/pdo.php');

$stmt = $pdo->query("SELECT nom, prenom, age, email, telephone, date_inscription FROM UTILISATEUR WHERE id_utilisateur = " . $_SESSION['user']);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$nom = $user['nom'];
$prenom = $user['prenom'];
$age = $user['age'];
$email = $user['email'];
$telephone = $user['telephone'];
$date_inscription = $user['date_inscription'];

$stmt = $pdo->query("SELECT depart, arrivee, date_depart, nb_places_dispo, prix FROM TRAJET WHERE id_conducteur = " . $_SESSION['user']);
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

function afficherTrajets($trajets) {
    foreach ($trajets as $trajet) {
        echo "<li class='list-group-item'>";
        echo "<strong>Départ :</strong> " . htmlspecialchars($trajet['depart']) . "<br>";
        echo "<strong>Arrivée :</strong> " . htmlspecialchars($trajet['arrivee']) . "<br>";
        echo "<strong>Date de départ :</strong> " . htmlspecialchars($trajet['date_depart']) . "<br>";
        echo "<strong>Places disponibles :</strong> " . htmlspecialchars($trajet['nb_places_dispo']) . "<br>";
        echo "<strong>Prix :</strong> " . htmlspecialchars($trajet['prix']) . " €";
        echo "</li>";
    }
}

?>