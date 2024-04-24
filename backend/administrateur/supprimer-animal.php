<?php
session_start();
// Connexion à la base de données MySQL
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Connexion à MongoDB
require 'C:/xampp/vendor/autoload.php';
use MongoDB\Client;

try {
    $mongoClient = new MongoDB\Client("mongodb+srv://killiancodes:Tactac2003*@cluster0.ho8h1io.mongodb.net/");
    $database = $mongoClient->animaux;
    $collection = $database->animal;
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Erreur de connexion à MongoDB : " . $e->getMessage();
}

// Si l'identifiant est renseigné et qu'il existe
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // on récupère l'identifiant de la base de données
    $getID = $_GET['id'];
    $recupAnimal = $bdd->prepare('SELECT * FROM animaux WHERE id = ?');
    // on verifie s'ils sont les mêmes
    $recupAnimal->execute(array($getID));
    // Si l'ID n'est pas vide
    if($recupAnimal->rowCount() > 0) {
        // Récupérer les données de l'animal
        $animalData = $recupAnimal->fetch();
        $nom_animal = $animalData['nom_animal'];
        $idMongoDB = $animalData['id_mongodb']; // L'identifiant MongoDB stocké dans MySQL

        // réalise la requête préparée de suppression de l'ID dans MySQL
        $bannirAnimal = $bdd->prepare('DELETE FROM animaux WHERE id = ?');
        $bannirAnimal->execute(array($getID));

        // Supprimer l'animal correspondant dans MongoDB en utilisant son ID
        $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($idMongoDB)]);

        // renvoie vers la page
        header('Location: animauxadmin.php');
    } else {
        echo "Aucun animal n'a été trouvé.";
    }
} else {
    echo "L'identifiant n'a pas été récupéré.";
}
?>
