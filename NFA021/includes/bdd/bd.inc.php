<?php

require("config.inc.php");

function connexionBD()
{
	try {
		$BD = new PDO("mysql:host=" . BD_HOST . ";dbname=" . BD_BASE . ";charset=UTF8", BD_USER, BD_PASSWORD);
		return $BD;
	} catch (Exception $e) {
		echo "<p> Problème de connexion à la base de données. </p>";
		exit();
	}
}
