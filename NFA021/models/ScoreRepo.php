<?php

class ScoreRepo extends Repo {

    public function getScoresUtilisateur($idutilisateur, $limit = 10) {

        $data = [
            'utilisateur_idutilisateur' => $idutilisateur,
        ];

		$SQL = "SELECT liste.idliste, liste.titreFrancais, liste.titreAnglais, score, dateModif " .
		"FROM `score_liste` " . 
        "LEFT JOIN liste ON score_liste.liste_idliste  = liste.idliste " .
        "WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur " .
		"ORDER BY dateModif DESC LIMIT " . $limit . ";";

        $scorelistes  = array();
        $res = $this->prepQueryBoolean($SQL, $data);

        if ($res) {
                while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
                    array_push($scorelistes, $resultat);
                }
        }

        return $scorelistes;
    }

	public function siexiste($idutilisateur, $idliste) : int
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'liste_idliste' => $idliste
		];

		$SQL = "SELECT utilisateur_idutilisateur FROM score_liste " .
		"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND liste_idliste= :liste_idliste ;";

		$res=0;
		if ($this->prepQueryBoolean($SQL, $data)) $res = $this->requete->rowCount();
		return (($res>0) ? 1 : 0);
	}

    public function insert($idutilisateur, $idliste, $score)
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'liste_idliste' => $idliste,
			'score' => $score,
			'dateModif' => Temps::getDateTime()
		];

		if(!$this->siexiste($idutilisateur, $idliste)) {
			$SQL = "INSERT INTO score_liste (utilisateur_idutilisateur, liste_idliste, score, dateModif) " .
			"VALUES (:utilisateur_idutilisateur, :liste_idliste, :score, :dateModif);";
			$res = $this->prepQueryBoolean($SQL, $data);
			return $res;
		} else {
			$SQL = "UPDATE score_liste SET score = GREATEST(score, :score), dateModif=:dateModif " .
			"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND liste_idliste= :liste_idliste ;";
			$res = $this->prepQueryBoolean($SQL, $data);
			return $res;
		}
	}

	public function delete($idutilisateur, $idliste)
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'liste_idliste' => $idliste
		];

		$SQL = "DELETE FROM score_liste " .
		"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND liste_idliste= :liste_idliste ;";
		return $this->prepQueryBoolean($SQL, $data);
	}
}
?>