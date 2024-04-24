<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;','root','');

// Si l'identifiant est renseigné et qu'il existe
if (isset($_GET['id']) AND !empty($_GET['id'])){
    // on récupère l'identifiant de la base de données
    $getID = $_GET['id'];
    $recupService = $bdd->prepare('SELECT * FROM services WHERE id = ?');
    // on verifie s'ils sont les mêmes
    $recupService->execute(array($getID));
    // Si l'ID n'est pas vide
    if($recupService->rowCount() > 0) {
        // réalise la requête préparée de suppression de l'ID
        $bannirService = $bdd->prepare('DELETE FROM services WHERE id = ?');
        $bannirService->execute(array($getID));
        // renvoie vers la page
        header('Location: servicesadmin.php');
    } else {
        echo "Aucun Services n'a été trouvé.";
    }
} else {
    echo "L'identifiant n'a pas été récupéré.";
}
?>