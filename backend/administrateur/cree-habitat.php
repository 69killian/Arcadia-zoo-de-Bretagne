<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Vérifie si l'ID provient de l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Récupère l'identifiant existant
    $getID = $_GET['id'];

    $recupHabitat = $bdd->prepare('SELECT * FROM habitat WHERE idHabitat = ?');
    $recupHabitat->execute(array($getID));
    if ($recupHabitat->rowCount() > 0) {
        // Données de l'habitat existant
        $habitatData = $recupHabitat->fetch();
        $nom_habitat = $habitatData['nom_habitat'];
        $image_habitat = $habitatData['img'];
    } else {
        echo 'Aucune donnée trouvée.';
    }
} else {
    // Crée un nouvel habitat
    $getID = null;
    $nom_habitat = '';
    $image_habitat = '';

    // Soumission pour création
    if (isset($_POST['submit'])) {
        // récupère les informations saisies
        $nom_habitat_saisi = $_POST['nom_habitat'];

        // Vérifie si un fichier a été téléchargé
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Récupère le chemin temporaire du fichier
            $image_tmp_path = $_FILES['image']['tmp_name'];

            // Lit le contenu du fichier
            $image_content = file_get_contents($image_tmp_path);

            // Requête préparée pour l'insertion avec l'image
            $createHabitat = $bdd->prepare('INSERT INTO habitat (nom_habitat, img) VALUES (?, ?)');
            $createHabitat->execute(array($nom_habitat_saisi, $image_content));

            header('Location: habitatadmin.php');
        } else {
            echo "Veuillez sélectionner une image à télécharger.";
        }
    }
}

// Vérifie si l'utilisateur est connecté
if (!$_SESSION['motdepasse']) {
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
    <title>Créer un habitat</title>
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
<!-- Formulaire pour créer un habitat -->
<div class="crud-container-texte">
    <div class="crud-colonne">
        <h1 style="text-align: ">Créer un Habitat</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" enctype="multipart/form-data" action="">
            <input type="text" name="nom_habitat" value="<?= $nom_habitat ?>" placeholder="Nom de l'Habitat">
            <input required="" type="file" name="image" accept="image/*">
            <input type="submit" name="submit" value="Créer cet Habitat">
        </form>
    </div>
</div>

<main>
</body>
</html>
