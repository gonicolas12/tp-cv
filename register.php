<?php
session_start();
include('includes/db.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Vérifier si l'email existe déjà
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Insérer l'utilisateur avec le rôle 'user' par défaut
        $query = "INSERT INTO users (first_name, last_name, email, password, role) VALUES ('$first_name', '$last_name', '$email', '$password', 'user')";

        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $message = "Erreur lors de la création du compte : " . mysqli_error($conn);
        }
    } else {
        $message = "Cet email est déjà utilisé.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<h2>Créer un compte</h2>
<?php if ($message) echo "<p>$message</p>"; ?>

<form class="register-form" method="post" action="">
    <label>Prénom:</label>
    <input name="first_name" required>

    <label>Nom:</label>
    <input name="last_name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Mot de passe:</label>
    <input type="password" name="password" required>
    <br>
    <button class="button">
        <span class="button_lg">
            <span class="button_sl"></span>
            <span class="button_text">Créer le compte</span>
        </span>
    </button>
</form>

<?php include 'includes/footer.php'; ?>