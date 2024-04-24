<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');


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


// Vérification de l'existence de l'identifiant de l'animal et récupération des données si présent
if(isset($_GET["id"]) AND !empty($_GET["id"])){
    $getID = $_GET['id'];

    $recupAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
    $recupAnimal->execute(array($getID));
    if($recupAnimal->rowCount() > 0) {
        $animalData = $recupAnimal->fetch();
        $nom_animal = $animalData['nom_animal'];
        $race_animal = $animalData['race_animal'];
        $idHabitat = $animalData['idHabitat'];

        if (isset($_POST['submit'])) {
            // Vérifie si une image a été téléchargée
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Récupère le contenu de l'image téléchargée
                $imgData = file_get_contents($_FILES['image']['tmp_name']);

                // Requête préparée pour mettre à jour la base de données avec l'image
                $updateAnimal = $bdd->prepare('UPDATE animaux SET img = ? WHERE id = ?');
                $updateAnimal->execute(array($imgData, $getID));
            }

            // Récupère les autres informations saisies
            $nom_saisi = $_POST['nom_animal'];
            $race_saisi = $_POST['race_animal'];
            $idHabitat_saisi = $_POST['idHabitat'];

            // Requête préparée pour mettre à jour les autres informations
            $updateAnimal = $bdd->prepare('UPDATE animaux SET nom_animal = ?, race_animal = ?, idHabitat = ? WHERE id = ?');
            $updateAnimal->execute(array($nom_saisi, $race_saisi, $idHabitat_saisi, $getID));

            // modifie l'animal dans MongoDB
            $collection->updateOne(
                ['nom_animal' => $nom_saisi],
                ['$set' => ['race_animal' => $race_saisi]]
            );

            // Redirection après la mise à jour
            header('Location: animauxadmin.php');
        }
    } else {
        echo 'Aucune données trouvées.';
    }
} else {
    echo "Aucun identifiant n'a été trouvé.";
}

// Vérification de la session active
if(!$_SESSION['motdepasse']) {
    header('Location: ../frontend/Client/connexion.php');
}
?>

<!doctype html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../../frontend/styles/espace-admin.css">
    <link rel="stylesheet" href="../../frontend/styles/connexion.css">
    <link rel="stylesheet" href="../../frontend/styles/contact.css">
    <link rel="stylesheet" href="../../frontend/styles/accueil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Modifier un membre</title>
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
    <article class="lien"><a href="../espace-admin.php">Accueil</a></article>
    <article class="lien"><a href="../administrateur/membres.php">Afficher tous les membres</a></article>
    <article class="lien" ><a href="../administrateur/servicesadmin.php">Gérer les Services</a></article>
    <article class="lien" ><a href="../administrateur/animauxadmin.php">Gérer les Animaux</a></article>
    <article class="lien" ><a href="../administrateur/habitatadmin.php">Gérer les Habitats</a></article>
    <article class="lien" ><a href="../administrateur/avis-veterinaire.php">Avis vétérinaire</a></article>
    <article class="lien"><a href="../deconnexion.php">Déconnexion</a></article>
</nav>
<!--Afficher tous les membres-->
<div class="crud-container-texte">
    <div class="crud-colonne">
        <h1 style="text-align: ">Modifier un Animal</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="" enctype="multipart/form-data">
            <label for="nom_animal">Nom de l'animal:</label>
            <input type="text" name="nom_animal" value="<?= $nom_animal ?>">

            <label for="race_animal">Race de l'animal:</label>
            <input type="text" name="race_animal" value="<?= $race_animal; ?>">

            <label for="idHabitat">Identifiant de l'habitat:</label>
            <input type="text" name="idHabitat" value="<?= $idHabitat; ?>">
            <br>
            <label for="image">Image de l'animal:</label>
            <input type="file" name="image">

            <input type="submit" name="submit" value="Valider les modifications">
        </form>


    </div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>