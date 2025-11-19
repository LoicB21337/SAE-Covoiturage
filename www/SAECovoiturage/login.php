<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Way Together — Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- CSS personnalisé -->
    <link href="../fichiers/css/base.css" rel="stylesheet" />
    <link href="../fichiers/css/navbar.css" rel="stylesheet" />
    <link href="../fichiers/css/hero.css" rel="stylesheet" />
    <link href="../fichiers/css/cards.css" rel="stylesheet" />
    <link href="../fichiers/css/buttons.css" rel="stylesheet" />
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px; border-radius: 1rem">
        <div class="text-center mb-4">
            <img src="../images/logo.png" alt="Way Together" height="60" />
            <h2 class="fw-bold mt-3">Connexion</h2>
        </div>

        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" placeholder="exemple@email.com" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe" required />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember" />
                    <label class="form-check-label" for="remember">Se souvenir de moi</label>
                </div>
                <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">
                Se connecter
            </button>

            <p class="text-center">
                Pas encore de compte ? <a href="signup.php">S'inscrire</a>
            </p>
            <div class="mb-3 text-start">
                <a href="../index.php" class="text-decoration-none">&larr; Retour à l'accueil</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>