<?php

require_once('../controllers/database/db.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recup_id = $db->prepare('SELECT * FROM archeveques WHERE id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_element = $db->prepare('DELETE FROM archeveques WHERE id = ?');
        $delete_element->execute(array($getid));
        echo '<script>alert("Archeveque supprimé avec succès");</script>';
        echo '<script>window.location.href="../admin/organisation.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucun archeveque trouvé');</script>";
        echo '<script>window.location.href="../admin/organisation.php";</script>';
        exit;
    }
}
?>