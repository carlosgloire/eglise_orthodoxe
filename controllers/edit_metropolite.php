<?php
require('../controllers/database/db.php');
$success = null;
$error = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $metropolite_id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM metropolites WHERE id = ?');
    $stmt->execute([$metropolite_id]);
    $metropolite = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$metropolite) {
        echo '<script>alert("Métropolite non trouvé");</script>';
        echo '<script>window.location.href="metropolites.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Métropolite non trouvé");</script>';
    echo '<script>window.location.href="metropolites.php";</script>';
    exit;
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];

    // Récupérer l’image existante
    $query = "SELECT photo FROM metropolites WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $metropolite_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_image = $row['photo'];

    // Gestion de l'upload de l'image
    if (!empty($_FILES['uploadfile']['name'])) {
        $target_dir = "../templates/metropolites_images/";
        $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
        $image = basename($_FILES["uploadfile"]["name"]); 
    } else {
        $image = $existing_image;
    }

    // Mise à jour dans la base de données
    $updateQuery = "UPDATE metropolites SET name = :name, photo = :photo WHERE id = :id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':photo', $image);
    $stmt->bindParam(':id', $metropolite_id);

    if ($stmt->execute()) {
        echo '<script>alert("Métropolite mis à jour avec succès !");</script>';
        echo '<script>window.location.href="organisation.php";</script>';
        exit;
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>
