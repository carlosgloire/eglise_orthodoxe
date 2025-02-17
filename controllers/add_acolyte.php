<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/acolytes_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename) || empty($name)) {
        $error = "Tous les champs sont obligatoires";
    } elseif (!preg_match($pattern, $filename)) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } else {
        // Vérifier si l'acolyte existe déjà
        $existing_query = $db->prepare("SELECT * FROM acolytes WHERE photo=:photo");
        $existing_query->execute(['photo' => $filename]);

        if ($existing_query->fetch()) {
            $error = "Cet acolyte existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO acolytes (photo, name) VALUES (:photo, :name)');
            if ($query->execute(['photo' => $filename, 'name' => $name])) {
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Acolyte ajouté avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout de l'acolyte";
            }
        }
    }
}
?>
