<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est connecté et qu'il est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Récupérer les informations de l'utilisateur
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Erreur : utilisateur non trouvé.";
        exit();
    }

    // Mise à jour des informations utilisateur
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Mettre à jour la base de données
        $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', role = '$role' WHERE id = $user_id";
        mysqli_query($conn, $query);

        header("Location: user_management.php");
        exit();
    }
} else {
    header("Location: user_management.php");
    exit();
}
?>

<?php include './includes/admin_header.php'; ?>

<h2>Modifier l'utilisateur</h2>
<form method="post" action="">
    <label>Prénom:</label>
    <input type="text" name="first_name" value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?>" required>

    <label>Nom:</label>
    <input type="text" name="last_name" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : ''; ?>" required>

    <label class="role-text-2">Rôle:</label>
    <select class="admin-role-selector" name="role" required>
        <option value="user" <?php echo (isset($user['role']) && $user['role'] == 'user') ? 'selected' : ''; ?>>Utilisateur</option>
        <option value="admin" <?php echo (isset($user['role']) && $user['role'] == 'admin') ? 'selected' : ''; ?>>Administrateur</option>
    </select>
    <br>
    <button class="button">
        <span class="button_lg">
            <span class="button_sl"></span>
            <span class="button_text">Mettre à jour</span>
        </span>
    </button>
</form>

<?php include '../includes/footer.php'; ?>