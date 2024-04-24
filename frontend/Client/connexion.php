<?php
// démarre une session de connexion
session_start();
// connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse']) && !empty($_POST['typecompte'])) {
        // Empêche l'utilisateur d'entrer du code HTML brut
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mot_de_passe = htmlspecialchars($_POST['motdepasse']);
        $type_compte = $_POST['typecompte'];

        // récupérer les données des utilisateurs
        $recupUser = $bdd->prepare('SELECT * FROM membres WHERE pseudo = ? AND mot_de_passe = ? AND type_compte = ?');
        $recupUser->execute(array($pseudo, $mot_de_passe, $type_compte));

        // Vérifier si des résultats ont été retournés
        if ($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();

            $_SESSION['motdepasse'] = $user['mot_de_passe'];

            // Rediriger en fonction du type de compte
            switch ($type_compte) {
                case 'Administrateur':
                    header('Location: ../../backend/espace-admin.php');
                    exit();
                    break;
                case 'Vétérinaire':
                    header('Location: ../../backend/espace-veterinaire.php');
                    exit();
                    break;
                case 'Employé':
                    header('Location: ../../backend/espace-employe.php');
                    exit();
                    break;
                default:
                    echo "<script>alert('Type de compte non reconnu.');</script>";
            }
        } else {
            echo "<script>alert('Votre mot de passe ou pseudo est incorrect.');</script>";
        }
    } else {
        // si les champs sont vides
        echo "<script>alert('Veuillez compléter tous les champs.');</script>";
    }
}
?>
<!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Connexion - Arcadia</title>
        <link rel="stylesheet" href="../styles/connexion.css">
        <link rel="stylesheet" href="../styles/contact.css">
        <link rel="stylesheet" href="../styles/accueil.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;400;600&display=swap" rel="stylesheet">
    </head>
    <body>
    <header class="header-formulaire">
        <section class="logo-header-container">
            <div class="logo-header-style-1">A<span class="white-color">RC</span>A<span class="white-color">DI</span>A</div>
            <div class="logo-header-style-2">ZOO DE BRETAGNE</div>
        </section>
        <section class="menu-button-container">
            <button><a class="liens-sans-couleur" href="../index.php">Accueil</a></button>
            <button><a class="liens-sans-couleur" href="services.php">Tous nos services</a></button>
            <button><a class="liens-sans-couleur" href="habitats.php">Tous nos habitats</a></button>
            <button><a class="liens-sans-couleur" href="connexion.php">Connexion</a></button>
            <button><a class="liens-sans-couleur" href="contact.php">Contact</a></button>
        </section>
    </header>
    <main role="main" class="contenu-principal">
        <form action="" method="POST">
            <fieldset class="container-formulaire">
                <!--Partie qui gère le type de compte -->
                <div>
                    <label for="compte">Type de compte :</label>
                    <select class="style-selecteur" required="" name="typecompte">
                        <option></option>
                        <option>Administrateur</option>
                        <option>Vétérinaire</option>
                        <option>Employé</option>
                    </select>
                </div> <br/>

                <!--Partie qui gère les emails et mot de passe-->
                <div>
                    <label for="email">Pseudo :</label>
                    <input class="style-input" min="16" max="35" required="" type="text" name="pseudo">
                </div> <br/>
                <div>
                    <label for="motdepasse">Mot de Passe :</label>
                    <input class="style-input" min="16" max="35" required="" type="password" name="motdepasse">
                </div> <br/>
                <a style="color: rgb(35, 105, 35);" href="contact.php">Mot de passe oublié ?</a>

                <!-- Boutton de connexion-->
                <input class="bouton-formulaire" type="submit" name="submit" value="SE CONNECTER">

            </fieldset>
        </form>
    </main>

    <!-- Site footer -->
    <footer class="pied-de-page-connexion">
        <div class="contact-info">
            <p>Contactez-nous :</p>
            <p>Email : arcadia.contact29@gmail.com</p>
            <p>Téléphone : +33 1 23 45 67 89</p>
            <p>Adresse : All. de Kerrousseau, 56620 Pont-Scorff</p>
        </div>
        <div class="container-image-pied-page">
            <img src="../images/x.png">
            <img src="../images/youtube.png">
            <img src="../images/linkedin.png">
            <img src="../images/google.png">
            <img src="../images/facebook.png">
        </div>
        <div class="copywright">
            <p>© 2024 Mon Site Web. Tous droits réservés.</p>
        </div>
    </footer>
    </body>
    </html>

