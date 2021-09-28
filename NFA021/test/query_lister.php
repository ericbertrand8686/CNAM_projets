<?php

echo "<br>";
echo "Type de requête : ";
echo $_SERVER["REQUEST_METHOD"];
echo "<br><br>";

if (!empty($_POST))
{
	echo "Contenu POST:<br>";

	foreach( array_keys($_POST) as $key  ) {
	echo "<p>" . $key . " = " . $_POST[$key] . "</p>";
	}
}
else // $_POST is empty.
{
    echo "<br>Pas de contenu POST<br><br>";
}

echo "<br>";

if (!empty($_GET))
{
	echo "Contenu GET:<br><br>";
	
	foreach( array_keys($_GET) as $key  ) {
	echo "<p>" . $key . " = " . $_GET[$key] . "</p>";
	}
}
else // $_GET is empty.
{
    echo "Pas de contenu GET<br>";
}

?>