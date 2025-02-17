<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/slide_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename)) {
        $error = "Veuillez choisir une image";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    }  else {
        // Vérifier si une image existe déjà
        $existing_product_query = $db->prepare("SELECT * FROM slides WHERE photo=:photo");
        $existing_product_query->execute(array('photo' => $filename));
        $existing_product = $existing_product_query->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_product) {
            $error = "Cette image existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO slides (photo) VALUES (:photo)');
            $query->bindParam(':photo', $filename);
            if ($query->execute()) {
                // Déplacer le fichier téléchargé dans le dossier cible
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Image ajoutée avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout de l'image";
            }
        }
    }
}
?>
