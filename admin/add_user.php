<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est admin
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Vérifier si l'email existe déjà
    $check_query = "SELECT * FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Stocker l'erreur dans une variable de session
        $_SESSION['error'] = "Email déjà utilisé.";
        $_SESSION['old_data'] = $_POST;
        header("Location: index.php");
        exit();
    } else {
        // Si l'email est unique, insérer l'utilisateur
        $query = "INSERT INTO users (first_name, last_name, email, password, role) VALUES ('$first_name', '$last_name', '$email', '$password', '$role')";
        mysqli_query($conn, $query);
        header("Location: index.php");
        exit();
    }
}
