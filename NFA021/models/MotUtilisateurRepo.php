<?php

class MotUtilisateurRepo extends Repo {

    public function getMotsUtilisateur($idutilisateur, $nombre=10) {

        $data = [
            'idutilisateur' => $idutilisateur
        ];

        $SQL = "SELECT motallemand.idmotAllemand, motallemand.nomAllemand, motallemand.nomFrancais, motallemand.nomAnglais, motallemand.genre_idgenre, " .
        "motallemand.regleGenrePrinc_idregleGenre, motallemand.regleGenreSec_idregleGenre, motallemand.facteurConfusion_idfacteurConfusion, " .
        "genre.estDer, genre.estDie, genre.estDas, dateModif, " .
        "reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
        "reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
        "facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais " .
        "FROM utilisateur_has_motallemand " . 
        "LEFT JOIN motallemand ON utilisateur_has_motallemand.motAllemand_idmotAllemand  = motallemand.idmotAllemand " .
        "LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
        "LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
        "LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
        "LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion " .
        "WHERE utilisateur_has_motallemand.utilisateur_idutilisateur = :idutilisateur " .
		"ORDER BY dateModif DESC LIMIT ".$nombre.";";

        $motsutilisateur  = array();
        $res = $this->prepQueryBoolean($SQL, $data);

        if ($res) {
                while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
                    $mot = new Mot($resultat["idmotAllemand"], $resultat["nomAllemand"], $resultat["nomFrancais"], $resultat["nomAnglais"], $resultat["genre_idgenre"], $resultat["regleGenrePrinc_idregleGenre"], $resultat["regleGenreSec_idregleGenre"], $resultat["facteurConfusion_idfacteurConfusion"]);
                    $mot->setDer($resultat["estDer"]);
                    $mot->setDie($resultat["estDie"]);
                    $mot->setDas($resultat["estDas"]);
                    $descregle = $resultat["reglegenre1_descrFrancais"] . PHP_EOL . 
                        $resultat["reglegenre2_descrFrancais"] . PHP_EOL . 
                        $resultat["facteurconfusion_descrFrancais"] . PHP_EOL;
                    $mot->setDescRegles($descregle);
                    array_push($motsutilisateur, $mot);
                }
        }
        return $motsutilisateur;
    }

    public function insert($idutilisateur, $idmot)
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'motAllemand_idmotAllemand' => $idmot,
			'nbMiss' => 1,
			'nbOK' => 0,
			'dateModif' => Temps::getDateTime()
		];

		$SQL = "INSERT INTO utilisateur_has_motallemand (utilisateur_idutilisateur, motAllemand_idmotAllemand, nbMiss, nbOK, dateModif) " .
		"VALUES (:utilisateur_idutilisateur, :motAllemand_idmotAllemand, :nbMiss, :nbOK, :dateModif);";
		$res = $this->prepQueryBoolean($SQL, $data);
		return $res;
	}

	public function update($idutilisateur, $idmot, $nbmiss, $nbOK)
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'motAllemand_idmotAllemand' => $idmot,
			'nbMiss' => $nbmiss,
			'nbOK' => $nbOK,
			'dateModif' => Temps::getDateTime()
		];

		$SQL = "UPDATE utilisateur_has_motallemand SET nbMiss=:nbMiss, nbOK=:nbOK, dateModif=:dateModif " .
		"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND motAllemand_idmotAllemand= :motAllemand_idmotAllemand ;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete($idutilisateur, $idmot)
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'motAllemand_idmotAllemand' => $idmot
		];

		$SQL = "DELETE FROM utilisateur_has_motallemand " .
		"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND motAllemand_idmotAllemand= :motAllemand_idmotAllemand ;";
	
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function siexiste($idutilisateur, $idmot) : int
	{
		$data = [
			'utilisateur_idutilisateur' => $idutilisateur,
			'motAllemand_idmotAllemand' => $idmot
		];

		$SQL = "SELECT utilisateur_idutilisateur FROM utilisateur_has_motallemand " .
		"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND motAllemand_idmotAllemand= :motAllemand_idmotAllemand ;";

		$res=0;
		if ($this->prepQueryBoolean($SQL, $data)) $res = $this->requete->rowCount();
		return (($res>0) ? 1 : 0);
	}

    public function erreurMotUtilisateur($idutilisateur, $idmot) {
		if (!$this->siexiste($idutilisateur, $idmot)) {
			$this->insert($idutilisateur, $idmot);
		} else {
			$data = [
				'utilisateur_idutilisateur' => $idutilisateur,
				'motAllemand_idmotAllemand' => $idmot,
				'dateModif' => Temps::getDateTime()
			];
	
			$SQL = "UPDATE utilisateur_has_motallemand SET nbMiss= nbMiss + 1, dateModif=:dateModif " .
			"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND motAllemand_idmotAllemand= :motAllemand_idmotAllemand ;";
			return $this->prepQueryBoolean($SQL, $data);
		}


    }

    public function correctMotUtilisateur($idutilisateur, $idmot) {
		if ($this->siexiste($idutilisateur, $idmot)) {
			$data = [
				'utilisateur_idutilisateur' => $idutilisateur,
				'motAllemand_idmotAllemand' => $idmot,
				'dateModif' => Temps::getDateTime()
			];
	
			$SQL = "UPDATE utilisateur_has_motallemand SET nbOK= nbOK + 1, dateModif=:dateModif " .
			"WHERE utilisateur_idutilisateur= :utilisateur_idutilisateur AND motAllemand_idmotAllemand= :motAllemand_idmotAllemand ;";
			return $this->prepQueryBoolean($SQL, $data);
		}
    }

	public function deleteSiAppris()
	{
		$SQL = "DELETE FROM utilisateur_has_motallemand " .
		"WHERE nbOK>(nbMiss+1);";
		return $this->prepQueryBoolean($SQL);
	}
}





?>