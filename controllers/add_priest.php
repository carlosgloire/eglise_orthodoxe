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
    $folder = "../templates/pretres_images/" . $filename; // Dossier des prêtres
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    // Vérifier si tous les champs sont remplis
    if (empty($filename) || empty($name) || empty($title)) {
        $error = "Tous les champs sont obligatoires";
    } 
    // Vérifier le format de l'image
    elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } 
    else {
        // Vérifier si le prêtre existe déjà
        $checkQuery = $db->prepare('SELECT COUNT(*) FROM priests WHERE name = :name AND title = :title');
        $checkQuery->bindParam(':name', $name);
        $checkQuery->bindParam(':title', $title);
        $checkQuery->execute();
        $existingPriest = $checkQuery->fetchColumn();

        if ($existingPriest > 0) {
            $error = "Ce prêtre existe déjà dans la base de données.";
        } else {
            // Insérer le prêtre
            $query = $db->prepare('INSERT INTO priests (photo, name, title) VALUES (:photo, :name, :title)');
            $query->bindParam(':photo', $filename);
            $query->bindParam(':name', $name);
            $query->bindParam(':title', $title);

            if ($query->execute()) {
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Prêtre ajouté avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout du prêtre";
            }
        }
    }
}
?>
