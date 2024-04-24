<?php
session_start();
// Connexion à la base de données MYSQL
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Connexion à la base de donnée MongoDB
require 'C:/xampp/vendor/autoload.php';
use MongoDB\Client;

try {
    $mongoClient = new MongoDB\Client("mongodb+srv://killiancodes:Tactac2003*@cluster0.ho8h1io.mongodb.net/");
    $database = $mongoClient->animaux;
    $collection = $database->animal;
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}

// Récupération des données des animaux depuis MongoDB
$animaux = $collection->find();


// Vérifie si l'ID provient de l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Prend un identifiant existant
    $getID = $_GET['id'];

    $recupAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
    $recupAnimal->execute(array($getID));
    if ($recupAnimal->rowCount() > 0) {
        // Données existantes
        $animalData = $recupAnimal->fetch();
        $nom_animal = $animalData['nom_animal'];
        $race_animal = $animalData['race_animal'];
        $idHabitat = $animalData['idHabitat'];
        $id = $animalData['id'];
    } else {
        echo 'Aucune donnée trouvée.';
    }
} else {
    // Crée un nouvel animal
    $getID = null;
    $nom_animal = '';
    $race_animal = '';
    $idHabitat = '';
    $id = '';

    // Soumission pour création
    if (isset($_POST['submit'])) {
        // récupère les informations saisies
        $nom_saisi = $_POST['nom_animal'];
        $race_saisi = $_POST['race_animal'];
        $idHabitat = $_POST['idHabitat'];
        $id = $_POST['id'];

        // Vérifie si une image a été téléchargée
        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Récupère le contenu de l'image téléchargée
            $imgData = file_get_contents($_FILES['image']['tmp_name']);



            // Insére un nouvel animal dans la table animaux
            $createAnimal = $bdd->prepare('INSERT INTO animaux ( nom_animal, race_animal, img, idHabitat) VALUES (?, ?, ?, ?)');
            $createAnimal->execute(array($nom_saisi, $race_saisi, $imgData, $idHabitat));

            // Récupérer l'ID de l'animal nouvellement créé
            $idAnimal = $bdd->lastInsertId();

            // Insére un nouvel enregistrement dans la table compte_rendu avec l'ID de l'animal
            $createAnimalCompte_rendu = $bdd->prepare('INSERT INTO compte_rendu (nom_animal, id) VALUES (?, ?)');
            $createAnimalCompte_rendu->execute(array($nom_saisi, $idAnimal));

            // Insére un nouvel enregistrement dans la table compte_rendu avec l'ID de l'animal
            $createAnimalCompte_rendu = $bdd->prepare('INSERT INTO nourriture_animal (id) VALUES (?)');
            $createAnimalCompte_rendu->execute(array($idAnimal));

            // Insére les données dans MongoDB
            $collection->insertOne([
                'nom_animal' => $nom_saisi,
                'race_animal' => $race_saisi,
                'nombre_visites' => 0 // Nombre de visites initialisées à 0 pour ce nouvel animal
            ]);


            // Redirection après la création
            header('Location: animauxadmin.php');
        } else {
            echo 'Une erreur est survenue lors du téléchargement de l\'image.';
        }
    }
}

// Vérifie si l'utilisateur est bien connecté
if (!$_SESSION['motdepasse']) {
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
        <h1 style="text-align: ">Créer un Animal</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="" enctype="multipart/form-data">
            <label for="nom_animal">Nom de l'animal:</label>
            <input type="text" name="nom_animal" value="<?= $nom_animal ?>">
            <br>
            <label for="race_animal">Race de l'animal:</label>
            <input type="text" name="race_animal" value="<?= $race_animal; ?>">
            <br>
            <label for="idHabitat">Identifiant de l'habitat:</label>
            <input type="text" name="idHabitat" value="<?= $idHabitat; ?>">
            <br>
            <!-- Champ pour télécharger l'image -->
            <label for="image">Image de l'animal:</label>
            <input type="file" name="image">

            <input type="submit" name="submit" value="Créer cet Animal">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>