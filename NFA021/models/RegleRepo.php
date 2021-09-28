<?php

class RegleRepo extends Repo {

	public function getRegle(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idregleGenre, titre, descrFrancais, descrAnglais, genre_idgenre " .
			"FROM `reglegenre` " .
			"WHERE `reglegenre`.idregleGenre = :id;";

		$regle  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$regle = new Regle($resultat["idregleGenre"], $resultat["titre"], $resultat["descrFrancais"], $resultat["descrAnglais"], $resultat["genre_idgenre"]);
					return $regle;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getRegles() {

		$data = null;

		$SQL = "SELECT idregleGenre, titre, descrFrancais, descrAnglais, genre_idgenre " .
			"FROM `reglegenre` ";

		$regles  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$regle = new Regle($resultat["idregleGenre"], $resultat["titre"], $resultat["descrFrancais"], $resultat["descrAnglais"], $resultat["genre_idgenre"]);
					array_push($regles, $regle);
				}
		}

		return $regles;
	}


	public function insert(Regle $regle)
	{
		$data = [
			'titre' => $regle->getTitre(),
			'descrFrancais' => $regle->getDescrFrancais(),
			'descrAnglais' => $regle->getDescrAnglais(),
			'genre' => $regle->getGenre()
		];

		$SQL = "INSERT INTO reglegenre (titre, descrFrancais, descrAnglais, genre_idgenre) VALUES (:titre, :descrFrancais, :descrAnglais, :genre);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $regle->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Regle $regle)
	{
		$data = [
			'id' => $regle->getId(),
			'titre' => $regle->getTitre(),
			'descrFrancais' => $regle->getDescrFrancais(),
			'descrAnglais' => $regle->getDescrAnglais(),
			'genre' => $regle->getGenre()
		];

		$SQL = "UPDATE reglegenre SET titre=:titre, titreAnglais=:titreAnglais, descrFrancais=:descrFrancais, descrAnglais=:descrAnglais, genre_idgenre=:genre WHERE idregleGenre= :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Regle $regle)
	{
		$data = [
			'id' => $regle->getId()
		];

		$SQL = "DELETE FROM reglegenre WHERE idregleGenre = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

}
