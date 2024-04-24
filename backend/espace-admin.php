<?php

session_start();
// Si la session ne démarre pas, alors on retourne sur la page de connexion
if(!$_SESSION['motdepasse']) {
    header('Location: ../frontend/Client/connexion.php');
}
?>
<?php

require 'C:/xampp/vendor/autoload.php';
use MongoDB\Client;
// Connexion à MongoDB
$mongoClient = new MongoDB\Client("mongodb+srv://killiancodes:Tactac2003*@cluster0.ho8h1io.mongodb.net/");
// Sélection de la base de données et de la collection
$database = $mongoClient->animaux;
$collection = $database->animal;

// Récupération des données des animaux
$animaux = $collection->find();

?>

<!doctype html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="../frontend/styles/espace-admin.css">
        <link rel="stylesheet" href="../frontend/styles/connexion.css">
        <link rel="stylesheet" href="../frontend/styles/contact.css">
        <link rel="stylesheet" href="../frontend/styles/accueil.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
        <title>Home</title>
        <meta charset="utf-8">
    </head>
    <body>

    <header>
        <section class="logo-header-container">
            <div class="logo-header-style-1">A<span class="white-color">RC</span>A<span class="white-color">DI</span>A</div>
            <div class="logo-header-style-2">ZOO DE BRETAGNE</div>
        </section>
    </header>

    <nav class="navigation">
            <div class="titre-nav">ESPACE ADMINISTRATEUR</div>
        <article class="lien"><a href="espace-admin.php">Accueil</a></article>
            <article class="lien"><a href="administrateur/membres.php">Afficher tous les membres</a></article>
            <article class="lien" ><a href="administrateur/servicesadmin.php">Gérer les Services</a></article>
        <article class="lien" ><a href="administrateur/animauxadmin.php">Gérer les Animaux</a></article>
        <article class="lien" ><a href="administrateur/habitatadmin.php">Gérer les Habitats</a></article>
        <article class="lien" ><a href="administrateur/avis-veterinaire.php">Avis vétérinaire</a></article>
        <article class="lien"><a href="deconnexion.php">Déconnexion</a></article>
    </nav>

    <h1 class="titre-statistiques">Statistiques des visites</h1>
    <main class="flex-statistique">
        <?php foreach ($animaux as $animal): ?>
            <article class="animal">
                <h4>Animal : <?php echo isset($animal['nom_animal']) ? $animal['nom_animal'] : ''; ?></h4>
                <h4>Race : <?php echo isset($animal['race_animal']) ? $animal['race_animal'] : ''; ?></h4>
                <h4>Nombre de Visites : <?php echo isset($animal['nombre_visites']) ? $animal['nombre_visites'] : ''; ?></h4>
            </article>
        <?php endforeach; ?>

    </main>

    <main>
    </body>
</html>
