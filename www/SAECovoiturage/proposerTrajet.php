<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Proposer un trajet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%; /* occupe toute la hauteur */
        }
        body {
            display: flex;
            flex-direction: column; /* empile en colonne */
            min-height: 100vh; /* hauteur minimum = fenêtre */
        }
        main {
            flex: 1; /* prend tout l’espace dispo */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../images/logo.png" alt="Way Together" height="60" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link active" href="proposerTrajet.php">Proposer un Trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Mes Réservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="signup.php" class="btn btn-outline-primary">S'inscrire</a>
                    <a href="login.php" class="btn btn-primary">Se connecter</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container mt-5">
        <h2 class="mb-4 text-center">Proposer un trajet</h2>
        <form class="row g-3">
            <div class="col-md-6">
                <label for="depart" class="form-label">Lieu de départ</label>
                <input type="text" class="form-control" id="depart" name="depart" placeholder="Paris" required>
            </div>
            <div class="col-md-6">
                <label for="arrivee" class="form-label">Lieu d'arrivée</label>
                <input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Lyon" required>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="col-md-6">
                <label for="heure" class="form-label">Heure</label>
                <input type="time" class="form-control" id="heure" name="heure" required>
            </div>
            <div class="col-md-6">
                <label for="places" class="form-label">Nombre de places</label>
                <input type="number" class="form-control" id="places" name="places" min="1" required>
            </div>
            <div class="col-md-6">
                <label for="prix" class="form-label">Prix d'une place (€)</label>
                <input type="number" class="form-control" id="prix" name="prix" min="0" step="0.01" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Publier le trajet</button>
            </div>
        </form>
    </main>

    <!-- Footer collé en bas -->
    <footer class="bg-light py-4 border-top text-center">
        <div class="container">
            <small class="text-muted">© 2025 Way Together — Tous droits réservés</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>