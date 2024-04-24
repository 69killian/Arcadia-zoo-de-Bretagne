<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Vérifie si l'ID provient de l'URL
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Prend un identifiant existant
    $getID = $_GET['id'];

    $recupUser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    $recupUser->execute(array($getID));
    if ($recupUser->rowCount() > 0) {
        // Existing member data
        $userData = $recupUser->fetch();
        $pseudo = $userData['pseudo'];
        $email = $userData['email'];
        $mdp = $userData['mot_de_passe'];
        $type_compte = $userData['type_compte'];
    } else {
        echo 'Aucune donnée trouvée.';
    }
} else {
    // Crée un nouvel animal
    $getID = null;
    $pseudo = '';
    $email = '';
    $mdp = '';
    $type_compte = '';

// Soumission pour création
if (isset($_POST['submit'])) {
    // Je récupère les informations saisies
    $pseudo_saisi = $_POST['pseudo'];
    $email_saisi = $_POST['email'];
    $mdp_saisi = $_POST['mot_de_passe'];
    $type_compte_saisi = $_POST['type_compte'];

    // Je Vérifie si le type de compte est un "Administrateur"
    if ($type_compte_saisi == "Administrateur") {
        // Je Vérifie s'il existe déjà un compte Administrateur
        $checkAdmin = $bdd->prepare('SELECT * FROM membres WHERE type_compte = ?');
        $checkAdmin->execute(array("Administrateur"));
        if ($checkAdmin->rowCount() > 0) {
            // S'il existe déjà un compte Administrateur = erreur
            echo "Il ne peut y avoir qu'un seul compte administrateur";
        } else {
            // Sinon, crée le nouveau membre
            $createMembre = $bdd->prepare('INSERT INTO membres (pseudo, email, mot_de_passe, type_compte) VALUES (?, ?, ?, ?)');
            $createMembre->execute(array($pseudo_saisi, $email_saisi, $mdp_saisi, $type_compte_saisi));
            header('Location: membres.php');
        }
    } else {
        // Si le type de compte n'est pas "Administrateur" = création du nouveau membre
        $createMembre = $bdd->prepare('INSERT INTO membres (pseudo, email, mot_de_passe, type_compte) VALUES (?, ?, ?, ?)');
        $createMembre->execute(array($pseudo_saisi, $email_saisi, $mdp_saisi, $type_compte_saisi));
        header('Location: membres.php');
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
        <h1 style="text-align: ">Créer un Membre</h1>
    </div>
    <div class="crud-ligne">
        <form class="modifier-container" method="POST" action="">
            <input type="text" name="pseudo" value="<?= $pseudo ?>" placeholder="Pseudo">
            <input type="email" name="email" value="<?= $email; ?>" placeholder="Email">
            <input type="text" name="mot_de_passe" value="<?= $mdp; ?>" placeholder="Mot de Passe">
            <input type="text" name="type_compte" value="<?= $type_compte; ?>" placeholder="Type de Compte">
            <input type="submit" name="submit" value="Créer cet Utilisateur">
        </form>
    </div>

</div>
<!--Fini d'afficher tous les membres-->

<main>
</body>
</html>