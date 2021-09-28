<?php
require_once("includes/page.inc.php");

session_start();

if ($_SESSION["Utilisateur"] == null) {
    header("location: /index.php?pasAutorise");
    exit();
}

$utilisateurConnecte = $_SESSION["Utilisateur"];

?>

<p>Bienvenue <?php echo $utilisateurConnecte->getPrenom() . " " . $utilisateurConnecte->getNom() ?></p>

<p><a href="logout.php">Déconnexion</a></p>