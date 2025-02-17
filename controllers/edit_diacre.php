<?php
session_start();
require_once('../controllers/database/db.php');
require_once('../controllers/functions.php');
logout();

$success = null;
$error = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare('SELECT * FROM diacres WHERE id = :id');
    $query->bindParam(':id', $id);
    $query->execute();
    $diacre = $query->fetch(PDO::FETCH_ASSOC);
    
    if (!$diacre) {
        echo "<script>alert('Le diacre n\'existe pas');</script>";
        echo '<script>window.location.href="organisation.php";</script>';
        exit;
    }
}

if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../templates/diacres_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

    if (empty($name)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!preg_match($pattern, $_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\".";
    } else {
        if (!empty($filename)) {
            $query = $db->prepare('UPDATE diacres SET photo = :photo, name = :name WHERE id = :id');
            $query->bindParam(':photo', $filename);
        } else {
            $query = $db->prepare('UPDATE diacres SET name = :name WHERE id = :id');
        }
        $query->bindParam(':name', $name);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            if (!empty($filename) && move_uploaded_file($tempname, $folder)) {
                $success = "Diacre mis à jour avec succès.";
            } else {
                echo "<script>alert('Diacre mis à jour sans nouvelle photo');</script>";
                echo '<script>window.location.href="organisation.php";</script>';
                exit;
            }
        } else {
            echo "<script>alert('Erreur lors de la mise à jour du diacre.');</script>";
            echo '<script>window.location.href="organisation.php";</script>';
            exit;
        }
    }
}
?>