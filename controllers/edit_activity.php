<?php
require('../controllers/database/db.php');
$success = null;
$error = null;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $activity_id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM activities WHERE id = ?');
    $stmt->execute([$activity_id]);
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$activity) {
        echo '<script>alert("Activité non trouvée");</script>';
        echo '<script>window.location.href="activites.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Activité non trouvée");</script>';
    echo '<script>window.location.href="activites.php";</script>';
    exit;
}

if (isset($_POST['edit'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_activity = $_POST['date_activity'];

    // Fetch the existing image
    $query = "SELECT image FROM activities WHERE id = :activity_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':activity_id', $activity_id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_image = $row['image'];  // Store existing image name

    // Handle file upload
    if (!empty($_FILES['uploadfile']['name'])) {
        $target_dir = "../templates/activities_images/";
        $image_name = basename($_FILES["uploadfile"]["name"]);
        $target_file = $target_dir . $image_name;

        // Move the uploaded file to the directory
        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
            $image = $image_name;  // Store only the image name in the database
        } else {
            $error = "Erreur lors de l'upload de l'image.";
            $image = $existing_image;  // Keep existing image if upload fails
        }
    } else {
        $image = $existing_image;  // Keep existing image if no new file is uploaded
    }

    // Update database
    $updateQuery = "UPDATE activities SET category = :category, title = :title, description = :description, image = :image, date_activity = :date_activity WHERE id = :activity_id";
    $stmt = $db->prepare($updateQuery);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':date_activity', $date_activity);
    $stmt->bindParam(':activity_id', $activity_id);

    if ($stmt->execute()) {
        echo '<script>alert("Activité mise à jour avec succès !");</script>';
        echo '<script>window.location.href="activities.php";</script>';
        exit;
    } else {
        $error = "Erreur lors de la mise à jour.";
    }
}
?>