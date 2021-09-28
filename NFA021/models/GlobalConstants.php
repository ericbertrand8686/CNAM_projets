<?php

class GlobalConstants {

    private static $DEVCONFIG = true;

    public static function getROOTPATH() {
        return str_replace(DIRECTORY_SEPARATOR.'models' ,'',__DIR__) . DIRECTORY_SEPARATOR;
    }
    
    public static function getDEVCONFIG() {
        return self::$DEVCONFIG;
    }

    public static function estObject(string $object1) : int {
        return in_array($object1,['Utilisateur','Genre','Theme','Mot','Groupe','Liste','Regle','ConfusionFact','Score'],false);
    }

    public static function getObjectName (string $object1) : string {
		$data = [
            'Utilisateur' => 'Utilisateur',
            'Genre' => 'Genre',
            'Theme' => 'Theme',
            'Mot' => 'Mot',
            'Groupe' => 'Groupe',
            'Liste' => 'Liste',
            'Regle' => 'Regle',
            'Confusionfact' => 'ConfusionFact',
            'Score' => 'Score'
		];

        return $data[$object1];
    }
}

?>