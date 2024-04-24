<?php
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

// Vérifie si le formulaire a été soumis et récupère le nom de l'animal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nom_animal'])) {
    $nom_animal = $_POST['nom_animal'];

    // Mise à jour des visites dans MongoDB
    $updateResult = $collection->updateOne(
        ['nom_animal' => $nom_animal],
        ['$inc' => ['nombre_visites' => 1]]
    );

    // Répond avec un message indiquant le succès ou l'échec de la mise à jour
    if ($updateResult->getModifiedCount() > 0) {
        echo "Nombre de visites mis à jour avec succès pour $nom_animal.";
    } else {
        echo "Erreur lors de la mise à jour du nombre de visites pour $nom_animal.";
    }
}
?>
