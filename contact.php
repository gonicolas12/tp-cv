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

<form method="post" action="">
    <label>Nom:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Message:</label>
    <textarea name="message" required></textarea>
    <button type="submit">Envoyer</button>
</form>

<!-- Carte de la ville -->
<div id="map" style="height: 400px;"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=API_KEY"></script>
<script>
    function initMap() {
        var city = {lat: 48.8566, lng: 2.3522}; // Paris, par exemple
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: city
        });
        var marker = new google.maps.Marker({position: city, map: map});
    }
    initMap();
</script>
