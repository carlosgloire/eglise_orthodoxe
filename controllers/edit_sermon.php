<?php
require_once('../controllers/database/db.php');

$success = $error = "";
if (isset($_GET['sermon_id']) && !empty($_GET['sermon_id'])) {
    $sermon_id = $_GET['sermon_id'];
    $stmt = $db->prepare('SELECT * FROM sermons WHERE sermon_id = ?');
    $stmt->execute([$sermon_id]);
    $sermon = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$sermon) {
        echo '<script>alert("Sermon non trouvé");</script>';
        echo '<script>window.location.href="index.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Sermon non trouvé");</script>';
    echo '<script>window.location.href="index.php";</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir le titre et la description.";
    } else {
        // File management
        $video_name = !empty($_FILES['video']['name']) ? $_FILES['video']['name'] : null;
        $audio_name = !empty($_FILES['audio']['name']) ? $_FILES['audio']['name'] : null;
        $video_path = "../pages/sermons/videos/" . $video_name;
        $audio_path = "../pages/sermons/audio/" . $audio_name;

        // Check video file size (50MB = 50 * 1024 * 1024 bytes)
        if ($video_name && $_FILES['video']['size'] > 50 * 1024 * 1024) {
            $error = "La vidéo ne doit pas dépasser 50 Mo.";
        } else {
            $query = "UPDATE sermons 
                      SET title = :title, 
                          description = :description, 
                          video = CASE WHEN :video IS NOT NULL THEN :video ELSE video END, 
                          audio = CASE WHEN :audio IS NOT NULL THEN :audio ELSE audio END 
                      WHERE sermon_id = :sermon_id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':sermon_id', $sermon_id);

            // Bind values only if new files are uploaded
            if ($video_name) {
                $stmt->bindParam(':video', $video_name);
            } else {
                $stmt->bindValue(':video', null, PDO::PARAM_NULL);
            }

            if ($audio_name) {
                $stmt->bindParam(':audio', $audio_name);
            } else {
                $stmt->bindValue(':audio', null, PDO::PARAM_NULL);
            }

            if ($stmt->execute()) {
                // Only move uploaded files if the sizes are valid
                if ($video_name && move_uploaded_file($_FILES['video']['tmp_name'], $video_path)) {
                    $success = "Sermon mis à jour avec succès (vidéo modifiée).";
                }
                if ($audio_name && move_uploaded_file($_FILES['audio']['tmp_name'], $audio_path)) {
                    $success = "Sermon mis à jour avec succès (audio modifié).";
                }
                if (!$video_name && !$audio_name) {
                    $success = "Sermon mis à jour sans modification des fichiers.";
                }
            } else {
                $error = "Erreur lors de la mise à jour du sermon.";
            }
        }
    }
}
?>
