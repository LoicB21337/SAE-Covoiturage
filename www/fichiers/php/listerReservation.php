<?php
require_once __DIR__ . '/../../includes/pdo.php';

 $stmt = $pdo->prepare('SELECT r.id_passager, t.date_depart, t.depart, t.arrivee, t.prix, t.id_trajet,
                                            u.id_utilisateur AS conducteur_id, u.nom AS conducteur_nom, u.prenom AS conducteur_prenom,
                                            a.id_avis AS avis_id, a.note AS avis_note, a.commentaire AS avis_commentaire, a.date_avis AS avis_date
                                            FROM RESERVATION r
                                            JOIN TRAJET t ON r.id_trajet = t.id_trajet
                                            JOIN UTILISATEUR u ON t.id_conducteur = u.id_utilisateur
                                            LEFT JOIN AVIS a ON a.id_trajet = t.id_trajet AND a.id_utilisateur = r.id_passager
                                            WHERE r.id_passager = :id_passager
                                            ORDER BY (t.date_depart >= CURDATE()) DESC,
                                                       CASE WHEN t.date_depart >= CURDATE() THEN t.date_depart END,
                                                       t.date_depart ASC');

function listerReservations() {
    global $stmt;  

$stmt->execute(['id_passager' => $_SESSION['user']]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($reservations)) {
    echo '<p>Vous n\'avez aucune réservation en cours.</p>';
    return;
}
// split into upcoming and past reservations
$upcoming = [];
$past = [];
foreach ($reservations as $reservation) {
    $depDate = date('Y-m-d', strtotime($reservation['date_depart']));
    if ($depDate >= date('Y-m-d')) {
        $upcoming[] = $reservation;
    } else {
        $past[] = $reservation;
    }
}

// sort upcoming by date desc (most recent first)
usort($upcoming, function($a, $b){
    return strtotime($b['date_depart']) - strtotime($a['date_depart']);
});
// sort past by date desc (most recent past first)
usort($past, function($a, $b){
    return strtotime($b['date_depart']) - strtotime($a['date_depart']);
});

// helper to render a reservation card
function renderReservationCard($reservation, $isPast = false, $avis = null) {
    $grayed = ($avis !== null);
    $cardStyle = $grayed ? 'style="opacity:0.65;background-color:#f8f9fa;"' : '';

    echo '<div class="card mb-3" ' . $cardStyle . '>';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">Trajet de ' . htmlspecialchars($reservation['depart']) . ' à ' . htmlspecialchars($reservation['arrivee']) . '</h5>';
    echo '<p class="card-text">Date de départ : ' . htmlspecialchars($reservation['date_depart']) . '</p>';
    echo '<p class="card-text">Prix par place : ' . htmlspecialchars($reservation['prix']) . ' €</p>';
    echo '<p class="card-text">Conducteur : ' . htmlspecialchars(trim($reservation['conducteur_prenom'] . ' ' . $reservation['conducteur_nom'])) . '</p>';

    $uid = htmlspecialchars($reservation['id_trajet']);
    $cid = htmlspecialchars($reservation['conducteur_id']);

    if ($isPast && $avis === null) {
        // past and not yet rated: show rating form
        echo '<form method="POST" action="../fichiers/php/noteReservation.php">';
        echo '<div style="display:flex;align-items:flex-start;gap:1rem;">';
        echo '<div id="rating-'. $uid .'" style="display:flex;flex-direction:column;align-items:flex-start;">';
        echo '<div class="rating" style="font-size:1.5rem;">';
        echo '<span data-value="5">★</span>';
        echo '<span data-value="4">★</span>';
        echo '<span data-value="3">★</span>';
        echo '<span data-value="2">★</span>';
        echo '<span data-value="1">★</span>';
        echo '</div>';
        echo '</div>';
        echo '<textarea name="commentaire" placeholder="Laisser un commentaire..." rows="3" style="flex:1;resize:vertical;padding:0.5rem;border:1px solid #ccc;border-radius:4px;"></textarea>';
        echo '</div>';
        echo '<input type="hidden" name="note" id="note-'. $uid .'">';
        echo '<input type="hidden" name="id_trajet" value="'. $uid .'">';
        echo '<input type="hidden" name="id_conducteur" value="'. $cid .'">';
        echo '<button type="submit" class="btn btn-primary mt-3">Envoyer la note</button>';
        echo '</form>';
    } elseif ($isPast && $avis !== null) {
        // past and already rated: show readonly info
        echo '<div class="mt-2">';
        echo '<p class="mb-1"><strong>Votre note :</strong> ' . htmlspecialchars($avis['avis_note']) . ' / 5</p>';
        if (!empty($avis['avis_commentaire'])) {
            echo '<p class="mb-1"><strong>Commentaire :</strong> ' . nl2br(htmlspecialchars($avis['avis_commentaire'])) . '</p>';
        }
        if (!empty($avis['avis_date'])) {
            echo '<p class="text-muted small">Posté le ' . htmlspecialchars($avis['avis_date']) . '</p>';
        }
        echo '</div>';
    } else {
        // upcoming
        echo '<a href="trajetDetails.php?id_trajet=' . htmlspecialchars($reservation['id_trajet']) . '" class="btn btn-primary">Voir le trajet</a>';
        echo '<a href="../fichiers/php/supprimerReservation.php?id=' . htmlspecialchars($reservation['id_trajet']) . '" class="btn btn-danger ms-2">Supprimer la réservation</a>';
    }
    
    echo '</div>';
    echo '</div>';

    // only include star JS for rating forms
    if ($isPast && $avis === null) {
        echo '<script>';
        echo '(function() {';
        echo '  const uid = "'. $uid .'";';
        echo '  const container = document.getElementById("rating-" + uid);';
        echo '  if (!container) return;';
        echo '  const stars = container.querySelectorAll(".rating span");';
        echo '  const noteInput = document.getElementById("note-" + uid);';
        echo '';
        echo '  stars.forEach(star => {';
        echo '    star.addEventListener("mouseover", function() {';
        echo '      resetHover();';
        echo '      highlightStars(this.dataset.value);';
        echo '    });';
        echo '';
        echo '    star.addEventListener("mouseout", function() {';
        echo '      resetHover();';
        echo '      if (noteInput.value) highlightStars(noteInput.value);';
        echo '    });';
        echo '';
        echo '    star.addEventListener("click", function() {';
        echo '      noteInput.value = this.dataset.value;';
        echo '      resetSelected();';
        echo '      highlightStars(this.dataset.value, true);';
        echo '    });';
        echo '  });';

        echo '  function highlightStars(value, select = false) {';
        echo '    stars.forEach(s => {';
        echo '      if (s.dataset.value <= value) {';
        echo '        s.classList.add(select ? "selected" : "hover");';
        echo '      } else {';
        echo '        s.classList.remove("hover", "selected");';
        echo '      }';
        echo '    });';
        echo '  }';

        echo '  function resetHover() {';
        echo '    stars.forEach(s => s.classList.remove("hover"));';
        echo '  }';

        echo '  function resetSelected() {';
        echo '    stars.forEach(s => s.classList.remove("selected"));';
        echo '  }';

        echo '})();';
        echo '</script>';
    }
}

// render tabs
echo '<ul class="nav nav-tabs" id="reservationsTab" role="tablist">';
echo '<li class="nav-item" role="presentation">';
echo '<button class="nav-link active" id="avenir-tab" data-bs-toggle="tab" data-bs-target="#avenir" type="button" role="tab" aria-controls="avenir" aria-selected="true">À venir</button>';
echo '</li>';
echo '<li class="nav-item" role="presentation">';
echo '<button class="nav-link" id="passees-tab" data-bs-toggle="tab" data-bs-target="#passees" type="button" role="tab" aria-controls="passees" aria-selected="false">Passées</button>';
echo '</li>';
echo '</ul>';

echo '<div class="tab-content mt-3" id="reservationsTabContent">';
// upcoming tab
echo '<div class="tab-pane fade show active" id="avenir" role="tabpanel" aria-labelledby="avenir-tab">';
if (empty($upcoming)) {
    echo '<p>Aucune réservation à venir.</p>';
} else {
    foreach ($upcoming as $res) {
        renderReservationCard($res, false);
    }
}
echo '</div>';

// past tab: split past into not-rated and rated
echo '<div class="tab-pane fade" id="passees" role="tabpanel" aria-labelledby="passees-tab">';
$past_not_rated = array_filter($past, function($r){ return empty($r['avis_id']); });
$past_rated = array_filter($past, function($r){ return !empty($r['avis_id']); });

if (empty($past_not_rated) && empty($past_rated)) {
    echo '<p>Aucune réservation passée.</p>';
} else {
    if (empty($past_not_rated)) {
        echo '<p>Aucune réservation passée à noter.</p>';
    } else {
        foreach ($past_not_rated as $res) {
            renderReservationCard($res, true, null);
        }
    }

    // already rated: append at the end, grayed and readonly
    if (!empty($past_rated)) {
        foreach ($past_rated as $res) {
            $avis = [
                'avis_id' => $res['avis_id'] ?? null,
                'avis_note' => $res['avis_note'] ?? null,
                'avis_commentaire' => $res['avis_commentaire'] ?? null,
                'avis_date' => $res['avis_date'] ?? null,
            ];
            renderReservationCard($res, true, $avis);
        }
    }
}
echo '</div>';

echo '</div>';
}
?>