<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
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
    <link rel="stylesheet" href="../../frontend/styles/employe/animaux-employe.css"
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Afficher tous les Animaux</title>
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
    <div class="titre-nav">ESPACE <br>EMPLOYÉ</div>
    <article class="lien"><a href="../espace-employe.php">Validation des avis</a></article>
    <article class="lien"><a href="../employe/services-employe.php">Modifier les Services</a></article>
    <article class="lien" ><a href="../employe/animaux-employe.php">Nourriture Animal</a></article>
    <article class="lien"><a href="../deconnexion.php">Déconnexion</a></article>
</nav>
<main style="margin-top: 1500px">
<h1 style="text-align: center; color: white;">Gérer la nourriture</h1>
<!--Afficher tous les membres-->
<div class="crud-container">
    <div class="crud-colonne">
        <p>ID</p>
        <p>Nom de l'animal</p>
        <p>Race</p>
        <p>Nourriture Proposée</p>
        <p>Grammage</p>
        <p>Heure</p>
        <p>Modifier</p>

    </div>
    <?php
    // récupère dans la base de données des animaux
    $recupAnimaux = $bdd->query('SELECT * FROM animaux');
    $recupNourriture = $bdd->query('SELECT * FROM nourriture_animal');
    // Boucle qui affiche les memebres de la BDD
    while($animaux = $recupAnimaux->fetch() AND $nourriture_animal = $recupNourriture->fetch()) {
        ?>

        <div class="crud-ligne">
            <p><?= $animaux['id']; ?></p>
            <p><?= $animaux['nom_animal']; ?></p>
            <p><?= $animaux['race_animal']; ?></p>
            <p><?= $nourriture_animal['nourriture']; ?></p>
            <p><?= $nourriture_animal['grammage_nourriture']; ?></p>
            <p><?= $nourriture_animal['heure_manger']; ?></p>
            <a href="modifier-animal-employe.php?id=<?= $nourriture_animal['id'];?>" style="text-decoration: none; color: green">Modifier</a>
        </div>

        <?php
    }
    ?>
</div>
<!--Fini d'afficher tous les animaux-->
</main>
</body>
</html>

