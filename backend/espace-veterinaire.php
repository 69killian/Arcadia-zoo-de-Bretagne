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
    <link rel="stylesheet" href="../frontend/styles/espace-admin.css">
    <link rel="stylesheet" href="../frontend/styles/connexion.css">
    <link rel="stylesheet" href="../frontend/styles/contact.css">
    <link rel="stylesheet" href="../frontend/styles/accueil.css">
    <link rel="stylesheet" href="../frontend/styles/veterinaire/espace-veterinaire.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Comptes Rendus Vétérinaire</title>
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
    <div class="titre-nav">ESPACE <br>VÉTÉRINAIRE</div>
    <article class="lien"><a href="espace-veterinaire.php">Compte rendu Animalier</a></article>
    <article class="lien"><a href="veterinaire/avis-habitat.php">Avis sur Habitat</a></article>
    <article class="lien" ><a href="veterinaire/animaux-veterinaire.php">Saisie de l'Employé</a></article>
    <article class="lien"><a href="deconnexion.php">Déconnexion</a></article>
</nav>
<main style="margin-top: 3000px">
<h1 style="text-align: center; color: white;">Compte rendu Animalier</h1>
<!--Afficher tous les membres-->
<div class="crud-container">
    <div class="crud-colonne">
        <p>ID</p>
        <p>Nom de l'animal</p>
        <p>Race</p>
        <p>État de santé</p>
        <p>Date de passage</p>
        <p>Compte rendu vétérinaire</p>
        <p>Modifier</p>
    </div>
    <?php
    // récupère dans la base de données les membres
    $recupAnimaux = $bdd->query('SELECT * FROM animaux');
    $recupAvis = $bdd->query('SELECT * FROM compte_rendu');
    // Boucle qui affiche les memebres de la BDD
    while($animaux = $recupAnimaux->fetch() and $compte_rendu = $recupAvis->fetch()) {
        ?>

        <div class="crud-ligne">
            <p><?= $animaux['id']; ?></p>
            <p><?= $animaux['nom_animal']; ?></p>
            <p><?= $animaux['race_animal']; ?></p>
            <p><?= $compte_rendu['etat_sante']; ?></p>
            <p><?= $compte_rendu['date_passage']; ?></p>
            <p style="width: 490px"><?= $compte_rendu['compte_rendu_veterinaire']; ?></p>
            <a href="veterinaire/modifier-avis-animal.php?id=<?= $compte_rendu['id'];?>" style="text-decoration: none; color: green">Modifier</a>
        </div>

        <?php
    }
    ?>
</div>
</main>
</body>
</html>