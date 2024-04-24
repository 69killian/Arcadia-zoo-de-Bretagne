<?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_admin;', 'root', '');

// Traitement du formulaire
if(isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $note = $_POST['note'];
    $avis = $_POST['avis'];

    // Insertion dans la base de données avec valide = 0 (non validé)
    $query = $bdd->prepare('INSERT INTO avis_clients (pseudo, note, avis) VALUES (?, ?, ?)');
    $query->execute([$pseudo, $note, $avis]);

    echo "Votre avis a été soumis et est en attente de validation.";
    ?>
    <form method="post" action="../frontend/index.php">
    <input type='submit' name='retour' value="retour à la page d'acceuil">
    </form>
    <?php
}
?>
