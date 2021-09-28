<?php
class Mot
{
	private $id;
	private $nomAllemand;
	private $nomFrancais;
	private $nomAnglais;
	private $genre;
	private $regleGenre1;
	private $regleGenre2;
	private $confusionFact;
	private $estDer;
	private $estDie;
	private $estDas;
	private $descRegles;
	private $numdsListe;
	private $estIndice;

	/* Constructeur */
	public function __construct(int $id, string $nomAllemand, string $nomFrancais, string $nomAnglais, int $genre, $regleGenre1, $regleGenre2, $confusionFact)
	{
		$this->id = $id;
		$this->nomAllemand = $nomAllemand;
		$this->nomFrancais = $nomFrancais;
		$this->nomAnglais = $nomAnglais;
		$this->genre = $genre;
		$this->regleGenre1 = $regleGenre1;
		$this->regleGenre2 = $regleGenre2;
		$this->confusionFact = $confusionFact;
		$this->estDer = 0;
		$this->estDie = 0;
		$this->estDas = 0;
		$this->descRegles = '';
		$this->numdsListe = 0;
		$this->estIndice = 0;
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

	public function getNomAllemand(): string
	{
		return $this->nomAllemand;
	}

	public function setNomAllemand(string $nomAllemand)
	{
		$this->nomAllemand = $nomAllemand;
	}

	public function getNomFrancais(): string
	{
		return $this->nomFrancais;
	}

	public function setNomFrancais(string $nomFrancais)
	{
		$this->nomFrancais = $nomFrancais;
	}

	public function getNomAnglais(): string
	{
		return $this->nomAnglais;
	}

	public function setNomAnglais(string $nomAnglais)
	{
		$this->nomAnglais = $nomAnglais;
	}

	public function getGenre(): int
	{
		return $this->genre;
	}

	public function setGenre(int $descrAnglais)
	{
		$this->genre = $descrAnglais;
	}

	public function getRegleGenre1()
	{
		return $this->regleGenre1;
	}

	public function setRegleGenre1(int $regleGenre1)
	{
		$this->regleGenre1 = $regleGenre1;
	}

	public function getRegleGenre2()
	{
		return $this->regleGenre2;
	}

	public function setRegleGenre2(int $regleGenre2)
	{
		$this->regleGenre2 = $regleGenre2;
	}

	
	public function getConfusionFact()
	{
		return $this->confusionFact;
	}

	public function setConfusionFact(int $confusionFact)
	{
		$this->confusionFact = $confusionFact;
	}

	public function getDer(): int
	{
		return $this->estDer;
	}

	public function setDer(int $estDer)
	{
		$this->estDer = $estDer;
	}

	public function getDie(): int
	{
		return $this->estDie;
	}

	public function setDie(int $estDie)
	{
		$this->estDie = $estDie;
	}

	public function getDas(): int
	{
		return $this->estDas;
	}

	public function setDas(int $estDas)
	{
		$this->estDas = $estDas;
	}

	public function getDescRegles(): string
	{
		return $this->descRegles;
	}

	public function setDescRegles(string $descRegles)
	{
		$this->descRegles = $descRegles;
	}

	public function getNumdsListe(): int
	{
		return $this->numdsListe;
	}

	public function setNumdsListe(int $numdsListe)
	{
		$this->numdsListe = $numdsListe;
	}

	public function getEstIndice(): int
	{
		return $this->estIndice;
	}

	public function setEstIndice(int $estIndice)
	{
		$this->estIndice = $estIndice;
	}
}
