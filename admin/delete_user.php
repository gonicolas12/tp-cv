<?php
session_start();
include('../includes/db.php');

// Vérifier que l'utilisateur est connecté et qu'il est admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    // Supprimer l'utilisateur
    $query = "DELETE FROM users WHERE id = $user_id";
    if (mysqli_query($conn, $query)) {
        $message = "Utilisateur supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression de l'utilisateur.";
    }
} else {
    $message = "Erreur : ID d'utilisateur manquant.";
}

header("Location: user_management.php");
exit();
