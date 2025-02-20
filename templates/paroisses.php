<?php
    require_once('../controllers/database/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paroisses</title>
    <link rel="icon" href="../asset/images/orthodox_cross.png">
    <link rel="stylesheet" href="../asset/css/common.css">
    <link rel="stylesheet" href="../asset/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Dancing+Script:wght@400..700&family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Klee+One:wght@400;600&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Outfit:wght@100..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Barre supérieure -->
<section class="header">

    <header>

        <div class="menu-bar">
            <a href="../index.php" class=" menu-logo"><img src="../asset/images/logo.png" alt="Logo de l'église"></a>
            <nav>
                <ul class="nav-links">
                    <li><a href="../index.php">ACCEUIL</a></li>
                    <li>
                        <a href="#">ORGANISATION</a>
                        <ul class="dropdown">
                            <li><a href="patriaches.php">Patriarche</a></li>
                            <li><a href="metropolites.php">Métropolites</a></li>
                            <li><a href="archeveches.php">Archevêchés</a></li>
                            <li><a href="priests.php">Prêtres</a></li>
                            <li><a href="soeurs.php">Soeurs Religieuses</a></li>
                            <li><a href="vicaires.php">Les Vicaires Paroissiaux</a></li>
                            <li><a href="diacres.php">Diacres</a></li>
                            <li><a  href="sous-diacres.php">Sous Diacres</a></li>
                            <li><a href="acolyte.php">Acolytes</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="activities.php">ACTIVITES</a></li>
                    <div class="logo"><img src="../asset/images/logo.png" alt="Logo de l'église"></div>
                    <li><a href="#" class="activ">PAROISSES</a></li>
                    <li><a href="library.php">BIBLIOTHEQUE</a></li>
                    <li ><a href="#" class="donate"><i class="bi bi-heart-fill"></i> FAIRE UN DON</a></li>
                </ul>
            </nav>
            <div class="our-menu">
                <i class="bi bi-list menu-icon"></i>
                <i class="bi bi-x exit-icon"></i>
            </div>
        </div>

    </header>
</section>
<section class="home-section">
    <div class="home-text fade-in">
        <h1>Nos paroisses</h1>
    </div>
    <div class="home-images">
        <div class="gradient-overlay"></div>
        <img class="home-bg" src="../asset/images/paroisses.jpg" alt="Image d'eglise">
    </div>
</section>
<section class="paroisses">
    <div class="container">
        <p class="section-subtitle">Découvrez nos paroisses et leurs responsables</p>

        <div class="paroisses-list">
            <?php
                $stmt = $db->prepare('SELECT * FROM parishes');
                $stmt->execute();
                $parishes = $stmt->fetchAll();
                if(!$parishes){
                    ?><p>Pas de paroisses ajoutées</p><?php
                }else{
                    foreach($parishes as $parishe){
                        ?>
                            <div class="paroisse">
                                <img src="images_paroisses/<?=$parishe['photo']?>" alt="Image <?=$parishe['parish_name']?>">
                                <h3><?=$parishe['parish_name']?></h3>
                                <p><?=$parishe['leaders']?></p>
                            </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="footer-container">
        <!-- Left Section -->
        <div class="footer-section">
            <h3 class="footer-title">Nos adresses</h3>
            <p class="footer-text">Bienvenue à l’Église Orthodoxe Fraternité Sainte Famille de Nazareth !</p>
            <p class="footer-text"><i class="bi bi-telephone-fill" style="font-size: 0.8rem;margin-right:5px"></i>+250 796129284 | 0728231090</p>
            <p class="footer-text"><i class="bi bi-geo-alt-fill"></i>kn 4 av 22 ,kigali-Rwanda</p>
            <p class="footer-text email"><i class="bi bi-envelope-fill"></i>contact@generalconsultinggroups.com</p>
        </div>

        <!-- Contact Us -->
        <div class="footer-section">
            <h3 class="footer-title">Contactez nous</h3>
            <form class="footer-form">
                <input type="text" placeholder="Nom" class="footer-input" />
                <input type="email" placeholder="E-mail" class="footer-input" />
                <textarea placeholder="Message" class="footer-textarea"></textarea>
                <button type="submit" class="footer-button">— Envoyer</button>
            </form>
        </div>
        <!-- Follow Us -->
        <div class="footer-section">
            <h3 class="footer-title">Suivez-nous</h3>
            <div class="footer-social">
                <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-link"><i class="bi bi-youtube"></i></a>
                <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
            </div>
            <div >
                <h3>Faites votre don avec nous</h3>
                <div>
                    <p >
                        Votre générosité peut faire une réelle différence ! Soutenez notre église en contribuant à nos missions et à nos projets communautaires. Chaque don, grand ou petit, aide à partager l'amour et à bâtir un avenir meilleur. Merci pour votre soutien précieux !
                    </p>
                    <a style="color:  #c75d5b;" href="">Cliquez ici pour laiser votre don</a>
                </div>
            </div>
        </div>
    </div>
    <p  class="footer-copy">© 2025 Église Orthodoxe Fraternité Sainte Famille de Nazareth, Tous droits réservés. Developpé par <a style="color: #914847;" href="https://softcreatix.com">Softcreatix</a></p>
    <p class="developed_by"></p>
</footer>
<script src="../asset/javascript/app.js"></script>
</body>
</html>

  