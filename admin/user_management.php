<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Récupérer la liste des utilisateurs sauf celui qui est connecté
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id != $user_id";
$result = mysqli_query($conn, $query);
?>

<?php include('includes/admin_header.php'); ?>

<?php
if (isset($_GET['message'])) {
    echo "<script>alert('" . htmlspecialchars($_GET['message']) . "');</script>";
}
?>

<h2 class="h2-admin">Gestion des Utilisateurs</h2>
<table>
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>
    <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$user['first_name']}</td>
                    <td>{$user['last_name']}</td>
                    <td>{$user['email']}</td>
                    <td>{$user['role']}</td>
                    <td>
                        <a class='edit-button-admin' href='edit_user.php?id={$user['id']}'>Modifier</a>
                        <a class='delete-button-admin' href='delete_user.php?id={$user['id']}' onclick='return confirm(\"Êtes-vous sûr ?\");'>Supprimer</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Aucun utilisateur trouvé.</td></tr>";
    }
    ?>
    </tbody>
</table>

<?php include('../includes/footer.php'); ?>