<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');

$allanimals = $bdd->query('SELECT * FROM compte_rendu ORDER BY id DESC');
if (isset($_GET['s']) && !empty($_GET['s'])) {
    $recherche = htmlspecialchars($_GET['s']);
    $allanimals = $bdd->query("SELECT * FROM compte_rendu WHERE 
                            nom_animal LIKE '%$recherche%' OR 
                            etat_sante LIKE '%$recherche%' OR 
                            date_passage LIKE '%$recherche%' OR 
                            compte_rendu_veterinaire LIKE '%$recherche%' 
                            ORDER BY id DESC");
}



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
    <link rel="stylesheet" href="../../frontend/styles/administrateur/avis-vetrinaire.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Avis du vétérinaire</title>
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
<main>
<h1 style="text-align: center; color: white;">Avis du vétérinaire</h1>

<form style="margin-bottom: 30px" method="GET">
    <input style="font-size: 20px; padding: 5px; border-radius: 5px" type="search" name="s" placeholder="Rechercher un Animal" autocomplete="off">
    <input style="font-size: 20px; padding: 5px; border-radius: 5px" type="submit" name="envoyer">
</form>

<!--Afficher tous les membres-->
<div class="crud-container">
    <div class="crud-colonne">
        <p>ID</p>
        <p>Nom de l'animal</p>
        <p>État de santé</p>
        <p>Date de passage</p>
        <p style="margin-left: 290px">Avis du vétérinaire</p>
    </div>
    <?php
    // Boucle qui affiche les memebres de la BDD
    if($allanimals->rowCount() > 0) {
    while($compte_rendu = $allanimals->fetch()) {
        ?>

        <div class="crud-ligne">
            <p><?= $compte_rendu['id']; ?></p>
            <p><?= $compte_rendu['nom_animal']; ?></p>
            <p><?= $compte_rendu['etat_sante']; ?></p>
            <p><?= $compte_rendu['date_passage']; ?></p>
            <p style="width: 490px;"><?= $compte_rendu['compte_rendu_veterinaire']; ?></p>
        </div>

        <?php
    }
    } else {
    ?>
        <p>Aucun utilisateur trouvé</p>
        <?php
    }
    ?>
</div>
</main>
</body>
</html>

