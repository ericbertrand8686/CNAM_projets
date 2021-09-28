<?php

class GroupeRepo extends Repo {

	public function getGroupe(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idgroupe, titreFrancais, titreAnglais, descrFrancais, descrAnglais " .
			"FROM `groupe` " .
			"WHERE `groupe`.idgroupe = :id;";

		$groupe  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$groupe = new Groupe($resultat["idgroupe"], $resultat["titreFrancais"], $resultat["titreAnglais"], $resultat["descrFrancais"], $resultat["descrAnglais"]);
					return $groupe;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getGroupes() {

		$data = null;

		$SQL = "SELECT idgroupe, titreFrancais, titreAnglais, descrFrancais, descrAnglais " .
			"FROM `groupe` ";

		$groupes  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$groupe = new Groupe($resultat["idgroupe"], $resultat["titreFrancais"], $resultat["titreAnglais"], $resultat["descrFrancais"], $resultat["descrAnglais"]);
					array_push($groupes, $groupe);
				}
		}

		return $groupes;
	}


	public function insert(Groupe $groupe)
	{
		$data = [
			'titreFrancais' => $groupe->getTitreFrancais(),
			'titreAnglais' => $groupe->getTitreAnglais(),
			'descrFrancais' => $groupe->getDescrFrancais(),
			'descrAnglais' => $groupe->getDescrAnglais()
		];

		$SQL = "INSERT INTO groupe (titreFrancais, titreAnglais, descrFrancais, descrAnglais) VALUES (:titreFrancais, :titreAnglais, :descrFrancais, :descrAnglais);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $groupe->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Groupe $groupe)
	{
		$data = [
			'id' => $groupe->getId(),
			'titreFrancais' => $groupe->getTitreFrancais(),
			'titreAnglais' => $groupe->getTitreAnglais(),
			'descrFrancais' => $groupe->getDescrFrancais(),
			'descrAnglais' => $groupe->getDescrAnglais()
		];

		$SQL = "UPDATE groupe SET titreFrancais=:titreFrancais, titreAnglais=:titreAnglais, descrFrancais=:descrFrancais, descrAnglais=:descrAnglais WHERE idgroupe= :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Groupe $groupe)
	{
		$data = [
			'id' => $groupe->getId()
		];

		$SQL = "DELETE FROM groupe WHERE idgroupe = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

}
