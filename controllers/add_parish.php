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
        $folder = "../templates/images_paroisses/" . $filename;
        
        $parish_name = trim($_POST['parish_name']);
        $leaders = trim($_POST['leaders']);
        
        $allowedExtensions = ['png', 'jpg', 'jpeg'];
        $pattern = '/\.(' . implode('|', $allowedExtensions) . ')$/i';

        if (empty($filename) || empty($parish_name) || empty($leaders)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!preg_match($pattern, $filename)) {
            $error = "L'image doit être au format jpg, jpeg ou png.";
        } else {
            $existing_parish_query = $db->prepare("SELECT * FROM parishes WHERE parish_name = :parish_name");
            $existing_parish_query->execute(['parish_name' => $parish_name]);
            $existing_parish = $existing_parish_query->fetch(PDO::FETCH_ASSOC);

            if ($existing_parish) {
                $error = "Une paroisse avec ce nom existe déjà.";
            } else {
                $query = $db->prepare("INSERT INTO parishes (photo, parish_name, leaders) VALUES (:photo, :parish_name, :leaders)");
                
                $query->bindParam(':photo', $filename);
                $query->bindParam(':parish_name', $parish_name);
                $query->bindParam(':leaders', $leaders);
                
                if ($query->execute()) {
                    if (move_uploaded_file($tempname, $folder)) {
                        $success = "Paroisse ajoutée avec succès.";
                    } else {
                        $error = "Échec du téléchargement de l'image.";
                    }
                } else {
                    $error = "Erreur lors de l'ajout de la paroisse.";
                }
            }
        }
    }
?>
