<?php
session_start();
include('includes/db.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    $cv = ['title' => '', 'description' => '', 'cv_file' => ''];
}

// Mettre à jour le CV si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $cv_file_destination = '';

    // Vérifier si un fichier a été téléchargé
    if (!empty($_FILES['cv_file']['name'])) {
        $cv_file_name = $_FILES['cv_file']['name'];
        $cv_file_tmp = $_FILES['cv_file']['tmp_name'];
        $cv_file_destination = 'uploads/' . $cv_file_name;

        // Vérifier si le fichier est bien un PDF
        if ($_FILES['cv_file']['type'] == 'application/pdf') {
            // Déplacer le fichier uploadé vers le dossier uploads
            if (move_uploaded_file($cv_file_tmp, $cv_file_destination)) {
                echo "Fichier uploadé avec succès<br>";
            } else {
                echo "Erreur lors de l'upload du fichier.";
            }
        } else {
            echo "Veuillez télécharger uniquement des fichiers PDF.";
        }
    }

    // Vérifier si un CV existe pour cet utilisateur
    if (mysqli_num_rows($result) > 0) {
        // Mettre à jour le CV
        $query = "UPDATE cvs SET title = '$title', description = '$description'";
        if (!empty($cv_file_destination)) {
            $query .= ", cv_file = '$cv_file_destination'";
        }
        $query .= " WHERE user_id = $user_id";
    } else {
        // Insérer un nouveau CV
        $query = "INSERT INTO cvs (user_id, title, description, cv_file) VALUES ($user_id, '$title', '$description', '$cv_file_destination')";
    }

    // Exécuter la requête
    if (!mysqli_query($conn, $query)) {
        echo "Erreur SQL : " . mysqli_error($conn);
    } else {
        echo "Requête SQL réussie";
        header("Location: view_cv.php");
        exit();
    }
}

?>

<?php include 'includes/header.php'; ?>

<form method="post" action="" enctype="multipart/form-data">
    <label>Titre du CV:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($cv['title']); ?>" required>
    <label>Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($cv['description']); ?></textarea>
    <label>Uploader un CV (PDF uniquement) :</label>
    <input type="file" name="cv_file" accept=".pdf">
    <button type="submit" class="button">
        <span class="button_lg">
            <span class="button_sl"></span>
            <span class="button_text">Mettre à jour</span>
        </span>
    </button>
</form>

<?php include 'includes/footer.php'; ?>