<?php 
    session_start();
    require_once('../controllers/database/db.php');
    require_once('../controllers/functions.php');
    logout();

    $success = null;
    $error = null;

    if (isset($_POST['add'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../templates/activities_images/" . $filename;
        
        $category = trim($_POST['category']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $date_activity = trim($_POST['date_activity']);
        
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

        if (empty($filename) || empty($category) || empty($title) || empty($description) || empty($date_activity)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!empty($filename) && !preg_match($pattern, $filename)) {
            $error = "L'image doit être au format jpg, jpeg ou png.";
        } else {
            $query = $db->prepare("INSERT INTO activities (image, category, title, description, date_activity) 
                                   VALUES (:image, :category, :title, :description, :date_activity)");
            
            if (!empty($filename)) {
                $query->bindParam(':image', $filename);
            } else {
                $defaultImage = "default.jpg";
                $query->bindParam(':image', $defaultImage);
            }
            
            $query->bindParam(':category', $category);
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':date_activity', $date_activity);
            
            if ($query->execute()) {
                if (move_uploaded_file($tempname, $folder) AND empty($error)) {
                    $success = "Activité ajoutée avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de l'ajout de l'activité.";
            }
        }
    }
?>
