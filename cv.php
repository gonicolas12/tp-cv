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

// Si aucun CV n'est trouvé, initialiser les champs vides
if (!$cv) {
    $cv = ['title' => '', 'description' => ''];
}

// Mettre à jour le CV si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Vérifier si l'utilisateur a déjà un CV
    if ($cv) {
        $query = "UPDATE cvs SET title = '$title', description = '$description' WHERE user_id = $user_id";
    } else {
        $query = "INSERT INTO cvs (user_id, title, description) VALUES ($user_id, '$title', '$description')";
    }

    if (!mysqli_query($conn, $query)) {
        echo "Error: " . mysqli_error($conn); // Afficher l'erreur SQL si elle existe
    } else {
        header("Location: cv.php");
        exit();
    }
}
?>

<?php include 'includes/header.php'; ?>

<form method="post" action="">
    <label>Titre du CV:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($cv['title']); ?>" required>
    <label>Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($cv['description']); ?></textarea>
    <button class="button">
        <span class="button_lg">
            <span class="button_sl"></span>
            <span class="button_text">Mettre à jour</span>
        </span>
    </button>
</form>

<?php include 'includes/footer.php'; ?>
