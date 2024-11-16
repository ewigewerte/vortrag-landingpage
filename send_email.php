
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        // Enable debugging
        $mail->SMTPDebug = 2; // Debugging enabled, change to 0 for production

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'ewige.werte.reg@gmail.com'; // Your Gmail address
        $mail->Password = 'ewigewerte1234'; // Your Gmail password (consider App Password for security)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
        $mail->Port = 587; // Port for TLS

        // Email content
        $mail->setFrom('ewige.werte.reg@gmail.com', 'Ewige Werte Anmeldung');
        $mail->addAddress('ewige.werte.reg@gmail.com', 'Ewige Werte Team');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(false);
        $mail->Subject = "Neue Anmeldung von: $name";
        $mail->Body = "Name: $name\nE-Mail: $email\nNachricht: \n$message";

        $mail->send();
        echo "Vielen Dank für Ihre Anmeldung! Wir werden uns in Kürze bei Ihnen melden.";
    } catch (Exception $e) {
        echo "Es gab ein Problem beim Senden Ihrer Nachricht. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
