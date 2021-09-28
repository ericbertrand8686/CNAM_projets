<?php
require_once(__DIR__ . "/../includes/page.inc.php");

if (!isset($_GET["Objets"])) header('location: ../routeurcentral.php');

$objets=$_GET["Objets"];
$objets=ucfirst(strtolower($objets));
$objet=substr($objets,0,-1);
$objet=GlobalConstants::getObjectName($objet);
$objets=$objet . 's';

if (!GlobalConstants::estObject($objet)) header('location: ../routeurcentral.php');

$currentRepo = $objet . 'Repo';
$currentGet = 'get' . $objets;
$currentObject = 'les'. $objets;

$leRepo = new $currentRepo;
$$currentObject = $leRepo->$currentGet();

include '../views/admin.Objets.php';


