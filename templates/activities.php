<?php
    require_once('../controllers/database/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités</title>
    <link rel="icon" href="../asset/images/orthodox_cross.png">
    <link rel="stylesheet" href="../asset/css/styles.css">
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
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
                        <a href="#" >ORGANISATION</a>
                        <ul class="dropdown">
                            <li><a href="patriaches.php">Patriarches </a></li>
                            <li><a href="metropolites.php">Métropolite</a></li>
                            <li><a href="archeveches.php">Archevêchés</a></li>
                            <li><a href="priests.php">Les Prêtres</a></li>
                            <li><a href="soeurs.php">Soeurs Religieuses</a></li>
                            <li><a href="vicaires.php">Les Vicaires Paroissiaux</a></li>
                            <li><a href="diacres.php">Diacres</a></li>
                            <li><a  href="sous-diacres.php">Sous Diacres</a></li>
                            <li><a  href="acolyte.php">Acolytes</a></li>
                        </ul>
                    </li>
                    
                    <li><a class="activ">ACTIVITES</a></li>
                    <div class="logo"><img src="../asset/images/logo.png" alt="Logo de l'église"></div>
                    <li><a href="paroisses.php" >PAROISSES</a></li>
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
        <h1>Nos differentes activités</h1>
    </div>
    <?php
        $query = $db->prepare('SELECT * FROM activities_background ');
        $query->execute();
        $images = $query->fetchAll();
    ?>
    <div class="home-images">
        <div class="gradient-overlay"></div>
        <?php foreach ($images as $image): ?>
            <img class="home-bg" src="activities_background/<?=$image['photo']?>" alt="<?=$image['photo']?>">
        <?php endforeach; ?>
    </div>
    <div class="circle-btn">
        <?php foreach ($images as $index => $image): ?>
            <div class="circle <?= $index === 0 ? 'active' : ''; ?>"></div>
        <?php endforeach; ?>
    </div>
</section>
<?php
require_once('../controllers/database/db.php');

if (isset($_GET['main_id'])) {
    $mainId = $_GET['main_id'];

    // Récupérer l'activité sélectionnée comme principale
    $queryMain = $db->prepare("SELECT * FROM activities WHERE id = :main_id");
    $queryMain->bindParam(':main_id', $mainId);
    $queryMain->execute();
    $mainActivity = $queryMain->fetch(PDO::FETCH_ASSOC);
} else {
    // Récupérer la dernière activité ajoutée si aucun id n'est passé
    $queryMain = $db->prepare("SELECT * FROM activities ORDER BY date_activity DESC LIMIT 1");
    $queryMain->execute();
    $mainActivity = $queryMain->fetch(PDO::FETCH_ASSOC);
}

// Récupérer les activités complémentaires (exclure la principale)
$queryOthers = $db->prepare("SELECT * FROM activities WHERE id != :main_id ORDER BY date_activity DESC");
$queryOthers->bindParam(':main_id', $mainActivity['id']);
$queryOthers->execute();
$otherActivities = $queryOthers->fetchAll(PDO::FETCH_ASSOC);

?>
<section class="blog-section">
    <!-- Activité principale -->
    <div class="featured">
    <?php if ($mainActivity): ?>
        <aside>
            <img src="activities_images/<?= htmlspecialchars($mainActivity['image']) ?>" alt="<?= htmlspecialchars($mainActivity['title']) ?>">
        </aside>
        <div>
            <?php
            setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'french'); // Définir la langue en français
            $dateFormatted = strftime("le %d %B, %Y", strtotime($mainActivity['date_activity']));
            ?>
            <span><?= htmlspecialchars($mainActivity['category']) ?> • <?= ucfirst(utf8_encode($dateFormatted)) ?></span>
            <h3><?= htmlspecialchars($mainActivity['title']) ?></h3>

            <?php 
                $description = nl2br(htmlspecialchars($mainActivity['description']));
                $shortDescription = nl2br(htmlspecialchars(substr($mainActivity['description'], 0, 593))) . '...';
                $isLongText = strlen($mainActivity['description']) > 593;
            ?>

            <p class="description"><?= $isLongText ? $shortDescription : $description ?></p>
            <p class="full-description" style="display: none;"><?= $description ?></p>

            <?php if ($isLongText): ?>
                <span class="show-more-btn" style="cursor: pointer;">Afficher plus de texte</span>
                <span class="show-less-btn" style="display: none;cursor:pointer">Afficher moins de texte</span>
            <?php endif; ?>
        </div>
        <?php else: ?>
            <p>Aucune activité disponible.</p>
        <?php endif; ?>
    </div>



    <!-- Activités complémentaires -->
    <div class="trending">
        <h3>Activités Complémentaires</h3>
        <div class="swiper">
            <div class="swiper-wrapper">
                <?php if ($otherActivities): ?>
                    <?php foreach ($otherActivities as $activity): ?>
                        <div class="swiper-slide">
                            <a href="?main_id=<?= $activity['id'] ?>">
                                <img src="activities_images/<?= htmlspecialchars($activity['image']) ?>" alt="<?= htmlspecialchars($activity['title']) ?>">
                            </a>
                            <h4><?= htmlspecialchars($activity['title']) ?></h4>
                            <p><?= substr(htmlspecialchars($activity['description']), 0, 50) ?>...</p>
                            <?php
                            setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'french'); // Définir la langue en français
                            $dateFormatted = strftime("le %d %B, %Y", strtotime($activity['date_activity']));
                            ?>
                            <span><?= htmlspecialchars($activity['category']) ?> • <?= ucfirst(utf8_encode($dateFormatted)) ?></span>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p>Aucune activité complémentaire.</p>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

  <script>
    const swiper = new Swiper('.swiper', {
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  </script>

<footer class="footer">
    <div class="footer-container">
        <!-- Left Section -->
        <div class="footer-section">
            <h3 class="footer-title">Nos adresses</h3>
            <p class="footer-text">Bienvenue à l’Église Orthodoxe Fraternité Sainte Famille de Nazareth</p>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const showMoreBtn = document.querySelector(".show-more-btn");
    const showLessBtn = document.querySelector(".show-less-btn");
    const shortText = document.querySelector(".description");
    const fullText = document.querySelector(".full-description");

    if (showMoreBtn && showLessBtn) {
        showMoreBtn.addEventListener("click", function () {
            shortText.style.display = "none";
            fullText.style.display = "block";
            showMoreBtn.style.display = "none";
            showLessBtn.style.display = "inline-block";
        });

        showLessBtn.addEventListener("click", function () {
            shortText.style.display = "block";
            fullText.style.display = "none";
            showMoreBtn.style.display = "inline-block";
            showLessBtn.style.display = "none";
        });
    }
});
</script>


</body>
</html>

