<?php

require_once('../controllers/database/db.php');

if (isset($_GET['sermon_id']) && !empty($_GET['sermon_id'])) {
    $getid = $_GET['sermon_id'];
    $recup_id = $db->prepare('SELECT * FROM sermons WHERE sermon_id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_image = $db->prepare('DELETE FROM sermons WHERE sermon_id = ?');
        $delete_image->execute(array($getid));
        echo '<script>alert("Sermon supprimé avec succès");</script>';
        echo '<script>window.location.href="../admin/activities.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucun sermon trouvé');</script>";
        echo '<script>window.location.href="../admin/activities.php";</script>';
        exit;
    }
}
?>