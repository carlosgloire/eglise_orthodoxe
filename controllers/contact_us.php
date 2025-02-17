<?php
$error = null;
$success = null;
$mysqli = require(__DIR__ . "/../mail/database.php"); 

if (isset($_POST['send'])) {
    if (isset($_POST['message']) && isset($_POST['subject']) && isset($_POST['email']) && isset($_POST['noms'])) {
        $message = nl2br(htmlspecialchars($_POST['message']));
        $subject = nl2br(htmlspecialchars($_POST['subject']));
        $noms = htmlspecialchars($_POST['noms']);
        $sender_email = htmlspecialchars($_POST['email']);
        
        if (empty($subject) || empty($message) || empty($sender_email) || empty($noms)) {
            $error = "Veuillez compléter tous les champs.";
        } elseif (!filter_var($sender_email, FILTER_VALIDATE_EMAIL)) {
            $error = "Votre email est incorrect.";
        } else {
            $mail = require __DIR__ . "/../mail/mailer.php";
            $mail->setFrom($sender_email, $noms); // Définit l'expéditeur à l'email saisi dans le formulaire
            $mail->Subject = html_entity_decode($subject); // Décode les entités HTML dans le sujet
            $mail->CharSet = 'UTF-8'; // Définit l'encodage à UTF-8

            // Crée le corps de l'email avec le message de la zone de texte
            $email_body = <<<END
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f5f5f5;
                        padding: 20px;
                    }
                    .container {
                        background-color: #fff;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                        white-space: pre-wrap; /* Préserve les espaces blancs et les sauts de ligne */
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <p><strong>Nom :</strong> $noms</p>
                    <p><strong>Email :</strong> $sender_email</p>
                    <p><strong>Message :</strong><br>$message</p>
                </div>
            </body>
            </html>
            END;

            $mail->Body = $email_body;
            $mail->isHTML(true);
            
            // Définit le destinataire à l'email de l'admin
            $mail->addAddress('ndayisabarenzaho@gmail.com', 'Admin'); // Adresse email de l'admin

            try {
                $mail->send();
                $success = "Votre message a été envoyé avec succès, vous recevrez une réponse par email.";
            } catch (Exception $e) {
                $error = "Le message n'a pas été envoyé.";
            }
        }
    } else {
        $error = "Des champs obligatoires sont manquants.";
    }
}
?>
