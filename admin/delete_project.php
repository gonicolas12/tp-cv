<?php
include '../includes/db.php';

session_start();

// Vérifier si l'utilisateur est connecté et est un administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Vérifier si l'ID du projet est envoyé
if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // Requête pour supprimer le projet
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $stmt->close();

    header('Location: manage_projects.php');
    exit();
}

$conn->close();
