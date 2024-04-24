<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(isset($_GET["id"]) AND !empty($_GET["id"])){
    // stocke l'identifiant récupéré
    $getID = $_GET['id'];

    $recupCompte_rendu = $bdd->prepare('SELECT * FROM compte_rendu WHERE id = ?');
    $recupCompte_rendu->execute(array($getID));
    if($recupCompte_rendu->rowCount() > 0) {
        // récupère les valeurs en fonction de l'id choisi
        // je n'utilise fetch qu'une seule fois pour éviter les warnings
        $compte_rendu_Data = $recupCompte_rendu->fetch();
        $etat_sante = $compte_rendu_Data['etat_sante'];
        $date_passage = $compte_rendu_Data['date_passage'];
        $compte_rendu_veterinaire = $compte_rendu_Data['compte_rendu_veterinaire'];

        if (isset($_POST['submit'])) {
            // récupère les informations saisies
            $etat_sante_saisi = $_POST['etat_sante'];
            $date_passage_saisi = $_POST['date_passage'];
            $compte_rendu_veterinaire = $_POST['compte_rendu_veterinaire'];

            // Requête préparée
            $updateMembre = $bdd->prepare('UPDATE compte_rendu SET etat_sante = ?, date_passage = ?, compte_rendu_veterinaire = ? WHERE id = ?');
            $updateMembre->execute(array($etat_sante_saisi, $date_passage_saisi, $compte_rendu_veterinaire, $getID)); // Requête exécutée

            header('Location: ../espace-veterinaire.php');
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
    <title>Modifier un Compte rendu</title>
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
        <h1 style="text-align: ">Modifier un Compte Rendu</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="">
            <textarea cols="50px" rows="12px" name="etat_sante"><?= $etat_sante ?></textarea>
            <textarea cols="50px" rows="12px" name="date_passage"><?= $date_passage; ?></textarea>
            <textarea cols="50px" rows="12px" name="compte_rendu_veterinaire"><?= $compte_rendu_veterinaire; ?></textarea>
            <input type="submit" name="submit" value="Valider les modifications">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les comptes rendus-->

<main>
</body>
</html>