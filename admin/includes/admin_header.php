<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: /index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Mon CV/Portfolio</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/scripts.js"></script>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="/admin/index.php">Tableau de Bord</a></li>
            <li><a href="/admin/add_user.php">Ajouter Utilisateur</a></li>
            <li><a href="/admin/validate_project.php">Valider Projets</a></li>
            <li><a href="/logout.php">Déconnexion</a></li>
            <li>Admin: <?php echo $_SESSION['first_name']; ?></li>
        </ul>
    </nav>
</header>

<main>
<!-- Contenu principal pour l'administration -->
