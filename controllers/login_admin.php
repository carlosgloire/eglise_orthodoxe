<?php
   require_once('../controllers/database/db.php');
   $error = null;
   if (isset($_POST['login'])) {
      $mail = htmlspecialchars($_POST['mail']);
      $password = htmlspecialchars($_POST['password']);
      // Connectez l'utilisateur avec son nom ou son email
      if (empty($_POST['mail']) || empty($_POST['password'])) {
         $error = "Veuillez compléter tous les champs !";
      }
      if (empty($_POST['mail'])) {
         $error = "Veuillez entrer l'adresse e-mail !";
      }
      elseif (empty($_POST['password'])) {
         $error = "Veuillez entrer le mot de passe !";
      }
      else {
         $request = $db->prepare("SELECT email, password, admin_id FROM admins WHERE email = :email ");
         $request->bindValue(':email', $mail);
         $request->execute();
         $admin = $request->fetch(PDO::FETCH_ASSOC);
         if ($admin) {
            if (password_verify($password, $admin['password'])) {
               $_SESSION['admin_id'] = $admin['admin_id'];
               $_SESSION['admin'] = $admin;
               header("location: ../admin/");
               exit;
            }
            else {
               $error = "Email ou mot de passe incorrect !";
            }
         } else {
            $error = "Aucun utilisateur dans le système avec cette adresse e-mail.";
         }
      }
   }
?>
