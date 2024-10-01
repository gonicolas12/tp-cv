<?php
session_start();
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Mise à jour des informations utilisateur
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    
    $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = $user_id";
    mysqli_query($conn, $query);
    header("Location: profile.php");
}
?>

<h2>Mon Profil</h2>
<form method="post" action="">
    <label>Prénom:</label>
    <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required>
    <label>Nom:</label>
    <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
    <button type="submit">Mettre à jour</button>
</form>
