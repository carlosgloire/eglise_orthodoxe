<?php 
    session_start();
    require_once('../controllers/database/db.php');
    require_once('../controllers/functions.php');
    logout();

    $success = null;
    $error = null;
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $ebook_id = $_GET['id'];
        $stmt = $db->prepare('SELECT * FROM ebooks WHERE id = ?');
        $stmt->execute([$ebook_id]);
        $ebook= $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$ebook) {
            echo '<script>alert("Ebook non trouvé");</script>';
            echo '<script>window.location.href="library.php";</script>';
            exit;
        }
    } else {
        echo '<script>alert("Ebook non trouvé");</script>';
        echo '<script>window.location.href="library.php";</script>';
        exit;
    }

    if (isset($_POST['edit'])) {
        $category = trim($_POST['category']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);
        
        $query = $db->prepare("SELECT image FROM ebooks WHERE id = :id");
        $query->execute(['id' => $ebook_id]);
        $ebook = $query->fetch(PDO::FETCH_ASSOC);
        $filename = $ebook['image'];
        
        if (!empty($_FILES["uploadfile"]["name"])) {
            $tempname = $_FILES["uploadfile"]["tmp_name"];
            $filename = $_FILES["uploadfile"]["name"];
            $folder = "../templates/ebooks/" . $filename;

            $allowedExtensions = ['png', 'jpg', 'jpeg'];
            $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

            if (!preg_match($pattern, $filename)) {
                $error = "L'image doit être au format jpg, jpeg ou png.";
            } else {
                move_uploaded_file($tempname, $folder);
            }
        }
        
        if (empty($category) || empty($title) || empty($description) || empty($price)) {
            $error = "Tous les champs sont obligatoires.";
        } else {
            $query = $db->prepare("UPDATE ebooks SET image = :image, category = :category, title = :title, description = :description, price = :price WHERE id = :id");
            
            $query->bindParam(':image', $filename);
            $query->bindParam(':category', $category);
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':price', $price);
            $query->bindParam(':id', $ebook_id);
            
            if ($query->execute()) {
                echo '<script>alert("Ebook modifié avec succès.");</script>';
                echo '<script>window.location.href="library.php";</script>';
                exit;
            } else {
                $error = "Erreur lors de la modification de l'ebook.";
            }
        }
    }
?>
