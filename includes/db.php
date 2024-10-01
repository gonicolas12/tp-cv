<?php
$host = 'localhost';
$db = 'tp-cv'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur par défaut
$pass = ''; // Mot de passe par défaut (vide)

// Connexion à la base de données
$conn = mysqli_connect($host, $user, $pass, $db);

// Vérifier la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
