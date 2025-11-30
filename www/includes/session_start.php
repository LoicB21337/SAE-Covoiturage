<?php
// Ce fichier est à inclure en haut de toutes les pages

session_start();

// Tu peux aussi initialiser des variables globales ici si besoin
if (!isset($_SESSION['initialized'])) {
    $_SESSION['initialized'] = true;
}