<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: profile.php");
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<form method="post" action="">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <button type="submit">Se connecter</button>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</form>
