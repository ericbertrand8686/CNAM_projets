<?php

class MotRepo extends Repo {

	public function getMot(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idmotAllemand, nomAllemand, nomFrancais, nomAnglais, motallemand.genre_idgenre, " .
			"regleGenrePrinc_idregleGenre, regleGenreSec_idregleGenre, facteurConfusion_idfacteurConfusion, " .
			"genre.estDer, genre.estDie, genre.estDas, " .
			"reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
			"reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
			"facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais " .
			"FROM motallemand " .
			"LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
			"LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
			"LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
			"LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion " .
			"WHERE `motallemand`.idmotAllemand = :id;";

		$mot  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$mot = new Mot($resultat["idmotAllemand"], $resultat["nomAllemand"], $resultat["nomFrancais"], $resultat["nomAnglais"], $resultat["genre_idgenre"], $resultat["regleGenrePrinc_idregleGenre"], $resultat["regleGenreSec_idregleGenre"], $resultat["facteurConfusion_idfacteurConfusion"]);
					$mot->setDer($resultat["estDer"]);
					$mot->setDie($resultat["estDie"]);
					$mot->setDas($resultat["estDas"]);
					$descregle = $resultat["reglegenre1_descrFrancais"] . PHP_EOL . 
						$resultat["reglegenre2_descrFrancais"] . PHP_EOL . 
						$resultat["facteurconfusion_descrFrancais"] . PHP_EOL;
					$mot->setDescRegles($descregle);
					return $mot;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getMots() {

		$data = null;

		$SQL = "SELECT idmotAllemand, nomAllemand, nomFrancais, nomAnglais, motallemand.genre_idgenre, " .
		"regleGenrePrinc_idregleGenre, regleGenreSec_idregleGenre, facteurConfusion_idfacteurConfusion, " .
		"genre.estDer, genre.estDie, genre.estDas, " .
		"reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
		"reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
		"facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais " .
		"FROM motallemand " .
		"LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
		"LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
		"LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
		"LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion ";

		$mots  = array();
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
					array_push($mots, $mot);
				}
		}

		return $mots;
	}

	public function getMotsfromListe(int $idliste) {

		$data = [
			'idliste' => $idliste
		];

		$SQL = "SELECT idmotAllemand, nomAllemand, nomFrancais, nomAnglais, motallemand.genre_idgenre, " .
		"regleGenrePrinc_idregleGenre, regleGenreSec_idregleGenre, facteurConfusion_idfacteurConfusion, " .
		"genre.estDer, genre.estDie, genre.estDas, " .
		"reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
		"reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
		"facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais, " .
		"numdsListe, estIndice " .
		"FROM liste_has_motallemand " .
		"LEFT JOIN motallemand ON liste_has_motallemand.motAllemand_idmotAllemand = motallemand.idmotAllemand " .
		"LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
		"LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
		"LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
		"LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion " .
		"WHERE liste_has_motallemand.liste_idliste = :idliste " .
		"ORDER BY numdsListe;";

		$mots  = array();
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
					$mot->setNumdsListe($resultat["numdsListe"]);
					$mot->setEstIndice($resultat["estIndice"]);
					array_push($mots, $mot);
				}
		}

		return $mots;
	}

	// Complete un nouveau Mot qui ne serait pas issu d'une des fonctions Get dur Repo
	public function completeNewMot(Mot $mot) {

		$data = array(':id' => $mot->getId());

		$SQL = "SELECT genre.estDer, genre.estDie, genre.estDas, " .
			"reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
			"reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
			"facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais " .
			"FROM motallemand " .
			"LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
			"LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
			"LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
			"LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion " .
			"WHERE `motallemand`.idmotAllemand = :id;";

		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$mot->setDer($resultat["estDer"]);
					$mot->setDie($resultat["estDie"]);
					$mot->setDas($resultat["estDas"]);
					$descregle = $resultat["reglegenre1_descrFrancais"] . PHP_EOL . 
						$resultat["reglegenre2_descrFrancais"] . PHP_EOL . 
						$resultat["facteurconfusion_descrFrancais"] . PHP_EOL;
					$mot->setDescRegles($descregle);
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}


	public function getMotsfromListeJson(int $idliste) {

		$data = [
			'idliste' => $idliste
		];

		$SQL = "SELECT idmotAllemand, nomAllemand, nomFrancais, nomAnglais, motallemand.genre_idgenre, " .
		"regleGenrePrinc_idregleGenre, regleGenreSec_idregleGenre, facteurConfusion_idfacteurConfusion, " .
		"genre.estDer, genre.estDie, genre.estDas, " .
		"reglegenre1.descrFrancais reglegenre1_descrFrancais, reglegenre1.descrAnglais reglegenre1_descrAnglais, " .
		"reglegenre2.descrFrancais reglegenre2_descrFrancais, reglegenre2.descrAnglais reglegenre2_descrAnglais, " .
		"facteurconfusion.descrFrancais facteurconfusion_descrFrancais, facteurconfusion.descrAnglais facteurconfusion_descrAnglais, " .
		"numdsListe, estIndice " .
		"FROM liste_has_motallemand " .
		"LEFT JOIN motallemand ON liste_has_motallemand.motAllemand_idmotAllemand = motallemand.idmotAllemand " .
		"LEFT JOIN genre ON motallemand.genre_idgenre = genre.idgenre " .
		"LEFT JOIN reglegenre reglegenre1 ON motallemand.regleGenrePrinc_idregleGenre = reglegenre1.idregleGenre " .
		"LEFT JOIN reglegenre reglegenre2 ON motallemand.regleGenreSec_idregleGenre = reglegenre2.idregleGenre " .
		"LEFT JOIN facteurconfusion ON motallemand.facteurConfusion_idfacteurConfusion = facteurconfusion.idfacteurConfusion " .
		"WHERE liste_has_motallemand.liste_idliste = :idliste " .
		"ORDER BY numdsListe;";

		$mots  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					array_push($mots, json_encode($resultat,JSON_PRETTY_PRINT));
				}
		}

		return $mots;
	}


	public function insert(Mot $mot)
	{
		$data = [
			'nomAllemand' => $mot->getNomAllemand(),
			'nomFrancais' => $mot->getNomFrancais(),
			'nomAnglais' => $mot->getNomAnglais(),
			'genre' => $mot->getGenre(),
			'regleGenre1' => $mot->getRegleGenre1(),
			'regleGenre2' => $mot->getRegleGenre2(),
			'confusionFact' => $mot->getConfusionFact()
		];

		$SQL = "INSERT INTO motallemand (idmotAllemand, nomAllemand, nomFrancais, nomAnglais, genre_idgenre, " .
		"regleGenrePrinc_idregleGenre, regleGenreSec_idregleGenre, facteurConfusion_idfacteurConfusion) " .
		"VALUES (:nomAllemand, :nomFrancais, :nomAnglais, :genre, :regleGenre1, :regleGenre2, :confusionFact);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $mot->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Mot $mot)
	{
		$data = [
			'id' => $mot->getId(),
			'nomAllemand' => $mot->getNomAllemand(),
			'nomFrancais' => $mot->getNomFrancais(),
			'nomAnglais' => $mot->getNomAnglais(),
			'genre' => $mot->getGenre(),
			'regleGenre1' => $mot->getRegleGenre1(),
			'regleGenre2' => $mot->getRegleGenre2(),
			'confusionFact' => $mot->getConfusionFact()
		];

		$SQL = "UPDATE motallemand SET nomAllemand=:nomAllemand, nomFrancais=:nomFrancais, " .
		"nomAnglais=:nomAnglais, genre_idgenre=:genre, regleGenrePrinc_idregleGenre=:regleGenre1, " .
		"regleGenreSec_idregleGenre=:regleGenre2,  facteurConfusion_idfacteurConfusion=:confusionFact " .
		"WHERE idliste= :id;";

		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Mot $mot)
	{
		$data = [
			'idmotAllemand' => $mot->getId()
		];

		$SQL = "DELETE FROM motallemand WHERE idmotAllemand = :idmotAllemand;";
		return $this->prepQueryBoolean($SQL, $data);
	}
}
