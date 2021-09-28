<?php
class Genre
{
	private $id;
	private $titre;
	private $estDer;
	private $estDie;
	private $estDas;

	/* Constructeur */
	public function __construct(int $id, string $titre, int $estDer, int $estDie, int $estDas)
	{
		$this->id = $id;
		$this->titre = $titre;
		$this->estDer = $estDer;
		$this->estDie = $estDie;
		$this->estDas = $estDas;
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
}
