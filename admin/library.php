<?php
    session_start();
    require('../controllers/database/db.php');
    require_once('../controllers/functions.php');
    notconnected();
    logout()
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque</title>

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
                <a href="index.php">
                    <i class="bi bi-clipboard-pulse"></i>
                    <span>Tableau de Bord</span>
                </a>
                <a  href="home_slide_images.php">
                    <i class="bi bi-file-earmark-image"></i>
                    <span>Images de Fond</span>
                </a>
                <a class="activ" href="#">
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
            <p style="margin-right:20px;margin-top:15px">Dans cette section vous trouverez les images de la galerie,les images de fond pour la galerie et les ebooks, vous pouvez ajouter, suprimer les images ainsi que modifier les ebooks </p>
            <div class="image-details">
                <div class="bouttons" >
                    <div class="add-image">
                        <a href="add_gallery_background.php">Ajouter images de fond</a>
                    </div>
                    <div class="add-image">
                        <a href="add_photos.php">Ajouter une image</a>
                    </div>
                    <div class="add-image">
                        <a href="add_ebook.php">Ajouter un livre</a>
                    </div>
                </div>
                <h3 style="text-align: center;margin-top:15px">Images de Fond pour la Galerie</h3>
                <div class="image-items">
                    <?php
                        $stmt = $db->prepare('SELECT * FROM gallery_background');
                        $stmt->execute();
                        $photos = $stmt->fetchAll();
                        
                        if( empty($photos)){
                            ?><p>Aucune photo ajoutée dans la galerie</p><?php
                        }else{
                            foreach($photos as $photo_background){
                            ?>
                                <div>
                                    <p><img src="../templates/gallery_background/<?=$photo_background['photo']?>" alt=""></p>
                                    <i background_id="<?= $photo_background['id'] ?>" class="bi bi-trash3 delete-background"></i>                                </div>
                            <?php
                            }
                        }
                    ?>
                   
                </div>
                <h3 style="text-align: center;margin-top:15px">Images de la Galerie</h3>
                <div class="image-items">
                    <?php
                        $stmt = $db->prepare('SELECT * FROM gallery_photo');
                        $stmt->execute();
                        $photos = $stmt->fetchAll();
                        
                        if( empty($photos)){
                            ?><p>Aucune photo ajoutée dans la galerie</p><?php
                        }else{
                            foreach($photos as $photo){
                            ?>
                                <div>
                                    <p><img src="../templates/gallery_images/<?=$photo['photo']?>" alt=""></p>
                                    <i gallery_id="<?= $photo['id'] ?>" class="bi bi-trash3 delete delete-image"></i>
                                </div>
                            <?php
                            }
                        }
                    ?>
                   
                </div>
                <div class="ebook-carousel-section">
                    <h3>Livres Électroniques </h3>
                    <div class="carousel-wrapper">
                        <div class="carousel-container" id="carouselContainer">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM ebooks');
                                $stmt->execute();
                                $ebooks = $stmt->fetchAll();
                                if(! $ebooks){
                                    ?><p>Aucun Livre Ajouté</p><?php
                                }else{
                                    foreach($ebooks as $ebook){
                                        ?>
                                            <div class="ebook-card">
                                                <img src="../templates/ebooks/<?=$ebook['image']?>" alt="<?=$ebook['title']?>">
                                                <div>
                                                    <h4><?=$ebook['title']?></h4>
                                                    <p class="category"><?=$ebook['category']?></p>
                                                    <p class="price">Prix: <?=$ebook['price']?></p>
                                                    <div class="rating">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                    </div>
                                                    <div class="buttons" style="font-size: 16px;">
                                                        <i class="bi bi-trash3 delete-book" title="Supprimer" book_id="<?= $ebook['id'] ?>"></i>
                                                        <a class="edit" href="edit_ebook.php?id=<?=$ebook['id']?>" ><i class="bi bi-pen" title="Modifier"></i></a>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?=popup_delete_image()?>
        <?=popup_delete_image_background()?>
        <?=popup_delete_book()?>
    </section>
    <script src="../asset/javascript/menu_admin.js"></script>
    <script src="../asset/javascript/popup_delete_image.js"></script>
    <script src="../asset/javascript/delete_gallery_background.js"></script>
    <script src="../asset/javascript/delete_ebook.js"></script>
</body>
</html>