<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV/Portfolio</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="/index.php">Accueil</a></li>
            <li><a href="/projects.php">Projets</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/cv.php">Mon CV</a></li>
                <li><a href="/profile.php">Profil</a></li>
                <li><a href="/logout.php">Déconnexion</a></li>
                <li>Bienvenue, <?php echo $_SESSION['first_name']; ?></li>
            <?php else: ?>
                <li><a href="/login.php">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
<!-- Contenu principal de la page -->
