<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');
if(isset($_GET["id"]) AND !empty($_GET["id"])){
    // stocke l'identifiant récupéré
    $getID = $_GET['id'];

    $recupService = $bdd->prepare('SELECT * FROM services WHERE id = ?');
    $recupService->execute(array($getID));
    if($recupService->rowCount() > 0) {
        // récupère les valeurs en fonction de l'id choisi
        // je n'utilise fetch qu'une seule fois pour éviter les warnings
        $serviceData = $recupService->fetch();
        $nom_service = $serviceData['nom_service'];
        $description_service = $serviceData['description_service'];
        $horaire_service = $serviceData['horaires'];

        if (isset($_POST['submit'])) {
            // Vérifie si une image a été téléchargée
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Récupérez le contenu de l'image
                $imgData = file_get_contents($_FILES['image']['tmp_name']);

                // Requête préparée pour mettre à jour la base de données avec l'image
                $updateMembre = $bdd->prepare('UPDATE services SET img = ? WHERE id = ?');
                $updateMembre->execute(array($imgData, $getID));
            }

            // Récupérez les autres informations saisies
            $service_saisi = $_POST['nom_service'];
            $description_saisi = $_POST['description_service'];
            $horaire_saisi = $_POST['horaires'];

            // Requête préparée pour mettre à jour les autres informations
            $updateMembre = $bdd->prepare('UPDATE services SET nom_service = ?, description_service = ?, horaires = ? WHERE id = ?');
            $updateMembre->execute(array($service_saisi, $description_saisi, $horaire_saisi, $getID));

            header('Location: servicesadmin.php');
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
    <link rel="stylesheet" href="../../frontend/styles/administrateur/serviceadmin.css">
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
        <h1 style="text-align: ">Modifier un Service</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="" enctype="multipart/form-data">
            <textarea cols="50px" rows="12px" name="nom_service"><?= $nom_service ?></textarea>
            <textarea cols="50px" rows="12px" name="description_service"><?= $description_service; ?></textarea>
            <textarea cols="50px" rows="12px" name="horaires"><?= $horaire_service; ?></textarea>
            <input type="submit" name="submit" value="Valider les modifications">
            <label>Choisissez une image (recquis) : </label>
            <input required="" type="file" name="image" accept="image/*">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>