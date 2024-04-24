<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(isset($_GET["id"]) AND !empty($_GET["id"])){
    // stocke l'identifiant récupéré
    $getID = $_GET['id'];

    $recupNourriture = $bdd->prepare('SELECT * FROM nourriture_animal WHERE id = ?');
    $recupNourriture->execute(array($getID));
    if($recupNourriture->rowCount() > 0) {
        // récupère les valeurs en fonction de l'id choisi
        // je n'utilise fetch qu'une seule fois pour éviter les warnings
        $nourritureData = $recupNourriture->fetch();
        $nourriture = $nourritureData['nourriture'];
        $grammage_nourriture = $nourritureData['grammage_nourriture'];
        $heure_manger = $nourritureData['heure_manger'];

        if (isset($_POST['submit'])) {
            // récupère les informations saisies
            $nourriture_saisi = $_POST['nourriture'];
            $grammage_saisi = $_POST['grammage_nourriture'];
            $heure_saisi = $_POST['heure_manger'];

            // Requête préparée
            $updateMembre = $bdd->prepare('UPDATE nourriture_animal SET nourriture = ?, grammage_nourriture = ?, heure_manger = ? WHERE id = ?');
            $updateMembre->execute(array($nourriture_saisi, $grammage_saisi, $heure_saisi, $getID)); // Requête exécutée

            header('Location: animaux-employe.php');
        }

    } else {
        echo 'Aucune données trouvées.';
    }
} else {
    echo "Aucun identifiant n'a été trouvé.";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    <title>Modifier un Animal</title>
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
    <article class="lien"><a href="../espace-veterinaire.php">Compte rendu Animalier</a></article>
    <article class="lien"><a href="avis-habitat.php">Avis sur Habitat</a></article>
    <article class="lien" ><a href="../veterinaire/animaux-veterinaire.php">Saisie de l'Employé</a></article>
    <article class="lien"><a href="../deconnexion.php">Déconnexion</a></article>
</nav>
<!--Afficher tous les membres-->
<div class="crud-container-texte">
    <div class="crud-colonne">
        <h1 style="text-align: ">Modifier une Saisie</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="">
            <textarea cols="50px" rows="12px" name="nourriture"><?= $nourriture ?></textarea>
            <textarea cols="50px" rows="12px" name="grammage_nourriture"><?= $grammage_nourriture; ?></textarea>
            <textarea cols="50px" rows="12px" name="heure_manger"><?= $heure_manger; ?></textarea>
            <input type="submit" name="submit" value="Valider les modifications">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>