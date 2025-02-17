<?php

require_once('../controllers/database/db.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recup_id = $db->prepare('SELECT * FROM ebooks WHERE id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_image = $db->prepare('DELETE FROM ebooks WHERE id = ?');
        $delete_image->execute(array($getid));
        echo '<script>alert("E-book supprimée avec succès");</script>';
        echo '<script>window.location.href="../admin/library.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucune E-book trouvée');</script>";
        echo '<script>window.location.href="../admin/library.php";</script>';
        exit;
    }
}
?>