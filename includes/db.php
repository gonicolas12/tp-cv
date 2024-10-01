<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "portfolio";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}
?>
