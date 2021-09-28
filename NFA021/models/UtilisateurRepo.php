<?php

class UtilisateurRepo extends Repo {


	public function getUtilisateur(int $id) {

		$data = array(':id' => $id);

		$SQL = "SELECT idutilisateur, nom, prenom, email, superadmin, estValide " .
			"FROM `utilisateur` " .
			"WHERE `utilisateur`.idutilisateur = :id;";

		$utilisateur  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$utilisateur = new Utilisateur($resultat["idutilisateur"], $resultat["nom"], $resultat["prenom"], $resultat["email"], '', $resultat["superadmin"], $resultat["estValide"],'');
					return $utilisateur;
				}
			} else {
				$this->rapportErreurPDO($this->requete,$data,'Le résultat de FETCH_ASSOC est vide');
				return false;
		}
	}

	public function getUtilisateurs() {

		$data = null;

		$SQL = "SELECT idutilisateur, nom, prenom, email, superadmin, estValide " .
			"FROM `utilisateur`";

		$utilisateurs  = array();
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
				while ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
					$utilisateur = new Utilisateur($resultat["idutilisateur"], $resultat["nom"], $resultat["prenom"], $resultat["email"], '', $resultat["superadmin"], $resultat["estValide"],'');
					array_push($utilisateurs, $utilisateur);
				}
		}

		return $utilisateurs;
	}

	public function validateUtilisateurWithJeton( string $jetonValidation) {

		$data = [
			'jetonValidation' => $jetonValidation 
		];

		$SQL = "UPDATE utilisateur SET estValide = 1 " .
			"WHERE `utilisateur`.jetonValidation = :jetonValidation " .
			"AND `utilisateur`.estValide = 0;";

		return $this->prepQueryBoolean($SQL, $data);
	}

	public function authentification(string $mail, string $password) {

		$data = [
			'mail' => $mail,
			'password' => $this->hashText($password)
		];

		$SQL = "SELECT idutilisateur, nom, prenom, email, superadmin, estValide " .
			"FROM `utilisateur` " .
			"WHERE `utilisateur`.email = :mail " . 
			"AND `utilisateur`.estValide = 1 " . 
			"AND `utilisateur`.password = :password;";

		$utilisateur  = null;
		$res = $this->prepQueryBoolean($SQL, $data);

		if ($res) {
			if ($resultat = $this->requete->fetch(PDO::FETCH_ASSOC)) {
				$utilisateur = new Utilisateur($resultat["idutilisateur"], $resultat["nom"], $resultat["prenom"], $resultat["email"], '', $resultat["superadmin"], $resultat["estValide"],'');
			} else {
				$this->rapportErreurPDO($SQL, $data, "Problème d'identification");
			}
		}

		return $utilisateur;
	}

	public function insert(Utilisateur $utilisateur)
	{
		$data = [
			'nom' => $utilisateur->getNom(),
			'prenom' => $utilisateur->getPrenom(),
			'mail' => $utilisateur->getMail(),
			'password' => $this->hashText($utilisateur->getPassword()),
			'superadmin' => ($utilisateur->getEstSuperAdmin()) ? 1 : 0,
			'estValide' => ($utilisateur->getEstValide()),
			'jetonValidation' => ($utilisateur->getJetonValidation())
		];

		$SQL = "INSERT INTO utilisateur (nom, prenom, email, password, superadmin, estValide, jetonValidation) VALUES (:nom, :prenom, :mail, :password, :superadmin, :estValide, :jetonValidation);";
		$res = $this->prepQueryBoolean($SQL, $data);
		if ($res) $utilisateur->setId($this->bdd->lastInsertId());
		return $res;
	}

	public function update(Utilisateur $utilisateur)
	{
		$data = [
			'id' => $utilisateur->getId(),
			'nom' => $utilisateur->getNom(),
			'prenom' => $utilisateur->getPrenom(),
			'mail' => $utilisateur->getMail(),
			'password' => $utilisateur->getPassword(),
			'superadmin' => ($utilisateur->getEstSuperAdmin()) ? 1 : 0
		];

		$SQL = "UPDATE utilisateur SET nom=:nom, prenom=:prenom, email=:mail, password=:password, superadmin=:superadmin WHERE idutilisateur = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function delete(Utilisateur $utilisateur)
	{
		$data = [
			'id' => $utilisateur->getId()
		];

		$SQL = "DELETE FROM utilisateur WHERE idutilisateur = :id;";
		return $this->prepQueryBoolean($SQL, $data);
	}

	public function hashText($txt) {
		return md5('das'.$txt.'Salz');
	}
}
