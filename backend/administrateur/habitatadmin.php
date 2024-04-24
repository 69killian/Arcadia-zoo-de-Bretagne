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
    <link rel="stylesheet" href="../../frontend/styles/administrateur/habitatadmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Services</title>
    <meta charset="utf-8">
</head>
<body>

<header>
    <section class="logo-header-container">
        <div class="logo-header-style-1">A<span class="white-color">RC</span>A<span class="white-color">DI</span>A</div>
        <div class="logo-header-style-2">ZOO DE BRETAGNE</div>
    </section>
</header>

<nav class="navigation" ">
<div  class="titre-nav">ESPACE ADMINISTRATEUR</div>
<article class="lien"><a href="../espace-admin.php">Accueil</a></article>
<article class="lien"><a href="../administrateur/membres.php">Afficher tous les membres</a></article>
<article class="lien" ><a href="../administrateur/servicesadmin.php">Gérer les Services</a></article>
<article class="lien" ><a href="../administrateur/animauxadmin.php">Gérer les Animaux</a></article>
<article class="lien" ><a href="../administrateur/habitatadmin.php">Gérer les Habitats</a></article>
<article class="lien" ><a href="../administrateur/avis-veterinaire.php">Avis vétérinaire</a></article>
<article class="lien"><a href="../deconnexion.php">Déconnexion</a></article>
</nav>
<main style="margin-top: 150px">
<h1 style="text-align: center; color: white;">Gérer les Habitats</h1>
<!--Afficher tous les membres-->
<div style="margin-bottom: 100px;" class="crud-container">
    <div class="crud-colonne">
        <p>ID</p>
        <p>Nom de l'Habitat</p>
        <p>Avis du vétérinaire</p>
        <p>Date de l'avis</p>
        <p>Modifier</p>
        <p>Supprimer</p>

    </div>
    <?php
    // récupère dans la base de données les membres
    $recupAvis = $bdd->query('SELECT * FROM habitat');
    // Boucle qui affiche les memebres de la BDD
    while($avis_Habitat = $recupAvis->fetch()) {
        ?>

        <div class="crud-ligne">
            <p><?= $avis_Habitat['idHabitat']; ?></p>
            <p><?= $avis_Habitat['nom_habitat']; ?></p>
            <p style="width: 450px"><?= $avis_Habitat['avis_veterinaire']; ?></p>
            <p><?= $avis_Habitat['date_avis']; ?></p>
            <img src="data:image/jpeg;base64,<?= base64_encode($avis_Habitat['img']); ?>" alt="Image de l'habitat <?= $avis_Habitat['nom_habitat']; ?>" style="max-width: 100px; max-height: 100px;">
            <a href="modifier-habitat.php?id=<?= $avis_Habitat['idHabitat'];?>" style="text-decoration: none; color: green">Modifier</a>
            <a href="supprimer-habitat.php?id=<?= $avis_Habitat['idHabitat'];?>" style="text-decoration: none; color: red">Supprimer</a>
        </div>

        <?php
    }
    ?>

</div>
<button  class="boutton-créer"><a href="cree-habitat.php">Créer un Habitat</a></button>
<!--Fini d'afficher tous les membres-->

</main>
</body>
</html>

