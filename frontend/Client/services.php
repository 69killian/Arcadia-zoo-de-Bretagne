<?php
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Arcadia</title>
    <link rel="stylesheet" href="../styles/accueil.css">
    <link rel="stylesheet" href="../styles/services.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
</head>
<body>

<!--Header de la page, logo, et bouttons principaux du site-->
<header>
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
    <section>
        <article class="titre-services">
            <h1>NOS SERVICES </h1>
            <h4>Découvrez une escapade unique au cœur de la nature, où l'aventure et la préservation de la faune se rencontrent harmonieusement. Notre parc offre bien plus qu'une simple visite ; c'est une immersion totale dans le monde captivant de la vie sauvage. Explorez nos habitats naturels, délectez-vous de délices culinaires, participez à des visites guidées passionnantes, ou détendez-vous à bord de notre petit train pittoresque.
                <br><br> Bienvenue dans une expérience où chaque moment est une rencontre avec la beauté naturelle et la diversité extraordinaire de notre planète. Bienvenue au Parc Naturel Extraordinaire, où l'émerveillement prend vie.
            </h4>
        </article>
        <img class="image-services" src="../images/zoo-services.jpg" alt="Girafe et des enfants">
    </section>
</header>

<!--Contenu principal de la page-->
<main>

    <section class="container-principal-services">
        <section class="colonne-habitat-services">
            <h4>
                Que vous soyez passionné par la gastronomie, avide de connaissances ou simplement à la recherche d'une expérience tranquille, nos services variés ont été conçus pour répondre à toutes les attentes. Nous sommes impatients de vous offrir une journée inoubliable au cœur de la nature et de la vie sauvage. Venez créer des souvenirs mémorables avec nous !
            </h4>
            <?php
            // Récupération des données des services depuis la base de données
            $recupServices = $bdd->query('SELECT * FROM services');

            while($service = $recupServices->fetch()) {
            ?>
            <article>
                <img class="image-service-page" src="data:image/jpeg;base64,<?= base64_encode($service['img']); ?>" alt="<?= $service['nom_service']; ?>">
                <h2><?= $service['nom_service']; ?></h2>
                <h4><?= $service['description_service']; ?></h4>
                <p style="font-size: 20px;">Horaires : <?= $service['horaires']; ?></p>
            </article>
            <?php
        }
        ?>
        </section>
    </section>
</main>


<!-- Site footer -->
<footer class="pied-de-page">
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