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
    <title>Organisation</title>

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
                <a href="home_slide_images.php">
                    <i class="bi bi-file-earmark-image"></i>
                    <span>Images de Fond</span>
                </a>
                <a href="library.php">
                    <i class="bi bi-journal-richtext"></i>
                    <span>Bibliothèque</span>
                </a>
                <a   href="paroisses.php">
                    <i class="bi bi-house-door"></i>
                    <span>Paroisses</span>
                </a>
                <a  href="activities.php">
                    <i class="bi bi-journal-richtext"></i>
                    <span>Activités</span>
                </a>

                <a class="activ" href="organisation.php">
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
            <p style="margin-left: 20px;margin-right:20px;margin-top:15px">Dans cette section vous pouvez gérer les patriarches,métropolites,archevêque,prêtre,religieuse. soit les supprimer, les modifier ou les ajouter</p>
            <div class="image-details">
                <div class="bouttons" style="gap: 10px;">
                    <div class="add-image">
                        <a href="add_patriarche.php">Ajouter un patriarche</a>
                    </div>
                    <div class="add-image">
                        <a href="add_metropolite.php">Ajouter un métropolite</a>
                    </div>
                    <div class="add-image">
                        <a href="add_archeveches.php">Ajouter un archevêque</a>
                    </div>
                    <div class="add-image">
                        <a href="add_priest.php">Ajouter un prêtre</a>
                    </div>
                    <div class="add-image">
                        <a href="add_nun.php">Ajouter une religieuse</a>
                    </div>
                    <div class="add-image">
                        <a href="add_vicaire.php">Ajouter un vicaire</a>
                    </div>
                    <div class="add-image">
                        <a href="add_diacre.php">Ajouter un diacre</a>
                    </div>
                    <div class="add-image">
                        <a href="add-sous-diacre.php">Ajouter un sous diacre</a>
                    </div>
                    <div class="add-image">
                        <a href="add-acolyte.php">Ajouter un acolyte</a>
                    </div>
                </div>
                <div class="paroisses">
                    <div class="container">
                        <h4 style="margin-bottom: 10px;">Patriarches</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM patriarches');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun patriarche ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/patriarches_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-patriarche"  patriarche_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_patriarche.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px ;margin-top:10px">Métropolites</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM metropolites');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun patriarche ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/metropolites_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3  delete-metropolite"  metropolite_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_metropolite.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px ;margin-top:10px">Archevêques</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM archeveques');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun archeveque ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/archeveques_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <p><?=$result['title']?></p>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-archeveque"  archeveque_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_archeveque.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px ;margin-top:10px">Prêtres</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM priests');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun pretre ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/pretres_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <p><?=$result['title']?></p>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-priest"  priest_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_priest.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px ;margin-top:10px">Soeurs religieuse</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM nuns');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucune soeur ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/soeurs_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <p><?=$result['title']?></p>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-nun"  nun_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_nun.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px ;margin-top:10px">Les Vicaires Paroissiaux</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM vicaires');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun vicaire ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/vicaires_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <p><?=$result['title']?></p>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-vicaire"  vicaire_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_vicaire.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px;margin-top:10px">Diacres</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM diacres');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun diacre ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/diacres_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-diacre" diacre_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_diacre.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px;margin-top:10px">Sous Diacres</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM sous_diacres');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun sous diacre ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/sous_diacres_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-sous_diacre"  sous_diacre_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_sous_diacre.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <h4 style="margin-bottom: 10px;margin-top:10px">Acolytes</h4>
                        <div class="paroisses-list">
                            <?php
                                $stmt = $db->prepare('SELECT * FROM acolytes');
                                $stmt->execute();
                                $results = $stmt->fetchAll();
                                if(!$results){
                                    ?><p>Aucun acolyte ajouté</p><?php
                                }else{
                                    foreach($results as $result){
                                        ?>
                                            <div class="paroisse">
                                                <img src="../templates/acolytes_images/<?=$result['photo']?>" alt="Image <?=$result['name']?>">
                                                <h5><?=$result['name']?></h5>
                                                <div class="buttons" style="font-size: 16px;">
                                                    <i class="bi bi-trash3 delete delete-acolyte"  acolyte_id="<?= $result['id'] ?>" title="Supprimer"></i>
                                                    <a class="edit" href="edit_acolyte.php?id=<?=$result['id']?>"><i class="bi bi-pen" title="Modifier"></i></a>
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
        <?=popup_delete_patriarche()?>
        <?=popup_delete_metropolite()?>
        <?=popup_delete_priest()?>
        <?=popup_delete_sous_diacre()?>
        <?=popup_delete_vicaire()?>
        <?=popup_delete_diacre()?>
        <?=popup_delete_acolyte()?>
        <?=popup_delete_nun()?>

        <?=popup_delete_archeveque()?>
    </section>
    <script src="../asset/javascript/menu_admin.js"></script>
    <script src="../asset/javascript/app.js"></script>
    <script src="../asset/javascript/organisation.js"></script>

</body>
</html>