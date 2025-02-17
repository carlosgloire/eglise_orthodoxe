<?php
$error = null;
$success = null;
$mysqli = require(__DIR__ . "/mail/database.php");

if (isset($_POST['send'])) {
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $query = $mysqli->prepare("SELECT * FROM admins WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $mail_query = $query->get_result()->fetch_assoc();

        if (empty($email)) {
            $error = "Veuillez entrer votre adresse e-mail !";
        } elseif (!$mail_query) {
            $error = "Nous n'avons trouvé aucun compte associé à cet e-mail. Veuillez réessayer ou créer un nouveau compte.";
        } else {
            // Récupérer les informations de l'utilisateur depuis la base de données
            $firstName = "Admin";
            $companyName = "Eglise Orthodoxe sainte famille";  
            $supportEmail = "contact@generalconsultinggroups.com";  // Remplacez par votre e-mail de support

            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
            $sql = "UPDATE admins
                    SET reset_token_hash = ?,
                        reset_token_expires_at = ?
                    WHERE email = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sss", $token_hash, $expiry, $email);
            $stmt->execute();

            if ($mysqli->affected_rows) {
                $mail = require __DIR__ . "/mail/mailer.php";

                $mail->CharSet = 'UTF-8'; // Ensure UTF-8 encoding for the email content
                $mail->setFrom("noreply@example.com", "$companyName");
                $mail->addAddress($email);
                $mail->Subject = "Réinitialisez votre mot de passe - Action requise";
                $currentYear = date("Y");

                $mail->Body = <<<END
                <html>
                <head>
                    <style>
                        body {
                            font-family: 'Arial', sans-serif;
                            background-color: #f5f5f5;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 30px auto;
                            background-color: #ffffff;
                            border-radius: 8px;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                            overflow: hidden;
                        }
                        .email-header {
                            background-color: #4c3636;
                            color: #ffffff;
                            padding: 20px;
                            text-align: center;
                            font-size: 24px;
                            font-weight: bold;
                        }
                        .email-body {
                            padding: 30px;
                            color: #333333;
                            line-height: 1.6;
                            font-size: 16px;
                        }
                        .email-body p {
                            margin: 15px 0;
                        }
                        .email-body .button-container {
                            text-align: center;
                            margin: 20px 0;
                        }
                        .email-body .button {
                            background-color: #4c3636;
                            color: #ffffff;
                            padding: 12px 25px;
                            font-size: 16px;
                            border-radius: 5px;
                            text-decoration: none;
                            font-weight: bold;
                            display: inline-block;
                        }
                        .email-body .button:hover {
                            background-color:rgb(97, 66, 66);
                        }
                        .email-footer {
                            background-color: #f5f5f5;
                            text-align: center;
                            padding: 15px;
                            font-size: 14px;
                            color: #888888;
                            border-top: 1px solid #dddddd;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="email-header">
                            Demande de réinitialisation de mot de passe
                        </div>
                        <div class="email-body">
                            <p>Bonjour cher $firstName,</p>
                            <p>Nous avons reçu une demande pour réinitialiser le mot de passe de votre compte $companyName. Pour procéder à la réinitialisation de votre mot de passe, cliquez simplement sur le bouton ci-dessous :</p>
                            <div class="button-container">
                                <a class="button" href="http://localhost/eglise_orthodoxe/templates/reset-password.php?token=$token">
                                    Réinitialiser le mot de passe
                                </a>
                            </div>
                            <p>Si vous n'avez pas fait cette demande, veuillez ignorer cet e-mail. Votre compte reste sécurisé, et aucun changement n'a été effectué.</p>

                        </div>
                        <div class="email-footer">
                            <p>&copy; $currentYear $companyName. Tous droits réservés.</p>
                            <p>Cet email a été envoyé automatiquement. Veuillez ne pas répondre à cette adresse.</p>
                        </div>
                    </div>
                </body>
                </html>
                END;

                try {
                    $mail->send();
                    $success = "Message envoyé à cet e-mail. Veuillez vérifier votre boîte de réception.";
                } catch (Exception $e) {
                    $error = "Le message n'a pas pu être envoyé. Erreur de messagerie : {$mail->ErrorInfo}";
                }
            }
        }
    }
}
?>
