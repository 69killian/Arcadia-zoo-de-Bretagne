<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

session_start();
// Si la session ne démarre pas, alors on retourne sur la page de connexion
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
    <div class="titre-nav">ESPACE <br>EMPLOYÉ</div>
    <article class="lien"><a href="espace-employe.php">Validation des avis</a></article>
    <article class="lien"><a href="employe/services-employe.php">Modifier les Services</a></article>
    <article class="lien" ><a href="employe/animaux-employe.php">Nourriture Animal</a></article>
    <article class="lien"><a href="deconnexion.php">Déconnexion</a></article>
</nav>

<h1 style="text-align: center; color: white;">Gérer les Avis</h1>
<?php

// Récupération des avis en attente de validation
$query = $bdd->query('SELECT * FROM avis_clients WHERE valide = 0');

// Affichage des avis et des options pour les valider ou les rejeter
while ($avis = $query->fetch()) {
    ?>
<div class="crud-container">
    <div class="crud-ligne">
    <p><strong><?= $avis['pseudo'] ?></strong> : <br> Note : <?= $avis['note'] ?> <br> Commentaire : <?= $avis['avis'] ?></p>
    <form action='valider_avis.php' method='POST'>
        <input type='hidden' name='id_avis' value='<?= $avis['id'] ?>'>
        <label for='valider'>Valider :</label>
        <input type='checkbox' name='valider'>
        <input type='submit' value='Valider'>
    </form>
        <form action='invalider_avis.php' method='POST'>
            <input type='hidden' name='id_avis' value='<?= $avis['id'] ?>'>
            <input type='submit' name='invalider' value='Invalider'>
        </form>

    </div>
    </div>
    <?php
}


?>
<main>
</body>
</html>
