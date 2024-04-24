<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

if(isset($_POST['valider'])) {
    $id_avis = $_POST['id_avis'];

    // Mise à jour de la colonne valide dans la base de données
    $query = $bdd->prepare('UPDATE avis_clients SET valide = 1 WHERE id = ?');
    $query->execute([$id_avis]);

    echo "L'avis a été validé avec succès.";
?>
    <form action="espace-employe.php" method="post">
        <input type="submit" name="retour" value="retour espace employé">
    </form>
    <?php
} else {
    echo "L'avis a été rejeté.";
}
?>
