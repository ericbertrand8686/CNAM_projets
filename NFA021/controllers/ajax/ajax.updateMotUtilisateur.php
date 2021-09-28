<?php
require_once("../../includes/page.inc.php");
session_start(); // Trouvé le 16/06/2021 à 19:45 que je dois l'inclure pour que ça marche

$res = 0;

if (isset($_GET["motId"]) && isset($_GET["Correct"]) && isset($_SESSION["Utilisateur"])) {

    $currentUser = unserialize($_SESSION["Utilisateur"]);
    $userid = $currentUser->getId();
    $motid = $_GET["motId"];
    $correct = $_GET["Correct"];

    $myRepo = new MotUtilisateurRepo();

    if ($correct="O") {
        $myRepo->correctMotUtilisateur($userid,$motid);
        $res = 1;
    }
    
    if ($correct="N") {
        $myRepo->erreurMotUtilisateur($userid,$motid);
        $res = 1;
    }
    //return $res;
    return $res;
}