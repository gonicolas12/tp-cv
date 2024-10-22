<?php
session_start();

// Définir le chemin des polices
define('FPDF_FONTPATH', 'fpdf/font/');

require('fpdf/fpdf.php');
include('includes/db.php');

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Exemple de données du CV à récupérer de la base de données
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM cvs WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$cv = mysqli_fetch_assoc($result);

// Créer le PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, $cv['title']);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $cv['description']);
$pdf->Output('D', 'cv.pdf');
?>
