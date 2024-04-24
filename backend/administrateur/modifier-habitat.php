<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

if(isset($_SESSION['motdepasse'])) {
    if(isset($_GET["id"]) AND !empty($_GET["id"])){
        // stocke l'identifiant récupéré
        $getID = $_GET['id'];

        $recupHabitat = $bdd->prepare('SELECT * FROM habitat WHERE idHabitat = ?');
        $recupHabitat->execute(array($getID));
        if($recupHabitat->rowCount() > 0) {
            // récupère les valeurs en fonction de l'id choisi
            $habitatData = $recupHabitat->fetch();
            $nom_habitat = $habitatData['nom_habitat'];

            if (isset($_POST['submit'])) {
                // récupère les informations saisies
                $nom_habitat_saisi = $_POST['nom_habitat'];

                // Vérifier si un fichier a été téléchargé
                if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    // Récupérer le chemin temporaire du fichier
                    $image_tmp_path = $_FILES['image']['tmp_name'];

                    // Lire le contenu du fichier
                    $image_content = file_get_contents($image_tmp_path);

                    // Requête préparée pour la mise à jour avec l'image
                    $updateHabitat = $bdd->prepare('UPDATE habitat SET nom_habitat = ?, img = ? WHERE idHabitat = ?');
                    $updateHabitat->execute(array($nom_habitat_saisi, $image_content, $getID));

                    header('Location: habitatadmin.php');
                } else {
                    // Requête préparée pour la mise à jour sans l'image
                    $updateHabitat = $bdd->prepare('UPDATE habitat SET nom_habitat = ? WHERE idHabitat = ?');
                    $updateHabitat->execute(array($nom_habitat_saisi, $getID));

                    header('Location: habitatadmin.php');
                }
            }
        } else {
            echo 'Aucune donnée trouvée pour cet identifiant.';
        }
    } else {
        echo "Aucun identifiant n'a été trouvé.";
    }
} else {
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

<div class="crud-container-texte">
    <div class="crud-colonne">
        <h1 style="text-align: ">Modifier un Habitat</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="" enctype="multipart/form-data">
            <textarea cols="50px" rows="12px" name="nom_habitat"><?= $nom_habitat ?></textarea>
            <br>
            <label>Choisissez une Image (non-recquis) :</label>
            <input type="file" name="image">
            <input type="submit" name="submit" value="Valider les modifications">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les habitats-->

</body>