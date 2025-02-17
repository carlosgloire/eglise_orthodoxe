<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/diacres_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename) || empty($name) ) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $filename)) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } else {
        // Vérifier si le diacre existe déjà
        $existing_diacre_query = $db->prepare("SELECT * FROM diacres WHERE photo=:photo");
        $existing_diacre_query->execute(['photo' => $filename]);
        
        if ($existing_diacre_query->fetch()) {
            $error = "Ce diacre existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO diacres (photo, name) VALUES (:photo, :name)');
            if ($query->execute(['photo' => $filename, 'name' => $name])) {
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Diacre ajouté avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout du diacre";
            }
        }
    }
}
?>
