<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS personnalisé -->
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px; border-radius: 1rem">
        <div class="text-center mb-4">
            <img src="../images/logo.png" alt="Way Together" height="60" />
            <h2 class="fw-bold mt-3">Inscription</h2>
        </div>

        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="name" placeholder="Jean Dupont" required />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" placeholder="exemple@email.com" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe" required />
            </div>

            <div class="mb-3">
                <label for="passwordConfirm" class="form-label">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirmer le mot de passe"
                    required />
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                S'inscrire
            </button>

            <p class="text-center">
                Vous avez déjà un compte ? <a href="login.php">Se connecter</a>
            </p>
            <div class="mb-3 text-start">
                <a href="../index.php" class="text-decoration-none">&larr; Retour à l'accueil</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>