<?php
session_start();
require_once('../controllers/database/db.php');
require_once('../controllers/functions.php');
logout();

$success = null;
$error = null;

if (isset($_GET['id'])) {
    $id = $_GET['id']; // On récupère l'ID de la sœur à modifier
    // On récupère les informations de la sœur à partir de la base de données
    $query = $db->prepare('SELECT * FROM nuns WHERE id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    $sister = $query->fetch(PDO::FETCH_ASSOC);
    
    if (!$sister) {
        $error = "La sœur religieuse n'existe pas.";
    }
}

if (isset($_POST['update'])) {
    $title = trim($_POST['title']);
    $name = trim($_POST['name']);
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/soeurs_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($name) || empty($title)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } else {
        // Vérifier si la sœur existe déjà avec le même nom et titre
        $checkQuery = $db->prepare('SELECT COUNT(*) FROM nuns WHERE name = :name AND title = :title AND id != :id');
        $checkQuery->bindParam(':name', $name);
        $checkQuery->bindParam(':title', $title);
        $checkQuery->bindParam(':id', $id);
        $checkQuery->execute();
        $existingSister = $checkQuery->fetchColumn();

        if ($existingSister > 0) {
            $error = "Cette sœur existe déjà dans la base de données.";
        } else {
            // Préparer la mise à jour
            if (!empty($filename)) {
                $query = $db->prepare('UPDATE nuns SET photo = :photo, name = :name, title = :title WHERE id = :id');
                $query->bindParam(':photo', $filename);
            } else {
                $query = $db->prepare('UPDATE nuns SET name = :name, title = :title WHERE id = :id');
            }
            $query->bindParam(':name', $name);
            $query->bindParam(':title', $title);
            $query->bindParam(':id', $id);

            if ($query->execute()) {
                if (!empty($filename) && move_uploaded_file($tempname, $folder)) {
                    $success = "Sœur mise à jour avec succès.";
                } elseif (empty($filename)) {
                    $success = "Sœur mise à jour avec succès sans nouvelle photo.";
                } else {
                    $error = "Échec du téléchargement de l'image.";
                }
            } else {
                $error = "Erreur lors de la mise à jour de la sœur.";
            }
        }
    }
}
?>
