<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'projectynov@gmail.com';
        $mail->Password = 'tlef votn psyr hjgq';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // Port TCP pour TLS

        // Destinataires
        $mail->setFrom('projectynov@gmail.com', $_POST['name']);
        $mail->addAddress('projectynov@gmail.com');

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = "Message de " . $_POST['name'];
        $mail->Body = nl2br($_POST['message']);
        $mail->AltBody = $_POST['message'];

        // Envoi de l'email
        $mail->send();
        $message = "Mail envoyé avec succès !";
    } catch (Exception $e) {
        $message = "Erreur lors de l'envoi du message. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h2>Contactez-moi</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Nom:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Message:</label>
        <textarea name="message" required></textarea>
        <button class="button">
            <span class="button_lg">
                <span class="button_sl"></span>
                <span class="button_text">Envoyer</span>
            </span>
        </button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>