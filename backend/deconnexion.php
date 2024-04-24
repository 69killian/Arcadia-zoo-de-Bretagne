<?php
// Déconnecte la session
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: ../frontend/Client/connexion.php');
?>