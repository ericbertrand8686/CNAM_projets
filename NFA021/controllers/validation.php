<?php
require_once("../includes/page.inc.php");

if (isset($_GET["jeton"])) {
	$jeton = protectionDonneesFormulaire($_GET["jeton"]);

    $myRepo = new UtilisateurRepo;
    if ($myRepo->validateUtilisateurWithJeton($jeton)) {
        header("location: ../views/message.php?titre=Réussite&validationOK");
    } else {
        header("location: ../views/message.php?titre=Erreur&validationNOK");
    }
}

