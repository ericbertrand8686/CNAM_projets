<?php

abstract class Repo {
    // Objet PDO d'accès à la BD
    protected $bdd = null;
    protected $requete;

    // Getter avec (si nécessaire) établissement de la connection
    private function getBdd() {

        if ($this->bdd == null) {
            try {
                require_once( __DIR__.'/../includes/bdd/config.inc.php');
                $bdd1 = new PDO("mysql:host=" . BD_HOST . ";dbname=" . BD_BASE . ";charset=UTF8", BD_USER, BD_PASSWORD);
            } catch (Exception $e) {
                $this->rapportErreurPDO("Problème de connexion à la base de données");
                return null;
            }
        $this->bdd = $bdd1;
        }
    return $this->bdd;
    }

    // Exécute une requête SQL paramétrée avec un booléen en retour
    protected function prepQueryBoolean($sql, $params = null) {

        $this->resetRequete();
        
        if ($this->requete = $this->getBdd()->prepare($sql)) {
			if ($this->requete->execute($params) ) {
				return true;
			} else
            $this->rapportErreurPDO($sql,$params,'Requête PDO non exécutée');
            return false;
		}

        $this->rapportErreurPDO($sql,$params,'Requête PDO non préparée');
        return false;
    }

    // Reset de la requête courante

    protected function resetRequete() {
        //$this->requete->closeCursor();
        $this->requete = null;
    }

    // Rapport d'erreur PDO
    protected function rapportErreurPDO($sql='', $data='', $comment='') {

        $text = __FILE__.' '.$sql.' '.$data.' '.$comment;

        if (GlobalConstants::getDEVCONFIG()) {
            echo $text.'<br><br>';
        } else {
            error_log($text);
        }
    }
}