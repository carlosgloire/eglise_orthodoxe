<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/patriarches_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename) || empty($name)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    }  else {
        // Vérifier si une image existe déjà
        $existing_product_query = $db->prepare("SELECT * FROM patriarches WHERE photo=:photo");
        $existing_product_query->execute(array('photo' => $filename));
        $existing_product = $existing_product_query->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_product) {
            $error = "Ce patriarche existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO patriarches (photo,name) VALUES (:photo,:name)');
            $query->bindParam(':photo', $filename);
            $query->bindParam(':name', $name);

            if ($query->execute()) {
                // Déplacer le fichier téléchargé dans le dossier cible
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Patriarche ajouté avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout de du patriarche";
            }
        }
    }
}
?>
