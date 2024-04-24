<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contactez-nous - Arcardia</title>
    <link rel="stylesheet" href="../styles/connexion.css">
    <link rel="stylesheet" href="../styles/accueil.css">
    <link rel="stylesheet" href="../styles/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<header class="header-formulaire">
    <section class="logo-header-container">
        <div class="logo-header-style-1">A<span class="white-color">RC</span>A<span class="white-color">DI</span>A</div>
        <div class="logo-header-style-2">ZOO DE BRETAGNE</div>
    </section>
    <section class="menu-button-container">
        <button><a class="liens-sans-couleur" href="../index.php">Accueil</a></button>
        <button><a class="liens-sans-couleur" href="services.php">Tous nos services</a></button>
        <button><a class="liens-sans-couleur" href="habitats.php">Tous nos habitats</a></button>
        <button><a class="liens-sans-couleur" href="connexion.php">Connexion</a></button>
        <button><a class="liens-sans-couleur" href="contact.php">Contact</a></button>
    </section>
</header>
<main role="main" class="contenu-principal">

    <form action="../../backend/formulaire-contact.php" method="post">
        <fieldset class="container-formulaire-contact">
        <h1 style="text-align: center">Nous contacter</h1>

            <!--Partie qui gère le nom et les e-mails-->
            <div>
                <label for="name">Sujet de votre demande :</label>
                <input class="style-input" required="" min="16" max="35"  type="text" name="sujet" placeholder="Sujet">
            </div> <br/>
            <div>
                <label for="name">Votre Nom :</label>
                <input class="style-input" required="" min="16" max="35"  type="text" name="nom" placeholder="Nom">
            </div> <br/>
            <div>
                <label for="email">E-mail :</label>
                <input class="style-input" required="" min="16" max="35" type="email" name="email" placeholder="Email">
            </div> <br/>
            <div>
                <label for="description">Précisez votre demande :</label>
                <textarea style="margin-top: 10px" required="" cols="62" rows="10" name="message" min="20" max="450" ></textarea>
            </div>


            <!-- bouton de connexion-->
            <input class="bouton-formulaire" type="submit" name="submit" value="Nous faire parvenir">

        </fieldset>
    </form>
</main>
<footer class="pied-de-page-connexion">
    <div class="contact-info">
        <p>Contactez-nous :</p>
        <p>Email : arcadia.contact29@gmail.com</p>
        <p>Téléphone : +33 1 23 45 67 89</p>
        <p>Adresse : All. de Kerrousseau, 56620 Pont-Scorff</p>
    </div>
    <div class="container-image-pied-page">
        <img src="../images/x.png">
        <img src="../images/youtube.png">
        <img src="../images/linkedin.png">
        <img src="../images/google.png">
        <img src="../images/facebook.png">
    </div>
    <div class="copywright">
        <p>© 2024 Mon Site Web. Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>



