<?php
class Regle
{
	private $id;
	private $titre;
	private $descrFrancais;
	private $descrAnglais;
	private $genre;

	/* Constructeur */
	public function __construct(int $id, string $titre, string $descrFrancais, string $descrAnglais, int $genre)
	{
		$this->id = $id;
		$this->titre = $titre;
		$this->descrFrancais = $descrFrancais;
		$this->descrAnglais = $descrAnglais;
		$this->genre = $genre;
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

	public function getTitre(): string
	{
		return $this->titre;
	}

	public function setTitre(string $titre)
	{
		$this->titre = $titre;
	}

	public function getDescrFrancais(): string
	{
		return $this->descrFrancais;
	}

	public function setDescrFrancais(string $descrFrancais)
	{
		$this->descrFrancais = $descrFrancais;
	}

	public function getDescrAnglais(): string
	{
		return $this->descrAnglais;
	}

	public function setDescrAnglais(string $descrAnglais)
	{
		$this->descrAnglais = $descrAnglais;
	}

	public function getGenre(): int
	{
		return $this->genre;
	}

	public function setGenre(int $genre)
	{
		$this->genre = $genre;
	}

}
