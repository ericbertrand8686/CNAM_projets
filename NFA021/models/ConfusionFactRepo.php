<?php

class ConfusionFactRepo extends Repo {

	public function getConfusionFact(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idfacteurConfusion, titre, descrFrancais, descrAnglais " .
			"FROM `facteurconfusion` " .
			"WHERE `facteurconfusion`.idfacteurConfusion = :id;";

		$confusionFact  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$confusionFact = new ConfusionFact($resultat["idfacteurConfusion"], $resultat["titre"], $resultat["descrFrancais"], $resultat["descrAnglais"]);
					return $confusionFact;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getConfusionFacts() {

		$data = null;

		$SQL = "SELECT idfacteurConfusion, titre, descrFrancais, descrAnglais " .
			"FROM `facteurconfusion` ";

		$confusionFacts  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$confusionFact = new ConfusionFact($resultat["idfacteurConfusion"], $resultat["titre"], $resultat["descrFrancais"], $resultat["descrAnglais"]);
					array_push($confusionFacts, $confusionFact);
				}
		}

		return $confusionFacts;
	}


	public function insert(ConfusionFact $confusionFact)
	{
		$data = [
			'titre' => $confusionFact->getTitre(),
			'descrFrancais' => $confusionFact->getDescrFrancais(),
			'descrAnglais' => $confusionFact->getDescrAnglais(),
		];

		$SQL = "INSERT INTO facteurconfusion (titre, descrFrancais, descrAnglais) VALUES (:titre, :descrFrancais, :descrAnglais);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $confusionFact->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(ConfusionFact $confusionFact)
	{
		$data = [
			'id' => $confusionFact->getId(),
			'titre' => $confusionFact->getTitre(),
			'descrFrancais' => $confusionFact->getDescrFrancais(),
			'descrAnglais' => $confusionFact->getDescrAnglais(),
		];

		$SQL = "UPDATE facteurconfusion SET titre=:titre, titreAnglais=:titreAnglais, descrFrancais=:descrFrancais, descrAnglais=:descrAnglais WHERE idfacteurConfusion= :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(ConfusionFact $confusionFact)
	{
		$data = [
			'id' => $confusionFact->getId()
		];

		$SQL = "DELETE FROM facteurconfusion WHERE idfacteurConfusion = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

}
