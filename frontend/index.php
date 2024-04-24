<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil - Arcadia</title>
    <link rel="stylesheet" href="styles/accueil.css">
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
            <button><a class="liens-sans-couleur" href="index.php">Accueil</a></button>
            <button><a class="liens-sans-couleur" href="Client/services.php">Tous nos services</a></button>
            <button><a class="liens-sans-couleur" href="Client/habitats.php">Tous nos habitats</a></button>
            <button><a class="liens-sans-couleur" href="Client/connexion.php">Connexion</a></button>
            <button><a class="liens-sans-couleur" href="Client/contact.php">Contact</a></button>
        </section>
    </header>

    <!--Contenu principal de la page, message de bienvenue, contacts, connection-->
    <main>
        <img class="tigre-style" src="images/tigres.jpg">
        <section class="container-principal-presentation">
            <article class="container-presentation-bienvenue">

                <div class="bienvenue-style">BIENVENUE SUR ARCADIA !</div>
                <div class="presentation-style">Arcadia est un zoo situé en France près de la forêt de Brocéliande, en bretagne depuis 1960.
                    Notre zoo possède tout un panel d’animaux, répartis par habitat (savane, jungle, marais) dont nous faisons
                    extrêmement attention à leurs santés. Chaque jour, plusieurs de nos vétérinaires viennent afin
                    d’effectuer les contrôles sur chaque animal avant l’ouverture du zoo afin de s’assurer que tout
                    se passe bien, de même, toute la nourriture donnée est calculée afin d’avoir le bon grammage précisé dans le rapport du vétérinaire.
                    Nos animaux sont heureux, et cela fait la fierté de notre directeur, José, à ce poste depuis plusieurs années désormais.</div>
                    <img class="pandas-style" src="images/pandas.jpg">
            </article>
        </section>

        <!--Partie qui gère les habitats, les servies et les avis de la page d'accueil-->
        <section class="container-principal-animaux">

            <article class="titre-partie-habitat">
                <p>Découvrez nos Habitats</p>
            </article>

            <!--les habitats-->
            <section class="colonne-habitat">
            <article>
                <a href="Client/habitats-animaux/savane.php">
                <img class="habitat-présentation-image" src="images/girafe-savane.jpg" alt="Girafe dans une Savane">
                </a>
                <h2>La Savane</h2>
                <h4>Girafes, Zèbres, Hippotragues, Rhinocéros blancs, Tortues géantes, Otocyons...</h4>
            </article>
            <article>
                <a href="Client/habitats-animaux/jungle.php">
                <img class="habitat-présentation-image" src="images/elephant-jungle.jpg" alt="Elephants en troupe">
                </a>
                <h2>La Jungle</h2>
                <h4>Éléphants, Gorilles, Crocodiles, Pandas, Perroquets, Léopards... </h4>
            </article>
            <article>
                <a href="Client/habitats-animaux/marais.php">
                <img class="habitat-présentation-image" src="https://cdn-images.zoobeauval.com/YSvzY1CUz3jYkUTSSOq6L0jKvCA=/1600x950/https%3A%2F%2Fs3.eu-west-3.amazonaws.com%2Fimages.zoobeauval.com%2F2020%2F05%2F01-reservehippo-header-5ecd403a47d47.jpg" alt="Hippopotame">
                </a>
                <h2>Les Marais</h2>
                <h4>Hippopotames, patamochères, bongos, nyalas, pélicans, et autre...</h4>
            </article>
            </section>

            <article class="titre-partie-habitat">
                <p>Nos Services</p>
            </article>
            <!--servies d'accueil-->
            <section class="colonne-habitat">
                <article>
                    <a href="Client/services.php">
                        <img class="service-présentation-image" src="images/petit-train.jpg" alt="Petit train du Zoo">
                    </a>
                    <h2>Visites en petit train</h2>
                    <h4>Lamantins, hippopotames pygmées, langurs de Douc, dragons de Komodo…</h4>
                </article>
                <article>
                    <a href="Client/services.php">
                    <img class="service-présentation-image" src="https://cdn-images.zoobeauval.com/SvhMMxNzgIc_ZKPkNUHIRk3us2o=/730x730/https%3A%2F%2Fs3.eu-west-3.amazonaws.com%2Fimages.zoobeauval.com%2F2020%2F05%2F01-ap9i5458-header-5ec4daa0d69fb.jpg" alt="Présentation du parc par une animatrice">
                    </a>
                    <h2>Visites guidées gratuites</h2>
                    <h4>Pandas géants, panthères des neiges, pandas roux, takins...</h4>
                </article>
                <article>
                    <a href="Client/services.php">
                    <img class="service-présentation-image" src="images/restaurant-zoo.webp" alt="Restaurant dans le Zoo avec vue sur les Girafes">
                    </a>
                    <h2>Restauration</h2>
                    <h4>Hippopotames, patamochères, bongos, nyalas, pélicans...</h4>
                </article>
            </section>

            <article class="titre-partie-habitat">
                <p>Ils ont adoré</p>
            </article>

            <!-- Avis du Zoo -->
            <section class="colonne-avis">
                <?php
                // Suppose que $bdd est votre connexion à la base de données

                // Récupération des avis validés depuis la base de données
                $query = $bdd->query('SELECT * FROM avis_clients WHERE valide = 1');

                // Affichage des avis validés
                while ($avis = $query->fetch()) {
                    ?>
                    <article>
                        <h4><?= $avis['pseudo'] ?></h4>
                        <h6>Note : <?= $avis['note'] ?>/5</h6>
                        <h6><?= $avis['avis'] ?></h6>
                    </article>
                    <?php
                }
                ?>
            </section>

            <section class="colonne-etoile">
                <article>
                    <img class="etoile-image" src="images/green-star.png">
                </article>
                <article>
                    <img class="etoile-image" src="images/green-star.png">
                </article>
                <article>
                    <img class="etoile-image" src="images/green-star.png">
                </article>
                <article>
                    <img class="etoile-image" src="images/green-star.png">
                </article>
                <article>
                    <img class="etoile-coupée" src="images/green-star.png">
                </article>
            </section>
            <article class="titre-partie-habitat">
                <p style="font-size: 40px">Total : 4.7/5</p>
            </article>

            <article class="titre-partie-habitat">
                <p style="font-size: 50px">Laissez un Avis</p>
            </article>

            <form action="../backend/traitement_avis.php" method="POST">
                <fieldset class="container-formulaire-avis">

                    <!--Partie qui gère les avis-->
                    <div>
                        <label for="name">Pseudo :</label>
                        <input class="style-input" min="16" max="35" required="" type="text" id="name" name="pseudo">
                    </div> <br/>
                    <div>
                        <label for="note">Note :</label>
                        <input class="style-input" min="16" max="35" required="" type="text" name="note">
                    </div> <br/>
                    <div>
                        <label for="description">Laissez votre commentaire :</label>
                        <textarea style="margin-top: 10px" cols="62" rows="10"  name="avis" min="20" max="450" ></textarea>
                    </div>
                    <!-- bouton de soumission du formulaire d'avis-->
                    <input class="bouton-formulaire" type="submit" name="submit" value="Soumettre l'avis">

                </fieldset>
            </form>

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
            <img src="images/x.png" alt="x">
            <img src="images/youtube.png" alt="Youtube">
            <img src="images/linkedin.png" alt="Linkedin">
            <img src="images/google.png" alt="Google">
            <img src="images/facebook.png" alt="Facebook">
        </div>
        <div class="copywright">
            <p>© 2024 Mon Site Web. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>