<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../pages/gallery_videos/" . $filename;
    $allowedExtensions = ['mp4', 'avi', 'mov', 'wmv', 'avchd', 'webm', 'flv'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($filename)) {
        $error = "Veuillez choisir une vidéo";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"mp4, avi ou mov\"";
    } elseif ($filesize > 500000000) {
        $error = "Votre fichier ne doit pas dépasser 500Mb";
    } else {
        // Vérifier si une image existe déjà
        $existing_product_query = $db->prepare("SELECT * FROM gallery_video WHERE video=:video");
        $existing_product_query->execute(array('video' => $filename));
        $existing_product = $existing_product_query->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_product) {
            $error = "Cette vidéo existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO gallery_video (video) VALUES (:video)');
            $query->bindParam(':video', $filename);
            if ($query->execute()) {
                // Déplacer le fichier téléchargé dans le dossier cible
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Vidéo ajoutée avec succès";
                } else {
                    $error = "Échec du téléchargement de la vidéo";
                }
            } else {
                $error = "Erreur lors de l'ajout de la vidéo";
            }
        }
    }
}
?>
