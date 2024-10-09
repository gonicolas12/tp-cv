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
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="/tp-cv/index.php">Accueil</a></li>
            <li><a href="/tp-cv/projects.php">Projets</a></li>
            <li><a href="/tp-cv/contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/tp-cv/cv.php">Mon CV</a></li>
                <li><a href="/tp-cv/profile.php">Profil</a></li>
                <li><a href="/tp-cv/logout.php">Déconnexion</a></li>
                <li>Bienvenue, <?php echo isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Invité'; ?></li>
            <?php else: ?>
                <li><a href="/tp-cv/login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
<!-- Contenu principal de la page -->
