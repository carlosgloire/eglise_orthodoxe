<?php 
    session_start();
    require_once('../controllers/database/db.php');
    require_once('../controllers/functions.php');
    logout();

    $success = null;
    $error = null;

    if (isset($_POST['add'])) {
        $filename = $_FILES["uploadfile"]["name"];
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "../templates/ebooks/" . $filename;
        
        $category = trim($_POST['category']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

        if (empty($filename) || empty($category) || empty($title) || empty($description) || empty($price)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!preg_match($pattern, $filename)) {
            $error = "L'image doit être au format jpg, jpeg ou png.";
        } else {
            $existing_ebook_query = $db->prepare("SELECT * FROM ebooks WHERE title = :title");
            $existing_ebook_query->execute(['title' => $title]);
            $existing_ebook = $existing_ebook_query->fetch(PDO::FETCH_ASSOC);

            if ($existing_ebook) {
                $error = "Un ebook avec ce titre existe déjà.";
            } else {
                $query = $db->prepare("INSERT INTO ebooks (image, category, title, description, price) VALUES (:image, :category, :title, :description, :price)");
                
                $query->bindParam(':image', $filename);
                $query->bindParam(':category', $category);
                $query->bindParam(':title', $title);
                $query->bindParam(':description', $description);
                $query->bindParam(':price', $price);
                
                if ($query->execute()) {
                    if (move_uploaded_file($tempname, $folder)) {
                        $success = "Ebook ajouté avec succès.";
                    } else {
                        $error = "Échec du téléchargement de l'image.";
                    }
                } else {
                    $error = "Erreur lors de l'ajout de l'ebook.";
                }
            }
        }
    }
?>