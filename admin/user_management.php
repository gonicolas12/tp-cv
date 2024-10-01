<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Récupérer la liste des utilisateurs
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<?php include('includes/admin_header.php'); ?>

<h2>Gestion des Utilisateurs</h2>
<table>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Rôle</th>
        <th>Actions</th>
    </tr>
    <?php while ($user = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo $user['role']; ?></td>
            <td>
                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Modifier</a>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');">Supprimer</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include('../includes/footer.php'); ?>
