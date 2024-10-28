<?php
include '../includes/db.php';

// Vérifier si l'utilisateur est connecté et est un administrateur
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Requête pour obtenir tous les projets avec le prénom et le nom de famille de l'utilisateur
$query = "SELECT p.id, p.title, CONCAT(u.first_name, ' ', u.last_name) AS username FROM projects p JOIN users u ON p.user_id = u.id";
$result = $conn->query($query);
?>

<?php include('includes/admin_header.php'); ?>

<div class="container">
    <h2 class="h2-admin-2">Gestion des Projets</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Utilisateur</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['username']}</td>
                            <td>
                                <form class='delete-admin-form' action='delete_project.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='project_id' value='{$row['id']}'>
                                        <a class='delete-button-admin-projects' href='delete_project.php?id={$row['id']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce projet ?\");'>Supprimer</a>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun projet trouvé.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>

</html>

<?php
$conn->close();
?>

<?php include('../includes/footer.php'); ?>