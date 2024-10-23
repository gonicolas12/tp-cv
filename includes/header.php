<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV/Portfolio</title>
    <link rel="icon" href="assets/img/user-solid.svg" type="image/svg+xml">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/projects.css">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="/tp-cv/index.php">Accueil</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/tp-cv/add_projects.php">Ajouter un Projet</a></li>
                    <li><a href="/tp-cv/projects.php">Mes projets</a></li>
                    <li><a href="/tp-cv/cv.php">Mon CV</a></li>
                    <li><a href="/tp-cv/view_cv.php">Voir mon CV</a></li>
                    <li><a href="/tp-cv/profile.php">Profil</a></li>
                    <li><a href="/tp-cv/logout.php">Déconnexion</a></li>
                    <li>
                        Bienvenue,
                        <?php if (isset($_SESSION['first_name'])): ?>
                            <?php echo htmlspecialchars($_SESSION['first_name']); ?>
                        <?php else: ?>
                            Invité
                        <?php endif; ?>
                    </li>

                    <?php if (isset($_SESSION['role'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li style="float: right;">Rôle : <a href="/tp-cv/admin/index.php">admin</a></li>
                        <?php else: ?>
                            <li style="float: right;">Rôle : user</li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li style="float: right;">Rôle : non défini</li>
                    <?php endif; ?>
                <?php else: ?>
                    <li><a href="/tp-cv/login.php">Connexion</a></li>
                <?php endif; ?>
                <li><a href="/tp-cv/contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>