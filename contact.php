<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));
    
    $to = "contact@chicken-229.com"; // Your email address
    $email_subject = "Message envoyé depuis le site Chicken-229";


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse e-mail invalide.";
        exit;
    }

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    
    $html_message = "
        <html>
        <body>
            <h2>Nouveau message de Chicken-229</h2>
            <p><strong>Objet :</strong> $subject</p>
            <p><strong>Message :</strong><br>" . nl2br($message) . "</p>
            <p><strong>De :</strong> $name</p>
            <p><strong>E-mail :</strong> $email</p>
        </body>
        </html>
    ";

    // Send email
    if (mail($to, $email_subject, $html_message, $headers)) {
        echo 'success';
    } else {
        echo "Le mail n'a pas pu être envoyé. Veuillez réessayer plus tard.";
    }
} else {
    echo "Seules les demandes de formulaire sont autorisées.";
}
?>


/** if ($_SERVER["REQUEST_METHOD"] === "POST") {
 *       require_once 'php/mail.php';
 *       $name    = htmlspecialchars($_POST["name"]);
 *       $email   = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
 *       $subject = htmlspecialchars($_POST["subject"]);
 *       $message = htmlspecialchars($_POST["message"]);
 *       $mail->setFrom($email, $name);
 *       $mail->addAddress('mounir8mehdi@gmail.com', 'Chicken-229 support');
 *       $mail->addReplyTo($email, $name);
 *       $mail->Subject = $subject.', de '.$name.', site Chicken-229';
 *       $mail->Body    = "<strong>De:</strong> $name<br><strong>Email:</strong> $email <br><strong>Objet:</strong> $subject <br><strong>Message:</strong> $message";
 *       if ($mail->send()) {
 *           echo 'success';
 *       } else {
 *           echo "Le mail n'a pas pu être envoyé. Réessayez plus tard !";
 *       }
*} else {
*    echo "Seules les demandes de strike-food sont autorisées.";
*}**/