<?php 
require('../includes/pdo.php');


$stmt = $pdo->query("SELECT id_trajet, id_conducteur, depart, arrivee, date_depart, nb_places_dispo, prix, prenom FROM TRAJET,UTILISATEUR WHERE TRAJET.id_conducteur = UTILISATEUR.id_utilisateur AND id_utilisateur != " . $_SESSION['user']);
?>