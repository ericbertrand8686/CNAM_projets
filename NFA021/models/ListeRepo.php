<?php

class ListeRepo extends Repo {

	public function getListe(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idliste, titreFrancais, titreAnglais, descrFrancais, descrAnglais, groupe_idgroupe, numdsGroupe " .
			"FROM `liste` " .
			"WHERE `liste`.idliste = :id;";

		$liste  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$liste = new Liste($resultat["idliste"], $resultat["titreFrancais"], $resultat["titreAnglais"], $resultat["descrFrancais"], $resultat["descrAnglais"], $resultat["groupe_idgroupe"], $resultat["numdsGroupe"]);
					return $liste;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getListes() {

		$data = null;

		$SQL = "SELECT idliste, titreFrancais, titreAnglais, descrFrancais, descrAnglais, groupe_idgroupe, numdsGroupe " .
			"FROM `liste` ";

		$listes  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$liste = new Liste($resultat["idliste"], $resultat["titreFrancais"], $resultat["titreAnglais"], $resultat["descrFrancais"], $resultat["descrAnglais"], $resultat["groupe_idgroupe"], $resultat["numdsGroupe"]);
					array_push($listes, $liste);
				}
		}

		return $listes;
	}

	public function getListesfromGroupe(int $idgroupe) {

		$data = [
			'groupe_idgroupe' => $idgroupe
		];

		$SQL = "SELECT idliste, titreFrancais, titreAnglais, descrFrancais, descrAnglais, groupe_idgroupe, numdsGroupe " .
			"FROM `liste` WHERE groupe_idgroupe = :groupe_idgroupe;";

		$listes  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$liste = new Liste($resultat["idliste"], $resultat["titreFrancais"], $resultat["titreAnglais"], $resultat["descrFrancais"], $resultat["descrAnglais"], $resultat["groupe_idgroupe"], $resultat["numdsGroupe"]);
					array_push($listes, $liste);
				}
		}

		return $listes;
	}


	public function insert(Liste $liste)
	{
		$data = [
			'titreFrancais' => $liste->getTitreFrancais(),
			'titreAnglais' => $liste->getTitreAnglais(),
			'descrFrancais' => $liste->getDescrFrancais(),
			'descrAnglais' => $liste->getDescrAnglais(),
			'groupe' => $liste->getGroupe(),
			'numdsGroupe' => $liste->getNumdsGroupe()
		];

		$SQL = "INSERT INTO liste (titreFrancais, titreAnglais, descrFrancais, descrAnglais, groupe_idgroupe, numdsGroupe) VALUES (:titreFrancais, :titreAnglais, :descrFrancais, :descrAnglais, :groupe, :numdsGroupe);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $liste->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Liste $liste)
	{
		$data = [
			'id' => $liste->getId(),
			'titreFrancais' => $liste->getTitreFrancais(),
			'titreAnglais' => $liste->getTitreAnglais(),
			'descrFrancais' => $liste->getDescrFrancais(),
			'descrAnglais' => $liste->getDescrAnglais(),
			'groupe' => $liste->getGroupe(),
			'numdsGroupe' => $liste->getNumdsGroupe()
		];

		$SQL = "UPDATE liste SET titreFrancais=:titreFrancais, titreAnglais=:titreAnglais, descrFrancais=:descrFrancais, descrAnglais=:descrAnglais, groupe_idgroupe=:groupe, numdsGroupe=:numdsGroupe WHERE idliste= :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Liste $liste)
	{
		$data = [
			'id' => $liste->getId()
		];

		$SQL = "DELETE FROM liste WHERE idliste = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

}
