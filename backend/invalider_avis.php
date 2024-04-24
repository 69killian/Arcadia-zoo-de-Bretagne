<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

if(isset($_POST['invalider'])) {
    $id_avis = $_POST['id_avis'];

    // Suppression de l'avis de la base de données
    $query = $bdd->prepare('DELETE FROM avis_clients WHERE id = ?');
    $query->execute([$id_avis]);

    echo "L'avis a été invalidé et supprimé avec succès.";
    ?>
    <form action="espace-employe.php" method="post">
        <input type="submit" name="retour" value="Retour à l'espace employé">
    </form>
    <?php
} else {
    echo "Une erreur s'est produite lors de l'invalidation de l'avis.";
}
?>
