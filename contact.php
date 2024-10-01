<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "tonemail@example.com";
    $subject = "Message de " . $_POST['name'];
    $message = $_POST['message'];
    $headers = "From: " . $_POST['email'];

    if (mail($to, $subject, $message, $headers)) {
        echo "Votre message a été envoyé.";
    } else {
        echo "Erreur lors de l'envoi du message.";
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h1>Contactez-moi</h1>
    <form method="post" action="">
        <label>Nom:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Message:</label>
        <textarea name="message" required></textarea>
        <button type="submit">Envoyer</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
