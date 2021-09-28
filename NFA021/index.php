<?php

include('./includes/page.inc.php');

session_start();

if ($_SESSION["Utilisateur"] == null) {
    include_once('./includes/startup_config.inc.php');
}

header("location: /routeurcentral.php");
exit();

?>