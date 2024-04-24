<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');
?>
<?php

require 'C:/xampp/vendor/autoload.php';
use MongoDB\Client;
// Connexion à MongoDB

try {
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017/");
    $database = $mongoClient->animaux;
    $collection = $database->animal;
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}

// Récupération des données des animaux depuis MongoDB
$animaux = $collection->find();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Jungle - Arcadia</title>
    <link rel="stylesheet" href="../../styles/accueil.css">
    <link rel="stylesheet" href="../../styles/services.css">
    <link rel="stylesheet" href="../../styles/habitats.css">
    <link rel="stylesheet" href="../../styles/marais.css">
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
        <button><a class="liens-sans-couleur" href="../../index.php">Accueil</a></button>
        <button><a class="liens-sans-couleur" href="../services.php">Tous nos services</a></button>
        <button><a class="liens-sans-couleur" href="../habitats.php">Tous nos habitats</a></button>
        <button><a class="liens-sans-couleur" href="../connexion.php">Connexion</a></button>
        <button><a class="liens-sans-couleur" href="../contact.php">Contact</a></button>
    </section>
    <section>
        <article class="titre-services">
            <h1>  LA JUNGLE </h1>
            <h4>Découvrez une escapade unique au cœur de la nature, où l'aventure et la préservation de la faune se rencontrent harmonieusement. Notre parc offre bien plus qu'une simple visite ; c'est une immersion totale dans le monde captivant de la vie sauvage. Explorez nos habitats naturels, délectez-vous de délices culinaires, participez à des visites guidées passionnantes, ou détendez-vous à bord de notre petit train pittoresque.
                <br><br> Bienvenue dans une expérience où chaque moment est une rencontre avec la beauté naturelle et la diversité extraordinaire de notre planète. Bienvenue au Parc Naturel Extraordinaire, où l'émerveillement prend vie.
            </h4>
        </article>
        <img class="image-services" src="../../images/jungle.jpeg" alt="Jungle">
    </section>
</header>


    <!--Partie qui gère les animaux -->
    <main>

        <section class="container-animaux-marais">

            <article class="titre-partie-habitat">
                <p>Découvrez nos Animaux</p>
            </article>

            <!--les habitats-->
            <section class="colonne-habitat">
                <?php
                // Requête pour récupérer les données des habitats depuis la base de données
                $query = "SELECT a.*, c.*, n.* FROM animaux AS a
          JOIN compte_rendu AS c ON a.id = c.id
          JOIN nourriture_animal AS n ON a.id = n.id
          WHERE a.idHabitat = 2";

                $recupData = $bdd->query($query);

                // Initialisation du compteur
                $count = 0;

                // Début de la boucle pour afficher les animaux
                while ($data = $recupData->fetch()) {
                    // Incrémenter le compteur à chaque animal
                    $count++;

                    // Commence une nouvelle ligne après chaque 3e animal
                    if ($count % 3 == 1) {
                        echo '<div class="row">';
                    }
                    ?>
                    <article>
                        <img class="habitat-présentation-image update-visits" src="data:image/jpeg;base64,<?= base64_encode($data['img']); ?>" alt="<?= $data['nom_animal']; ?>">
                        <h2><?= $data['nom_animal'] ?></h2>
                        <h4>Race : <?= $data['race_animal'] ?></h4>
                        <h4>Santé : <?= $data['etat_sante'] ?> </h4>
                        <h4>Nourriture : <?= $data['nourriture'] ?></h4>
                        <h4>Grammage quotidien : <?= $data['grammage_nourriture'] ?> </h4>
                        <h4>Heure dîner : <?= $data['heure_manger'] ?> </h4>
                        <h4>Date de passage : <?= $data['date_passage'] ?> </h4>
                        <h4>Détails sur l'État de l'animal : <?= $data['compte_rendu_veterinaire'] ?></h4>
                    </article>
                    <?php
                    // Ferme la ligne après chaque 3e animal
                    if ($count % 3 == 0) {
                        echo '</div>';
                    }
                }

                // Ferme la dernière ligne si le nombre d'animal n'est pas un multiple de trois
                if ($count % 3 != 0) {
                    echo '</div>';
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
        <img src="../../images/x.png">
        <img src="../../images/youtube.png">
        <img src="../../images/linkedin.png">
        <img src="../../images/google.png">
        <img src="../../images/facebook.png">
    </div>
    <div class="copywright">
        <p>© 2024 Mon Site Web. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>

<script src="../../scripts/fiche-animal.js">
</script>
