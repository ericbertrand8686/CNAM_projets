<?php
require_once(__DIR__ . "/../includes/page.inc.php");
session_start();

if (!isset($_GET["Objets"])) header('location: ../routeurcentral.php');

$objets=$_GET["Objets"];
$objets=ucfirst(strtolower($objets));
$objet=substr($objets,0,-1);
$objet=GlobalConstants::getObjectName($objet);
$objets=$objet . 's';

// On vérifie qu'on a bien un des trois objets 'utilisateurs' avec les informations assorties
if (!GlobalConstants::estObject($objet)) header('location: ../routeurcentral.php');
if (($objet!='Groupe')&&($objet!='Liste')&&($objet!='Mot')) header('location: ../routeurcentral.php');
if (($objet==='Liste')&&!isset($_GET["idgroupe"])) header('location: ../routeurcentral.php');
if (($objet==='Mot')&&!isset($_GET["idliste"])) header('location: ../routeurcentral.php');

// ajuster le get en fonction de l'objet getListesfromGroupe
$objet2getmethod =[
    'Groupe' => 'getGroupes',
    'Liste' => 'getListesfromGroupe',
    'Mot' => 'getMotsfromListeJson'
];

// On prépare le paramètre du get
$currentid = null;
if ($objet==='Liste') $currentid = $_GET["idgroupe"];
if ($objet==='Mot') $currentid = $_GET["idliste"];

// Préparation du type de Repo et de get à mettre en oeuvre
$currentRepo = $objet . 'Repo';
$currentGet = $objet2getmethod[$objet];
$currentObject = 'les'. $objets;

$leRepo = new $currentRepo;
if ($currentid == null) {
    $$currentObject = $leRepo->$currentGet();
    } else {
    $$currentObject = $leRepo->$currentGet($currentid);
    };

$titre = 'Entrainement';
if ($objet=='Liste') {
    $leGroupeRepo = new GroupeRepo;
    $leGroupe = $leGroupeRepo->getGroupe($currentid);
    $titre = '<a data-toggle="collapse" href="#collapseTitre" role="button" aria-expanded="false" aria-controls="collapseTitre" style="color:darkblue">' .
    $leGroupe->getTitreFrancais() . '</a>' . '<h4 class="collapse" id="collapseTitre" style="color:black">' . nl2br($leGroupe->getDescrFrancais()) .  '</h4>';
};

if ($objet=='Mot') {
    $laListeRepo = new ListeRepo;
    $laListe = $laListeRepo->getListe($currentid);
    $_SESSION["listeId"]=$currentid;
    $titre = '<a data-toggle="collapse" href="#collapseTitre" role="button" aria-expanded="false" aria-controls="collapseTitre" style="color:darkblue">' .
    $laListe->getTitreFrancais() . '</a>' . '<h4 class="collapse" id="collapseTitre" style="color:black">' . nl2br($laListe->getDescrFrancais()) .  '</h4>';   
};

include '../views/utilisateur.Objets.php';
