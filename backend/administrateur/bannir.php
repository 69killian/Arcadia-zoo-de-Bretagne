<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');

// Si l'identifiant est renseigné et qu'il existe
if (isset($_GET['id']) AND !empty($_GET['id'])){
    // on récupère l'identifiant de la base de données
    $getID = $_GET['id'];
    $recupUser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
    // on verifie s'ils sont les mêmes
    $recupUser->execute(array($getID));
    // Si l'ID n'est pas vide
    if($recupUser->rowCount() > 0) {
        // réalise la requête préparée de suppression de l'ID
        $bannirUser = $bdd->prepare('DELETE FROM membres WHERE id = ?');
        $bannirUser->execute(array($getID));
        // renvoie vers la page
        header('Location: membres.php');
    } else {
        echo "Aucun Membre n'a été trouvé.";
    }
} else {
    echo "L'identifiant n'a pas été récupéré.";
}
?>
