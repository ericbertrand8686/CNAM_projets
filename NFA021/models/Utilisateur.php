<?php
class Utilisateur
{

	private $id;
	private $nom;
	private $prenom;
	private $email;
	private $password;
	private $estSuperAdmin;
	private $estValide;
	private $jetonValidation;

	/* Constructeur */
	public function __construct(int $id, string $nom, string $prenom, string $mail, string $password, int $estSuperAdmin, int $estValide, string $jetonValidation)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->email = $mail;
		$this->password = $password;
		$this->estSuperAdmin = $estSuperAdmin;
		$this->estValide = $estValide;
		$this->jetonValidation = $jetonValidation;
	}

	/* Getters/Setters */
	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id)
	{
		$this->id = $id;
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	public function setNom(string $nom)
	{
		$this->nom = $nom;
	}

	public function getPrenom(): string
	{
		return $this->prenom;
	}

	public function setPrenom(string $prenom)
	{
		$this->prenom = $prenom;
	}

	public function getMail(): string
	{
		return $this->email;
	}

	public function setMail(string $mail)
	{
		$this->email = $mail;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}

	public function getEstSuperAdmin(): int
	{
		return $this->estSuperAdmin;
	}

	public function setEstSuperAdmin(int $estSuperAdmin)
	{
		$this->estSuperAdmin = $estSuperAdmin;
	}

	public function getEstValide(): int
	{
		return $this->estValide;
	}

	public function setEstValide(int $estValide)
	{
		$this->estValide = $estValide;
	}

	public function getJetonValidation(): string
	{
		return $this->jetonValidation;
	}

	public function setJetonValidation(string $jetonValidation)
	{
		$this->jetonValidation = $jetonValidation;
	}
}
