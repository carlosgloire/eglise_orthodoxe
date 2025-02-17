<?php
require_once('../controllers/database/db.php');

$success = $error = "";
if (isset($_GET['article_id']) && !empty($_GET['article_id'])) {
    $article_id = $_GET['article_id'];
    $stmt = $db->prepare('SELECT * FROM articles WHERE article_id = ?');
    $stmt->execute(array($article_id));
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$article) {
        echo '<script>alert("Article non trouvée");</script>';
        echo '<script>window.location.href="index.php";</script>';
        exit;
    }
} else {
    echo '<script>alert("Article non trouvée");</script>';
    echo '<script>window.location.href="index.php";</script>';
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    // Vérifiez si le titre et la description sont vides
    if (empty($title) || empty($description)) {
        $error = "Veuillez ajouter le titre et la description";
    } else {
        // Gérer l'upload de l'image
        $filename = $_FILES['uploadfile']['name'];
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $folder = "../pages/article_images/" . $filename;

        // Préparer la requête pour mettre à jour l'article
        $query = "UPDATE articles 
                  SET title = :title, 
                      description = :description, 
                      article_image = CASE WHEN :article_image IS NOT NULL THEN :article_image ELSE article_image END 
                  WHERE article_id = :article_id";

        $stmt = $db->prepare($query);

        // Lier les valeurs
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':article_id', $article_id);

        // Vérifier si une nouvelle image a été uploadée
        $uploadedImage = !empty($filename) ? $filename : null;
        $stmt->bindParam(':article_image', $uploadedImage);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Déplacer le fichier uploadé uniquement s'il existe
            if (!empty($filename) && move_uploaded_file($tempname, $folder)) {
                $success = "Article mis à jour avec succès.";
            } elseif (empty($filename)) {
                $success = "Article mis à jour sans modification de l'image.";
            } else {
                $error = "Erreur lors du téléchargement de l'image.";
            }
        } else {
            $error = "Erreur lors de la mise à jour de l'article.";
        }
    }
}

// Récupérer les données de l'article actuel
$query = "SELECT * FROM articles WHERE article_id = :article_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':article_id', $article_id);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);
?>
