<?php
session_start();
require_once('../controllers/database/db.php');
require_once('../controllers/functions.php');
logout();

$success = null;
$error = null;

if (isset($_POST['add'])) {
    $title = trim($_POST['title']); // Nouveau champ titre
    $name = trim($_POST['name']);
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/archeveques_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename) || empty($name) || empty($title)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } else {
        $query = $db->prepare('INSERT INTO archeveques (photo, name, title) VALUES (:photo, :name, :title)');
        $query->bindParam(':photo', $filename);
        $query->bindParam(':name', $name);
        $query->bindParam(':title', $title);

        if ($query->execute()) {
            if (move_uploaded_file($tempname, $folder)) {
                $success = "Archevêque ajouté avec succès";
            } else {
                $error = "Échec du téléchargement de l'image";
            }
        } else {
            $error = "Erreur lors de l'ajout de l'archevêque";
        }
    }
}
?>