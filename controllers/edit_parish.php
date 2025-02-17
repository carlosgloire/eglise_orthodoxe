<?php
require('../controllers/database/db.php');
$success = null;
$error = null;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $parish_id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM parishes WHERE id = ?');
    $stmt->execute([$parish_id]);
    $parish= $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$parish) {
        echo '<script>alert("Paroisse non trouvé");</script>';
        echo '<script>window.location.href="paroisses.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Paroisse non trouvé");</script>';
    echo '<script>window.location.href="paroisses.php";</script>';
    exit;
}

if (isset($_POST['edit'])) {
    $parish_name = $_POST['parish_name'];
    $leaders = $_POST['leaders'];

    // Fetch the existing image
    $query = "SELECT photo FROM parishes WHERE id = :parish_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':parish_id', $parish_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_image = $row['photo'];  // Store existing image path

    // Handle file upload
    if (!empty($_FILES['uploadfile']['name'])) {
        $target_dir = "../templates/images_paroisses/";
        $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
        move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file);
        $image = $target_file;  // Use new uploaded image
    } else {
        $image = $existing_image;  
    }

    // Update database
    $updateQuery = "UPDATE parishes SET parish_name = :parish_name, leaders = :leaders, photo = :photo WHERE id = :parish_id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':parish_name', $parish_name);
    $stmt->bindParam(':leaders', $leaders);
    $stmt->bindParam(':photo', $image);
    $stmt->bindParam(':parish_id', $parish_id);

    if ($stmt->execute()) {
        echo '<script>alert("Paroisse mise à jour avec succès !");</script>';
        echo '<script>window.location.href="paroisses.php";</script>';
        exit;
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>
