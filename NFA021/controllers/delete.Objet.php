<?php
require_once(__DIR__ . "/../includes/page.inc.php");

if (!isset($_GET["Objet"])&&(!isset($_GET["id"]))) header('location: ../routeurcentral.php');

$objet=$_GET["Objet"];
$objet=ucfirst(strtolower($objet));
$objet=GlobalConstants::getObjectName($objet);
$currentId = $_GET["id"];

if (!GlobalConstants::estObject($objet)) header('location: ../routeurcentral.php');

$currentRepo = $objet . 'Repo';
$currentGet = 'get' . $objets;
$currentObject = 'les'. $objets;

$leRepo = new $currentRepo;
if($leRepo->delete($currentId)) {
    header("location: ../views/message.php?titre=Succès&deleteOK");
} else {
    header("location: ../views/message.php?titre=Erreur&deleteNOK");
};




