<?php
require_once(__DIR__ . "/../includes/page.inc.php");

session_start();

@$mail = $_POST["mail"];
@$password = $_POST["password"];
@$envoyer = $_POST["btnEnvoyer"];

$userRepo = new UtilisateurRepo();

if (isset($envoyer)) {
    if (!isset($mail) || !isset($password)) {
        header("location: ../views/message.php?titre=Erreur&erreurAuthentification1");
    }

    $utilisateur = $userRepo->authentification($mail, $password);
    if ($utilisateur != null) {
        $_SESSION["Utilisateur"] = serialize($utilisateur);
        header("location: ../routeurcentral.php");
    } else
        header("location: ../views/message.php?titre=Erreur&erreurAuthentification3");
} else
    header("location: ../views/message.php?titre=Erreur&erreurAuthentification3");
