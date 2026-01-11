<?php 
require(__DIR__ . '/../../includes/pdo.php');

$userId = (int) $_SESSION['user'];

// Récupération des informations utilisateur (requête préparée)
$stmt = $pdo->prepare("SELECT nom, prenom, age, email, telephone, date_inscription FROM UTILISATEUR WHERE id_utilisateur = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Utilisateur introuvable
    header('Location: ../../SAECovoiturage/login.html');
    exit();
}

$nom = $user['nom'];
$prenom = $user['prenom'];
$age = $user['age'];
$email = $user['email'];
$telephone = $user['telephone'];
$date_inscription = $user['date_inscription'];

// Récupération des trajets du conducteur
$stmt = $pdo->prepare("SELECT id_trajet, depart, arrivee, date_depart, nb_places_dispo, prix FROM TRAJET WHERE id_conducteur = :id");
$stmt->execute(['id' => $userId]);
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculer la note moyenne reçue pour les trajets de cet utilisateur
$avgStmt = $pdo->prepare('SELECT AVG(a.note) AS avg_note, COUNT(a.id_avis) AS nb_avis FROM AVIS a JOIN TRAJET t ON a.id_trajet = t.id_trajet WHERE t.id_conducteur = :id');
$avgStmt->execute(['id' => $userId]);
$avgRow = $avgStmt->fetch(PDO::FETCH_ASSOC);
$note_moyenne = $avgRow && $avgRow['avg_note'] !== null ? round((float)$avgRow['avg_note'], 2) : null;
$nb_avis = $avgRow ? (int)$avgRow['nb_avis'] : 0;

// Récupérer la liste des commentaires reçus (avec auteur et trajet)
$comStmt = $pdo->prepare('SELECT a.note, a.commentaire, a.date_avis, a.id_trajet, t.depart, t.arrivee, u.nom AS auteur_nom, u.prenom AS auteur_prenom FROM AVIS a JOIN TRAJET t ON a.id_trajet = t.id_trajet JOIN UTILISATEUR u ON a.id_utilisateur = u.id_utilisateur WHERE t.id_conducteur = :id ORDER BY a.date_avis DESC');
$comStmt->execute(['id' => $userId]);
$commentaires = $comStmt->fetchAll(PDO::FETCH_ASSOC);

function afficherTrajets($trajets) {
    if (empty($trajets)) {
        echo "<p>Aucun trajet proposé.</p>";
        return;
    }
    foreach ($trajets as $trajet) {
        ?>
<li class="list-group-item">
    <strong>Départ :</strong> <?= htmlspecialchars($trajet['depart']) ?><br>
    <strong>Arrivée :</strong> <?= htmlspecialchars($trajet['arrivee']) ?><br>
    <strong>Date de départ :</strong> <?= htmlspecialchars($trajet['date_depart']) ?><br>
    <strong>Places disponibles :</strong> <?= htmlspecialchars($trajet['nb_places_dispo']) ?><br>
    <strong>Prix :</strong> <?= htmlspecialchars($trajet['prix']) ?> €
    <div class="row mt-2">
        <div class="col-md-1">
            <a href=" ..\fichiers\php\supprimerTrajet.php?supprimer_trajet=<?= $trajet['id_trajet'] ?>"
                class="btn btn-danger" onclick="return confirm('Supprimer ce trajet ?');">
                Supprimer
            </a>

        </div>
    </div>
</li>
<?php
    }
}

?>