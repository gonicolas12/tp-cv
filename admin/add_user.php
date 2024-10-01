<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (first_name, last_name, email, password, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$role')";
    mysqli_query($conn, $query);
    echo "Utilisateur ajouté.";
}
?>

<h2>Ajouter un Utilisateur</h2>
<form method="post" action="">
    <label>Prénom:</label>
    <input type="text" name="first_name" required>
    <label>Nom:</label>
    <input type="text" name="last_name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <label>Rôle:</label>
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="admin">Administrateur</option>
    </select>
    <button type="submit">Ajouter</button>
</form>
