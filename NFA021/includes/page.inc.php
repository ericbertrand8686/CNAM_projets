<?php

/* Utilisation de spl_autoload_registrer */
function charge($nomClasse)
{
	//include './models/' . $nomClasse . '.php';
	include __DIR__ . '/../models/' . $nomClasse . '.php';
}

spl_autoload_register('charge');

function afficherErreurPDO($cheminFichier, $requete)
{
	echo "\nERREUR PDO sur le fichier '" . $cheminFichier . "':\n";
	echo "<pre>";
	print_r($requete->errorInfo());
	echo "</pre>";
	exit();
}

function protectionDonneesFormulaire(string $variable): string
{
	return htmlspecialchars($variable);
}
