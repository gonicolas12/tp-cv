<?php
$host = 'localhost';
$db = 'mon_portfolio'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur par défaut
$pass = ''; // Mot de passe par défaut (vide)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
