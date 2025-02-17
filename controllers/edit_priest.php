<?php
require('../controllers/database/db.php');
$success = null;
$error = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $prete_id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM priests WHERE id = ?');
    $stmt->execute([$prete_id]);
    $prete = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$prete) {
        echo '<script>alert("Prêtre non trouvé");</script>';
        echo '<script>window.location.href="pretres.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Prêtre non trouvé");</script>';
    echo '<script>window.location.href="pretres.php";</script>';
    exit;
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $title = $_POST['title'];

    // Récupérer l’image existante
    $query = "SELECT photo FROM priests WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $prete_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_image = $row['photo'];

    // Gestion de l'upload de l'image
    if (!empty($_FILES['uploadfile']['name'])) {
        $target_dir = "../templates/pretres_images/";
        $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
        $image = basename($_FILES["uploadfile"]["name"]); 
    } else {
        $image = $existing_image;
    }

    // Mise à jour dans la base de données
    $updateQuery = "UPDATE priests SET name = :name, title = :title, photo = :photo WHERE id = :id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':photo', $image);
    $stmt->bindParam(':id', $prete_id);

    if ($stmt->execute()) {
        echo '<script>alert("Prêtre mis à jour avec succès !");</script>';
        echo '<script>window.location.href="organisation.php";</script>';
        exit;
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>