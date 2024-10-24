<?php
session_start();
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = '';
$description = '';
$message = '';

// Gestion de l'envoi du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO projects (user_id, title, description) VALUES (" . $_SESSION['user_id'] . ", '$title', '$description')";

    if (mysqli_query($conn, $query)) {
        header("Location: projects.php");
        exit();
    } else {
        $message = "Erreur lors de l'ajout du projet : " . mysqli_error($conn);
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h2>Ajouter un projet</h2>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Titre du projet :</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

        <label>Description :</label>
        <textarea name="description" required><?php echo htmlspecialchars($description); ?></textarea>

        <button type="submit" class="button">
            <span class="button_lg">
                <span class="button_sl"></span>
                <span class="button_text">Ajouter le projet</span>
            </span>
        </button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>