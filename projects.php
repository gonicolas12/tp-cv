<?php
session_start();
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer tous les projets de l'utilisateur
$query = "SELECT * FROM projects WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Supprimer un projet si le bouton est cliqué
if (isset($_GET['delete'])) {
    $project_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM projects WHERE id = $project_id AND user_id = $user_id";
    mysqli_query($conn, $delete_query);
    header("Location: projects.php");
    exit();
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h2 class="project-title">Mes Projets</h2>

    <?php if (empty($projects)): ?>
        <p>Aucun projet trouvé.</p>
    <?php else: ?>
        <div class="project-list">
            <?php foreach ($projects as $project): ?>
                <div class="project-item">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
                    <a href="?delete=<?php echo $project['id']; ?>" class="delete-button">Supprimer</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a class="add-project-button" href="add_projects.php">Ajouter un projet</a>
</main>

<?php include 'includes/footer.php'; ?>