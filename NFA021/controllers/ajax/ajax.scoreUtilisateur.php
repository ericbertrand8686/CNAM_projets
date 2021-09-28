<?php
require_once("../../includes/page.inc.php");
session_start();

$res = 0;

if (isset($_GET["listeId"]) && isset($_GET["score"]) && isset($_SESSION["Utilisateur"])) {

    $currentUser = unserialize($_SESSION["Utilisateur"]);
    $userid = $currentUser->getId();
    $listeid = $_GET["listeId"];
    $score = $_GET["score"];

    $myRepo = new ScoreRepo();
    $myRepo->insert($userid, $listeid, $score);
    $res = 1;
}

return $res;