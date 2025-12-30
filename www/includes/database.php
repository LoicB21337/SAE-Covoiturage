<?php
require('./pdo.php');
// creation de la base de donnees

// "UTILISATEUR(id_utilisateur, nom, prenom, age, email, mot_de_passe, telephone, type_utilisateur, date_inscription, moyenne_note)

// VEHICULE(id_vehicule, #id_utilisateur, marque, modele, immatriculation, nb_places)

// TRAJET(id_trajet, #id_conducteur, depart, arrivee, date_depart, nb_places, prix)

// RESERVATION(#id_trajet, #id_passager, date_reservation, statut)

// AVIS(id_avis, #id_trajet, #id_utilisateur, note, commentaire, date_avis)"

$pdo->exec("DROP TABLE IF EXISTS VEHICULE;");
$pdo->exec("DROP TABLE IF EXISTS RESERVATION;");
$pdo->exec("DROP TABLE IF EXISTS AVIS;");
$pdo->exec("DROP TABLE IF EXISTS TRAJET;");
$pdo->exec("DROP TABLE IF EXISTS UTILISATEUR;");
$pdo->exec("CREATE TABLE UTILISATEUR(
    id_utilisateur INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telephone VARCHAR(15) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    type_utilisateur ENUM('utilisateur', 'admin') NOT NULL,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    moyenne_note FLOAT DEFAULT 0
);");
$pdo->exec("CREATE TABLE VEHICULE(
    id_vehicule INT PRIMARY KEY AUTO_INCREMENT,
    id_utilisateur INT,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    immatriculation VARCHAR(20) NOT NULL UNIQUE,
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE
);");
$pdo->exec("CREATE TABLE TRAJET(
    id_trajet INT PRIMARY KEY AUTO_INCREMENT,
    id_conducteur INT,
    id_vehicule INT,
    depart VARCHAR(100) NOT NULL,
    arrivee VARCHAR(100) NOT NULL,
    date_depart DATETIME NOT NULL,
    nb_places_dispo INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_conducteur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_vehicule) REFERENCES VEHICULE(id_vehicule) ON DELETE CASCADE
);");
$pdo->exec("CREATE TABLE RESERVATION(
    id_trajet INT,
    id_passager INT,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'confirmee', 'annulee') NOT NULL,
    PRIMARY KEY (id_trajet, id_passager),
    FOREIGN KEY (id_trajet) REFERENCES TRAJET(id_trajet),
    FOREIGN KEY (id_passager) REFERENCES UTILISATEUR(id_utilisateur)
);");
$pdo->exec("CREATE TABLE AVIS(
    id_avis INT PRIMARY KEY AUTO_INCREMENT,
    id_trajet INT,
    id_utilisateur INT,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_trajet) REFERENCES TRAJET(id_trajet) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur) REFERENCES UTILISATEUR(id_utilisateur) ON DELETE CASCADE
);");
echo "Base de donnees creee avec succes.";
?>