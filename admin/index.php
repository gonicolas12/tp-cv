<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Supprimer un utilisateur
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE id = $user_id";
    mysqli_query($conn, $query);
    header("Location: index.php"); // Redirige après suppression
}

// Récupérer tous les utilisateurs
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<?php include('./includes/admin_header.php'); ?>


<!-- Formulaire pour ajouter un utilisateur -->
<h2>Ajouter un Utilisateur</h2>
<form method="post" action="add_user.php">
    <label>Prénom:</label>
    <input type="text" name="first_name" required>
    <label>Nom:</label>
    <input type="text" name="last_name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <label class="role-text">Rôle:</label>
    <select name="role">
        <option value="user">Utilisateur</option>
        <option value="admin">Administrateur</option>
    </select>
    <br>
    <button class="button">
        <span class="button_lg">
            <span class="button_sl"></span>
            <span class="button_text">Ajouter</span>
        </span>
    </button>
</form>

<?php include('../includes/footer.php'); ?>