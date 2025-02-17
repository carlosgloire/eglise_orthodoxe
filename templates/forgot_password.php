<?php require_once('../controllers/send-password-reset.php')?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>

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
    <link rel="icon" href="../asset/images/logo.png" type="image/png" sizes="16x16">
</head>

<body>
    <section class="login-section">
        <div class="login">
            <h2>Mot de passe oublié</h2>
            <form action="" method="post">
                <p style="text-align: center;padding:10px">Pour réinitialiser votre mot de passe, veuillez saisir votre <br> adresse e-mail  dans le champ prévu à cet effet.</p>
                <div class="all-inputs">
                    <i class="bi bi-envelope"></i>
                    <input style="width: 100%;" type="email" name="email" placeholder="Entrez votre email">
                </div>

                <div class="submit">
                    <input type="submit" name="send" value="Envoyer">
                </div>
        
                <p style="color:red;font-size:13px;text-align:center"><?=$error?></p>
                <p style="color:green;font-size:13px;text-align:center"><?=$success?></p>
            </form>
        </div>
    </section>

    <script src="../asset/javascript/app.js"></script>
</body>

</html>
