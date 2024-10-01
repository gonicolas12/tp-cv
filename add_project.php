<?php
session_start();
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO projects (title, description, user_id, status) VALUES ('$title', '$description', $user_id, 'pending')";
    mysqli_query($conn, $query);
    echo "Projet soumis à validation.";
}
?>

<h2>Ajouter un Projet</h2>
<form method="post" action="">
    <label>Titre du projet:</label>
    <input type="text" name="title" required>
    <label>Description du projet:</label>
    <textarea name="description" required></textarea>
    <button type="submit">Ajouter</button>
</form>
