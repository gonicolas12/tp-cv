<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    <link rel="icon" href="../../assets/img/user-solid.svg" type="image/svg+xml">
    <link rel="stylesheet" href="/tp-cv/assets/css/home.css">
    <link rel="stylesheet" href="/tp-cv/assets/css/login.css">
    <link rel="stylesheet" href="/tp-cv/assets/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/tp-cv/assets/js/scripts.js"></script>
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="/tp-cv/index.php">Accueil</a></li>
                <li><a href="/tp-cv/admin/index.php">Ajouter Utilisateur</a></li>
                <li><a href="/tp-cv/admin/user_management.php">Liste Utilisateurs</a></li>
                <li><a href="/tp-cv/logout.php">Déconnexion</a></li>
                <li>Admin : <?php echo $_SESSION['first_name']; ?></li>
            </ul>
        </nav>
    </header>

    <main>