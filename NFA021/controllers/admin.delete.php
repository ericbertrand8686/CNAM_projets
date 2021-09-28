<?php
require_once(__DIR__ . "/../includes/page.inc.php");

if (!isset($_GET["Objet"])&&(!isset($_GET["idSuppression"]))) header('location: ../routeurcentral.php');

$objet=$_GET["Objet"];
$objet=ucfirst(strtolower($objet));
$objet=GlobalConstants::getObjectName($objet);
$currentId = $_GET["idSuppression"];

if (!GlobalConstants::estObject($objet)) header("location: ../views/message.php?titre=Erreur&deleteNOK");

$currentRepo = $objet . 'Repo';
$currentGet = 'get' . $objet;
$currentObject = 'un'. $objet;

$leRepo = new $currentRepo;

$$currentObject = $leRepo->$currentGet($currentId);

if($leRepo->delete($$currentObject)) {
    header("location: ../views/message.php?titre=Succès&deleteOK");
} else {
    error_log("Problème de suppression avec " . $objet . " " . $currentId);
    header("location: ../views/message.php?titre=Erreur&deleteNOK");
};






