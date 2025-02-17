<?php
require('../controllers/database/db.php');
$success = null;
$error = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $patriarch_id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM patriarches WHERE id = ?');
    $stmt->execute([$patriarch_id]);
    $patriarch = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$patriarch) {
        echo '<script>alert("Patriarche non trouvé");</script>';
        echo '<script>window.location.href="patriarches.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Patriarche non trouvé");</script>';
    echo '<script>window.location.href="patriarches.php";</script>';
    exit;
}

if (isset($_POST['edit'])) {
    $name = $_POST['name'];

    // Récupérer l’image existante
    $query = "SELECT photo FROM patriarches WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $patriarch_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_image = $row['photo'];  

    // Gestion de l'upload de l'image
    if (!empty($_FILES['uploadfile']['name'])) {
        $target_dir = "../templates/patriarches_images/";
        $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
        $image = basename($_FILES["uploadfile"]["name"]); 
    } else {
        $image = $existing_image;  
    }

    // Mise à jour dans la base de données
    $updateQuery = "UPDATE patriarches SET name = :name, photo = :photo WHERE id = :id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':photo', $image);
    $stmt->bindParam(':id', $patriarch_id);

    if ($stmt->execute()) {
        echo '<script>alert("Patriarche mis à jour avec succès !");</script>';
        echo '<script>window.location.href="organisation.php";</script>';
        exit;
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>