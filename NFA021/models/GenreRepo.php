<?php

class GenreRepo extends Repo {

	public function getGenre(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idgenre, titre, estDer, estDie, estDas " .
			"FROM `genre` " .
			"WHERE `genre`.idgenre = :id;";

		$genre  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$genre = new Genre($resultat["idgenre"], $resultat["titre"], $resultat["estDer"], $resultat["estDie"], $resultat["estDas"]);
					return $genre;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getGenres() {

		$data = null;

		$SQL = "SELECT idgenre, titre, estDer, estDie, estDas " .
			"FROM `genre` ";

		$genres  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$genre = new Genre($resultat["idgenre"], $resultat["titre"], $resultat["estDer"], $resultat["estDie"], $resultat["estDas"]);
					array_push($genres, $genre);
				}
		}

		return $genres;
	}


	public function insert(Genre $genre)
	{
		$data = [
			'titre' => $genre->getTitre(),
			'estDer' => $genre->getDer(),
			'estDer' => $genre->getDie(),
			'estDer' => $genre->getDas()
		];

		$SQL = "INSERT INTO genre (titre, estDer, estDie, estDas) VALUES (:titre, :estDer, :estDie, :estDas);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $genre->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Genre $genre)
	{
		$data = [
			'id' => $genre->getId(),
			'titre' => $genre->getTitre(),
			'estDer' => $genre->getDer(),
			'estDer' => $genre->getDie(),
			'estDer' => $genre->getDas()
		];

		$SQL = "UPDATE genre SET titre=:titre, estDer=:estDer, estDie=:estDie, estDas=:estDas WHERE idgenre= :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Genre $genre)
	{
		$data = [
			'id' => $genre->getId()
		];

		$SQL = "DELETE FROM genre WHERE idgenre = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

}
