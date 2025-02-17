<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $title = $_POST['title'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/vicaires_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename) || empty($name) || empty($title)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $filename)) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } else {
        // Vérifier si le vicaire existe déjà
        $existing_vicaire_query = $db->prepare("SELECT * FROM vicaires WHERE photo=:photo");
        $existing_vicaire_query->execute(['photo' => $filename]);
        
        if ($existing_vicaire_query->fetch()) {
            $error = "Ce vicaire existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO vicaires (photo, name, title) VALUES (:photo, :name, :title)');
            if ($query->execute(['photo' => $filename, 'name' => $name, 'title' => $title])) {
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Vicaire ajouté avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout du vicaire";
            }
        }
    }
}
?>
