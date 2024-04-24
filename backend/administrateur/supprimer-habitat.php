<?php
session_start();
// Connexion à la base de données, en renseignant le lien de la bdd, username et password
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Si l'identifiant est renseigné et qu'il existe
if (isset($_GET['id']) && !empty($_GET['id'])){
    // on récupère l'identifiant de la base de données
    $getID = $_GET['id'];
    $recupHabitat = $bdd->prepare('SELECT * FROM habitat WHERE idHabitat = ?');
    // on vérifie s'ils sont les mêmes
    $recupHabitat->execute(array($getID));
    // Si l'ID n'est pas vide
    if($recupHabitat->rowCount() > 0) {
        // réalise la requête préparée de suppression de l'ID
        $deleteHabitat = $bdd->prepare('DELETE FROM habitat WHERE idHabitat = ?');
        $deleteHabitat->execute(array($getID));
        // renvoie vers la page
        header('Location: habitatadmin.php');
    } else {
        echo "Aucun habitat n'a été trouvé.";
    }
} else {
    echo "L'identifiant n'a pas été récupéré.";
}
?>
