<?php

require_once('../controllers/database/db.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recup_id = $db->prepare('SELECT * FROM gallery_video WHERE id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_image = $db->prepare('DELETE FROM gallery_video WHERE id = ?');
        $delete_image->execute(array($getid));
        echo '<script>alert("Vidéo supprimée avec succès");</script>';
        echo '<script>window.location.href="../admin/index.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucune Vidéo  trouvée');</script>";
        echo '<script>window.location.href="../admin/index.php";</script>';
        exit;
    }
}
?>