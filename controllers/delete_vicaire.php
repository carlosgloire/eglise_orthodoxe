<?php

require_once('../controllers/database/db.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getid = $_GET['id'];
    $recup_id = $db->prepare('SELECT * FROM vicaires WHERE id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_element = $db->prepare('DELETE FROM vicaires WHERE id = ?');
        $delete_element->execute(array($getid));
        echo '<script>alert("Vicaire supprimé avec succès");</script>';
        echo '<script>window.location.href="../admin/organisation.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucun vicaire trouvé');</script>";
        echo '<script>window.location.href="../admin/organisation.php";</script>';
        exit;
    }
}
?>