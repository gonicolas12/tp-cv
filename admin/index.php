<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

// Valider un projet
if (isset($_GET['validate'])) {
    $project_id = $_GET['validate'];
    $query = "UPDATE projects SET status = 'validated' WHERE id = $project_id";
    mysqli_query($conn, $query);
    header("Location: index.php"); // Redirige après validation
}

// Récupérer les projets en attente de validation
$query = "SELECT * FROM projects WHERE status = 'pending'";
$result = mysqli_query($conn, $query);
?>

<h1>Projets à valider</h1>
<?php while ($project = mysqli_fetch_assoc($result)) { ?>
    <div>
        <h3><?php echo $project['title']; ?></h3>
        <p><?php echo $project['description']; ?></p>
        <a href="?validate=<?php echo $project['id']; ?>">Valider</a>
    </div>
<?php } ?>
