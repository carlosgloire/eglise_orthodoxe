<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');

if (isset($_POST['add'])) {
    $title = htmlspecialchars($_POST['title']);
    $description = $_POST['description'];
    $audioFile = $_FILES["audio"]["name"];
    $audioTemp = $_FILES["audio"]["tmp_name"];
    $videoFile = $_FILES["video"]["name"];
    $videoTemp = $_FILES["video"]["tmp_name"];
    $audioFolder = "../pages/sermons/audio/" . $audioFile;
    $videoFolder = "../pages/sermons/videos/" . $videoFile;
    
    // Vérification des champs obligatoires
    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir le titre et la description.";
    } else {
        // Vérifier si un sermon avec le même titre existe déjà
        $existing_sermon_query = $db->prepare("SELECT * FROM sermons WHERE title=:title");
        $existing_sermon_query->execute(['title' => $title]);
        $existing_sermon = $existing_sermon_query->fetch(PDO::FETCH_ASSOC);

        if ($existing_sermon) {
            $error = "Un sermon avec ce titre existe déjà.";
        } else {
            $query = $db->prepare('INSERT INTO sermons (title, description, audio, video) VALUES (:title, :description, :audio, :video)');
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':audio', $audioFile);
            $query->bindParam(':video', $videoFile);

            if ($query->execute()) {
                // Déplacer les fichiers audio et vidéo téléchargés dans les dossiers cibles
                if ((!empty($audioFile) && move_uploaded_file($audioTemp, $audioFolder)) || empty($audioFile)) {
                    if ((!empty($videoFile) && move_uploaded_file($videoTemp, $videoFolder)) || empty($videoFile)) {
                        $success = "Sermon ajouté avec succès";
                    } else {
                        $error = "Échec du téléchargement de la vidéo";
                    }
                } else {
                    $error = "Échec du téléchargement de l'audio";
                }
            } else {
                $error = "Erreur lors de l'ajout du sermon";
            }
        }
    }
}
?>