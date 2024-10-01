<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Utiliser $conn pour la requête
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: profile.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<form class="login-form" method="post" action="">
    <label>Email:</label>
    <input name="email" required>
    <label class="password-text">Mot de passe:</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit" class="login-btn">Se connecter</button>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</form>

<?php include 'includes/footer.php'; ?>