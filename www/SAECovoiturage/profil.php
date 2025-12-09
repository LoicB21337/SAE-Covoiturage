<?php
require('../includes/session_start.php');
require('../fichiers/php/profil.php');
?>

<!DOCTYPE html>
<html lang="fr">

<header>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Profil Utilisateur</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/mdpPopup.css" rel="stylesheet" />
</header>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 px-4 shadow-sm">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="./../index.php">
                <img src="./../images/logo.png" alt="Way Together" height="60" />
            </a>

            <!-- Bouton hamburger pour mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenu de la navbar -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Liens -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="./../index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="./carte.php">Carte</a></li>
                    <li class="nav-item"><a class="nav-link" href="./proposerTrajet.php">Proposer un trajet</a></li>
                    <li class="nav-item"><a class="nav-link" href="./trajet.php">Mes Réservations</a></li>
                    <li class="nav-item"><a class="nav-link" href="./aPropos.php">À propos</a></li>
                </ul>


                <!-- Boutons -->
                <div class="d-flex align-items-center gap-2">
                    <?php if (isset($_SESSION['user'])){
                        echo '<a href="#" class="btn btn-outline-primary">Mon profil</a>';
                        echo '<a href="../fichiers/php/deconnexion.php" class="btn btn-primary">Se déconnecter</a>';
                    }else {
                        echo '<a href="./signup.html" class="btn btn-outline-primary">S\'inscrire</a>';
                        echo '<a href="./login.html" class="btn btn-primary">Se connecter</a>';
                    }
                      ?>
                </div>
            </div>
        </div>
    </nav>

    <head class="profile-header">
        <div class="container text-center py-4">
            <h2 id="username">Nom d'utilisateur</h2>
            <a href="../fichiers/php/supprimerCompte.php" class="btn btn-danger ms-2">Supprimer le compte</a>
            <a href="../fichiers/php/deconnexion.php" class="btn btn-danger ms-2">Déconnexion</a>
        </div>
    </head>

    <!-- Contenu principal -->
    <main class="container mt-5">
        <div class="row">
            <!-- Informations personnelles -->
            <section class="col-md-6 mb-4">
                <h3>Informations personnelles</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nom :</strong> <span
                            id="user-lastname"><?php echo $nom ?></span>
                    </li>
                    <li class="list-group-item"><strong>Prénom :</strong> <span
                            id="user-firstname"><?php echo $prenom ?></span></li>
                    <li class="list-group-item"><strong>Age :</strong> <span id="user-address"><?php echo $age ?></span>
                    </li>
                </ul>
            </section>

            <!-- Paramètres du compte -->
            <section class="col-md-6 mb-4">
                <h3>Informations du compte</h3>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Adresse mail :</strong> <?php echo $email ?> </li>
                    <li class="list-group-item"><strong>N° de téléphone</strong> <?php echo $telephone ?> </li>
                    <li class="list-group-item"><strong>Date d'inscription :</strong> <?php echo $date_inscription ?>
                    </li>
                </ul>
                <button onclick="openPopup()" class="btn btn-warning mt-3" id="changePasswordBtn">Changer le mot de
                    passe</button>
            </section>
        </div>

        <div class="overlay" id="overlay">
            <div class="popup">
                <h3>Changer le mot de passe</h3>
                <form action="../fichiers/php/changerMdp.php" method="POST" id="changePasswordForm">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Mot de passe actuel</label>
                        <input type="password" class="form-control" id="currentPassword" name="currentPassword"
                            required />
                    </div>
                    <p id="serverResponse"></p>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nouveau mot de passe</label>
                        <input type="password" id="password" class="form-control" id="newPassword" name="newPassword"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirmer le nouveau
                            mot de passe</label>
                        <input type="password" id="confirm_password" class="form-control" id="confirmNewPassword"
                            name="confirmNewPassword" required />
                    </div>
                    <p id="message"></p>
                    <button type="submit" id="submitBtn" class="btn btn-primary">Valider</button>
                    <button class="btn btn-primary" onclick="closePopup()">Fermer</button>
            </div>
        </div>

        <script>
        function openPopup() {
            document.getElementById("overlay").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("overlay").style.display = "none";
        }
        </script>

        <script>
        const password = document.getElementById("password");
        const confirm = document.getElementById("confirm_password");
        const message = document.getElementById("message");
        const submitBtn = document.getElementById("submitBtn");

        function checkPasswords() {
            if (confirm.value === "") {
                message.textContent = "";
                submitBtn.disabled = true;
            } else if (password.value === confirm.value) {
                message.textContent = "✅ Les mots de passe correspondent";
                message.style.color = "green";
                submitBtn.disabled = false; // bouton activé
            } else {
                message.textContent = "❌ Les mots de passe ne correspondent pas";
                message.style.color = "red";
                submitBtn.disabled = true; // bouton désactivé
            }
        }

        password.addEventListener("input", checkPasswords);
        confirm.addEventListener("input", checkPasswords);
        </script>

        <script>
        const form = document.getElementById("changePasswordForm");
        const serverResponse = document.getElementById("serverResponse");

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Empêche le rechargement

            const formData = new FormData(form);

            fetch(form.action, {
                    method: "POST",
                    body: formData,
                })
                .then((response) => response.text())
                .then((data) => {
                    // Affiche le message renvoyé par changerMdp.php
                    serverResponse.textContent = data;
                    serverResponse.style.color = data.includes("✅") ? "green" : "red";
                })
                .catch((error) => {
                    serverResponse.textContent = "❌ Erreur : " + error;
                    serverResponse.style.color = "red";
                });
        });
        </script>


        <section class="mt-5">
            <h3>Trajets proposés</h3>
            <ul class="list-group" id="activity-list">
                <?php afficherTrajets($trajets) ?>
            </ul>
        </section>
    </main>

    <!-- Pied de page -->
    <footer class="text-center py-4 mt-5 bg-light">
        <p>&copy; 2025 MonSiteWeb - Tous droits réservés</p>
    </footer>
</body>

<body>
</body>

</html>