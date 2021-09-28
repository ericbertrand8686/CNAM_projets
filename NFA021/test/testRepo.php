<?php
require_once(__DIR__ . "/../includes/page.inc.php");

session_start();
$currentUser = unserialize($_SESSION["Utilisateur"]);

$userid = $currentUser->getId();

$myRepo = new MotUtilisateurRepo();
$myRepo->erreurMotUtilisateur($userid,64);

echo $userid;

/* 
$myRepo = new ScoreRepo();

echo "Score : " . var_dump( $myRepo->getScoresUtilisateur(1,3) ); */

/* echo "Insert : " . $myRepo->insert(5,12,70);
echo "Insert : " . $myRepo->insert(5,13,70);
echo "Insert : " . $myRepo->insert(5,14,70);
echo "Insert : " . $myRepo->insert(5,15,70);
echo "Insert : " . $myRepo->insert(5,16,70); */

/* echo "Insert : " . $myRepo->insert(1,11,70);
echo "Insert : " . $myRepo->insert(1,8,70);
echo "Insert : " . $myRepo->insert(1,9,70);
echo "Insert : " . $myRepo->insert(1,10,70); */

/* echo "Insert : " . $myRepo->insert(1,7,75);
echo "Existe : " . $myRepo->getScoresUtilisateur(1,3); */