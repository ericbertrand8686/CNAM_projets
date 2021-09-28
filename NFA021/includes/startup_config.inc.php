
<?php

// Le reporting des erreurs est adapté en fonction du contexte

if (GlobalConstants::getDEVCONFIG()) {
    // development
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    //	production
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}




