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

// Mettre à jour le CV si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $query = "UPDATE cvs SET title = '$title', description = '$description' WHERE user_id = $user_id";
    mysqli_query($conn, $query);
    header("Location: cv.php");
}
?>

<form method="post" action="">
    <label>Titre du CV:</label>
    <input type="text" name="title" value="<?php echo $cv['title']; ?>" required>
    <label>Description:</label>
    <textarea name="description" required><?php echo $cv['description']; ?></textarea>
    <button type="submit">Mettre à jour</button>
</form>
