<?php
    session_start();
    require_once('../controllers/login_admin.php');
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--css-->
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../asset/css/admin.css">

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
    <link rel="icon" href="../asset/images/logo.png" type="image/png" sizes="16x16">
</head>

<body>
    <!-- Le css de cette page se trouve dans product -->
    <section class="login-section">
        <div class="login">
            <h2>Connexion</h2>
            <form action="" method="post">
                <div class="all-inputs">
                    <i class="bi bi-envelope"></i>
                    <input type="email"  style="width:100%" name="mail" placeholder="Entrer votre email" value="<?=isset($mail)?$mail:""?>">
                </div>
                <div class="all-inputs passwo">
                    <div class="pass">
                        <i class="bi bi-key"></i>
                        <input style="width:100%" class="password" name="password" type="password" placeholder="Entrer le mot de passe" >
                    </div>
                    <div class="eyes">
                        <i class="bi bi-eye  close hidden"></i>
                        <i class="bi bi-eye-slash open"></i>
                    </div>
                </div>
                <div class="forgot-password">
                    Mot de passse oublié veuillez cliquer<a style="padding-right: 50px;" href="forgot_password.php"> ici?</a>
                </div>
                <div class="submit">
                    <input type="submit" name="login" value="Connexion">
                </div>
                
                <p style="color:red;font-size:13px;text-align:center"><?=$error?></p>
            </form>
        </div>
    </section>

    <script>
        let passwords = document.querySelector('.password');
        let openIcon = document.querySelector('.open');
        let closeIcon = document.querySelector('.close');

        passwords.setAttribute('type', 'password');

        openIcon.onclick = function () {
            passwords.setAttribute('type', 'text');
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }

        closeIcon.onclick = function () {
            passwords.setAttribute('type', 'password');
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        }
    </script>
</body>

</html>