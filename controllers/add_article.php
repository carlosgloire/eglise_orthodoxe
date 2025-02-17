<?php
$success = null;
$error = null;
require_once('../controllers/database/db.php');
function generateSlug($title) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
}

if (isset($_POST['add'])) {
    $title = htmlspecialchars($_POST['title']);
    $description = $_POST['description'];
    $filename = $_FILES["uploadfile"]["name"];
    $filesize = $_FILES["uploadfile"]["size"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../pages/article_images/" . $filename;
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';
    $slug = generateSlug($title);

    if (empty($title) || empty($description)) {
        $error = "Veuillez remplir tous les champs";
    } elseif (empty($filename)) {
        $error = "Veuillez choisir une image pour l'article";
    } elseif (!preg_match($pattern, $filename)) {
        $error = "Votre fichier doit être au format \"jpg, jpeg ou png\"";
    } elseif ($filesize > 2000000) {
        $error = "Votre fichier ne doit pas dépasser 2Mo";
    } else {
        // Vérifier si un article avec le même titre existe déjà
        $existing_article_query = $db->prepare("SELECT * FROM articles WHERE title=:title");
        $existing_article_query->execute(['title' => $title]);
        $existing_article = $existing_article_query->fetch(PDO::FETCH_ASSOC);

        if ($existing_article) {
            $error = "Un article avec ce titre existe déjà";
        } else {
            $query = $db->prepare('INSERT INTO articles (title, description, article_image, article) VALUES (:title, :description, :article_image, :article)');
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':article_image', $filename);
            $query->bindParam(':article', $slug);
            if ($query->execute()) {
                // Déplacer le fichier téléchargé dans le dossier cible
                if (move_uploaded_file($tempname, $folder)) {
                    $success = "Article publié avec succès";
                } else {
                    $error = "Échec du téléchargement de l'image";
                }
            } else {
                $error = "Erreur lors de la publication de l'article";
            }
        }
    }
}
?>