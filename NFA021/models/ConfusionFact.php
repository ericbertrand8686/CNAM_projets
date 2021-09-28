<?php
class ConfusionFact
{
	private $id;
	private $titre;
	private $descrFrancais;
	private $descrAnglais;

	/* Constructeur */
	public function __construct(int $id, string $titre, string $descrFrancais, string $descrAnglais)
	{
		$this->id = $id;
		$this->titre = $titre;
		$this->descrFrancais = $descrFrancais;
		$this->descrAnglais = $descrAnglais;
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

}
