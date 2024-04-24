<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
    if(isset($_GET["id"]) AND !empty($_GET["id"])){
        // stocke l'identifiant récupéré
        $getID = $_GET['id'];

        $recupUser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
        $recupUser->execute(array($getID));
        if($recupUser->rowCount() > 0) {
            // récupère les valeurs en fonction de l'id choisi
            // je n'utilise fetch qu'une seule fois pour éviter les warnings
            $userData = $recupUser->fetch();
            $pseudo = $userData['pseudo'];
            $email = $userData['email'];
            $mdp = $userData['mot_de_passe'];
            $type_compte = $userData['type_compte'];

            if (isset($_POST['submit'])) {
                // récupère les informations saisies
                $pseudo_saisi = $_POST['pseudo'];
                $email_saisi = $_POST['email'];
                $mdp_saisi = $_POST['mot_de_passe'];
                $type_compte_saisi = $_POST['type_compte'];

                // Requête préparée
                $updateMembre = $bdd->prepare('UPDATE membres SET pseudo = ?, email = ?, mot_de_passe = ?, type_compte = ? WHERE id = ?');
                $updateMembre->execute(array($pseudo_saisi, $email_saisi, $mdp_saisi, $type_compte_saisi, $getID)); // Requête exécutée

                header('Location: membres.php');
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
        <h1 style="text-align: ">Modifier un Membre</h1>
    </div>
        <div class="crud-ligne">
            <form class="modifier-container" method="POST" action="">
                <input type="text" name="pseudo" value="<?= $pseudo ?>">
                <input type="email" name="email" value="<?= $email; ?>">
                <input type="text" name="mot_de_passe" value="<?= $mdp; ?>">
                <input type="text" name="type_compte" value="<?= $type_compte; ?>">
                <input type="submit" name="submit" value="Valider les modifications">
            </form>
        </div>

</div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>