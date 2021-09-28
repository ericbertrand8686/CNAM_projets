<?php
class Groupe
{
	private $id;
	private $titreFrancais;
	private $titreAnglais;
	private $descrFrancais;
	private $descrAnglais;

	/* Constructeur */
	public function __construct(int $id, string $titreFrancais, string $titreAnglais, string $descrFrancais, string $descrAnglais)
	{
		$this->id = $id;
		$this->titreFrancais = $titreFrancais;
		$this->titreAnglais = $titreAnglais;
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

	public function getTitreFrancais(): string
	{
		return $this->titreFrancais;
	}

	public function setTitreFrancais(string $titreFrancais)
	{
		$this->titreFrancais = $titreFrancais;
	}

	public function getTitreAnglais(): string
	{
		return $this->titreAnglais;
	}

	public function setTitreAnglais(string $titreAnglais)
	{
		$this->titreAnglais = $titreAnglais;
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
