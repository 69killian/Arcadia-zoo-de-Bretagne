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
    <link rel="stylesheet" href="../../frontend/styles/connexion.css">
    <link rel="stylesheet" href="../../frontend/styles/contact.css">
    <link rel="stylesheet" href="../../frontend/styles/accueil.css">
    <link rel="stylesheet" href="../../frontend/styles/administrateur/membres.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Afficher tous les Membres</title>
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
    <h1 style="text-align: center; color: white;">Gérer les Membres</h1>
    <!--Afficher tous les membres-->
<div class="crud-container">
    <div class="crud-colonne">
        <p>ID</p>
        <p>Pseudo</p>
        <p>Email</p>
        <p>Mot de Passe</p>
        <p>Compte</p>
        <p>Modifier</p>
        <p>Bannir</p>
    </div>
    <?php
        // récupère dans la base de données les membres
        $recupUsers = $bdd->query('SELECT * FROM membres');
        // Boucle qui affiche les memebres de la BDD
        while($user = $recupUsers->fetch()) {
            ?>

                <div class="crud-ligne">
                    <p><?= $user['id']; ?></p>
                    <p><?= $user['pseudo']; ?></p>
                    <p><?= $user['email']; ?></p>
                    <p><?= $user['mot_de_passe']; ?></p>
                    <p><?= $user['type_compte']; ?></p>
                    <a href="modifier-utilisateur.php?id=<?= $user['id'];?>" style="text-decoration: none; color: green">Modifier</a>
                    <a href="bannir.php?id=<?= $user['id'];?>" style="text-decoration: none; color: red">Bannir</a>
                </div>

            <?php
        }
    ?>
</div>
    <!--Fini d'afficher tous les membres-->
<button class="boutton-créer"><a href="cree-utilisateur.php">Créer un Membre</a></button>
<main>
</body>
</html>

