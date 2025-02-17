<?php
    session_start();
    require('../controllers/database/db.php');
    require_once('../controllers/functions.php');
    notconnected();
    logout();

    $tables = [
        "gallery_photo" => "Photos Galerie",
        "ebooks" => "E-books",
        "parishes" => "Paroisses",
        "activities" => "Activités",
        "patriarches" => "Patriarches",
        "metropolites" => "Métropolites",
        "archeveques" => "Archevêques",
        "priests" => "Prêtres",
        "nuns" => "Religieuses",
        "vicaires" => "Vicaires",
        "diacres" => "Diacres",
        "sous_diacres" => "Sous-Diacres",
        "acolytes" => "Acolytes"
    ];

    $counts = [];

    foreach ($tables as $table => $label) {
        $query = $db->query("SELECT COUNT(id) AS count FROM $table");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $counts[$label] = $result['count'];
    }

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>

    <!--css-->
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/admin.css">


    <!--Font family-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Icons-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <link rel="icon" href="../asset/images/orthodox_cross.png" type="image/png" sizes="16x16">
</head>

<body>

    <!-- Admin header -->

    <header  class="header-admin">
        <div>
            <h2>La sainte Famille</h2>
        </div>
        <div class="admin-menu">
            <i class="bi bi-list menu-icon-admin"></i>
            <i class="bi bi-x exit-icon-admin"></i>
        </div>
    </header>

    <section class="admin-section">
        <div class="first-bloc">
            <nav>
                <a href="#" class="activ">
                    <i class="bi bi-clipboard-pulse"></i>
                    <span>Tableau de Bord</span>
                </a>
                <a  href="home_slide_images.php">
                    <i class="bi bi-file-earmark-image"></i>
                    <span>Images de Fond</span>
                </a>
                <a href="library.php">
                    <i class="bi bi-journal-richtext"></i>
                    <span>Bibliothèque</span>
                </a>
                <a href="paroisses.php">
                    <i class="bi bi-house-door"></i>
                    <span>Paroisses</span>
                </a>
                <a href="activities.php">
                    <i class="bi bi-journal-richtext"></i>
                    <span>Activités</span>
                </a>

                <a href="organisation.php">
                    <i class="bi bi-book"></i>
                    <span>Organisation</span>
                </a>
                 <form class="button" action="" method="post">
                    <button  name="logout" style="font-size: 1rem;">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Se Deconnecter</span>
                    </button>
                </form>
            </nav>
        </div>
        <div class="second-bloc">
            <div class="bloc-container">
                <?php foreach ($counts as $label => $count): ?>
                    <div class="bloc">
                        <h1><?= $count ?></h1>
                        <p><?= $label ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="../asset/javascript/menu_admin.js"></script>
</body>
</html>