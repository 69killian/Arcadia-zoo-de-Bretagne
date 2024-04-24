<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Habitats - Arcadia</title>
    <link rel="stylesheet" href="../styles/accueil.css"> 
    <link rel="stylesheet" href="../styles/services.css">
    <link rel="stylesheet" href="../styles/habitats.css">
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
            <h1> NOS HABITATS</h1>
            <h4>Voici un monde extraordinaire où la diversité de la vie sauvage s'épanouit dans des habitats exceptionnels au cœur de notre zoo captivant. Préparez-vous à une aventure immersive à travers les splendeurs des marais, la luxuriante jungle et les vastes étendues de la savane, où chaque recoin offre une fenêtre fascinante sur la vie animale.
                <br><br> Bienvenue dans une expérience où chaque moment est une rencontre avec la beauté naturelle et la diversité extraordinaire de notre planète. Bienvenue au Parc Naturel Extraordinaire, où l'émerveillement prend vie.
            </h4>
        </article>
        <img class="image-services" src="../images/zoo-services.jpg" alt="Girafe et des enfants">
    </section>
</header>

<!--Contenu principal de la page -->
<main>


    <!--Partie qui gère les habitats-->
    <section class="container-habitats-animaux">

        <article class="titre-partie-habitat">
            <p>Découvrez nos Habitats</p>
        </article>

        <!--les habitats-->
        <section class="colonne-habitat">

            <?php
            // Requête pour récupérer les données des habitats depuis la base de données
            $recupHabitats = $bdd->query('SELECT * FROM habitat');

            // Boucle pour parcourir les résultats et afficher les habitats
            while ($habitat = $recupHabitats->fetch()) {
                ?>
                <article class="colonne-habitat">
                    <a href="<?= $habitat['lien_habitat']; ?>">
                        <img class="habitat-présentation-image" src="data:image/jpeg;base64,<?= base64_encode($habitat['img']); ?>" alt="Image de l'habitat <?= $habitat['nom_habitat']; ?>">
                    </a>
                    <h2><?= $habitat['nom_habitat']; ?></h2>
                    <button class="boutton-decouvrir"><a class="liens-sans-couleur" href="<?= $habitat['lien_habitat']; ?>">Découvrir <?= $habitat['nom_habitat']; ?></a></button>
                    <!--/**/-->
                </article>
                <?php
            }
            // Fin de la boucle
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