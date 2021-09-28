<?php

session_start();

require('./includes/page.inc.php');

require('models/UtilisateurRepo.php');

if ($_SESSION["Utilisateur"] == null) {
	header("location: /views/login.php");
}

$currentUser = unserialize($_SESSION["Utilisateur"]);

if ($currentUser->getEstSuperAdmin()) {
	header("location: views/admin.php");
} else {
	header("location: ../controllers/utilisateur.Objets.php?Objets=Groupes");
}

?>