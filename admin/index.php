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
    header("Location: index.php");
}

// Récupérer tous les utilisateurs
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Récupérer les anciens champs si erreur
$old_data = isset($_SESSION['old_data']) ? $_SESSION['old_data'] : [];
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error'], $_SESSION['old_data']);
?>

<?php include('./includes/admin_header.php'); ?>

<h2>Ajouter un Utilisateur</h2>
<form method="post" action="add_user.php">
    <label>Prénom:</label>
    <input type="text" name="first_name" value="<?php echo isset($old_data['first_name']) ? htmlspecialchars($old_data['first_name']) : ''; ?>" required>
    <label>Nom:</label>
    <input type="text" name="last_name" value="<?php echo isset($old_data['last_name']) ? htmlspecialchars($old_data['last_name']) : ''; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo isset($old_data['email']) ? htmlspecialchars($old_data['email']) : ''; ?>" required>
    <?php if ($error_message): ?>
        <span class="error-message-admin"><?php echo $error_message; ?></span>
    <?php endif; ?>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <label class="role-text">Rôle:</label>
    <select name="role">
        <option value="user" <?php echo isset($old_data['role']) && $old_data['role'] == 'user' ? 'selected' : ''; ?>>Utilisateur</option>
        <option value="admin" <?php echo isset($old_data['role']) && $old_data['role'] == 'admin' ? 'selected' : ''; ?>>Administrateur</option>
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