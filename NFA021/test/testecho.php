<?php

session_start();
include_once('../includes/page.inc.php');

echo '<br>';
echo 'Current directory : ' . __DIR__;
echo '<br><br>';

echo 'Current directory : ' . $_SERVER['SCRIPT_FILENAME'];
echo '<br><br>';

echo '<br><br>';

echo md5('1234');

echo '<br><br>';
echo 'Directory separator : ' . DIRECTORY_SEPARATOR  ;

echo '<br><br>-----';
var_dump($_SESSION["Utilisateur"]) ;



echo '<br><br>';
echo md5('das'.'1234'.'Salz');
echo '<br><br>';
echo 'Server Root : ' . $_SERVER['DOCUMENT_ROOT'] . '<br><br>';

echo  'Error reporting : ' . error_reporting() . '<br><br>';

echo 'Dev config : ' . GlobalConstants::getDEVCONFIG() . '<br><br>';

echo "Root Path : " . GlobalConstants::getROOTPATH();
echo '<br><br>';

echo "Caractère : " . PHP_EOL . "PHP_EOL render sans nl2br()";
echo '<br><br>';
echo nl2br("Caractère : " . PHP_EOL . "PHP_EOL render avec nl2br()");

echo '<br><br>';
echo "Temps : " . Temps::getDateTime();
echo '<br><br>';

$myRepo = new UtilisateurRepo;

echo "PW : " . $myRepo->hashText('1234');


?>