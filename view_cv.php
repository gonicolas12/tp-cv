<?php
session_start();
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cvs WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$cv = mysqli_fetch_assoc($result);

// Vérifier si le CV existe
if (!$cv) {
?>
    <?php include 'includes/header.php'; ?>

    <h2>Aucun CV trouvé...</h2>

    <?php include 'includes/footer.php'; ?>
<?php
} else {
?>
    <?php include 'includes/header.php'; ?>

    <h2>Mon CV</h2>
    <h3>Titre : <?php echo htmlspecialchars($cv['title']); ?></h3>
    <p>Description : <?php echo nl2br(htmlspecialchars($cv['description'])); ?></p>

    <?php if (!empty($cv['cv_file'])): ?>
        <a href="<?php echo $cv['cv_file']; ?>" download>Télécharger mon CV</a>
    <?php else: ?>
        <p>Aucun CV disponible pour le téléchargement.</p>
    <?php endif; ?>

    <a href="cv.php">Modifier mon CV</a>

    <?php include 'includes/footer.php'; ?>
<?php
}
?>