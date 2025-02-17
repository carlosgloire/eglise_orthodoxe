<?php

require_once('../controllers/database/db.php');

if (isset($_GET['article_id']) && !empty($_GET['article_id'])) {
    $getid = $_GET['article_id'];
    $recup_id = $db->prepare('SELECT * FROM articles WHERE article_id = ?');
    $recup_id->execute(array($getid));
    if ($recup_id->rowCount() > 0) {
        $delete_image = $db->prepare('DELETE FROM articles WHERE article_id = ?');
        $delete_image->execute(array($getid));
        echo '<script>alert("Article supprimé avec succès");</script>';
        echo '<script>window.location.href="../admin/paroisses.php";</script>';
        exit;
    } else {
        echo "<script>alert('Aucun article trouvé');</script>";
        echo '<script>window.location.href="../admin/paroisses.php";</script>';
        exit;
    }
}
?>