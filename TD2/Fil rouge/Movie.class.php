<?php

class Movie {
	// Attributs
	private $id;
	private $title;
	private $releaseDate;
	private $genre;
	private $director;

	// Constructeur
	public function __construct($id, $title, $releaseDate, $genre, $director) {
		$this->id = (int) $id;
		$this->title = (string) ucwords(strtolower($title));
		$this->releaseDate = (string) $releaseDate;
		$this->genre = (string) $genre;
		$this->director = (string) $director;
	}

	// Getter générique
	public function get($attr) {
		if (property_exists('Movie', $attr)) {
			return $this->$attr;
		}
	}

	// Setter générique
	public function set($attr, $value) {
		if (property_exists('Movie', $attr)) {
			if ($attr != "id") { // Permet de ne pas modifier l'id
				$this->$attr = $value;
			}	
		}
	}

	// Méthode d'affichage
	public function renderHTML() {
		$main = "Titre : $this->title </br>";
		$main .= "Réalisateur : $this->director </br>";
		$date = DateTime::createFromFormat('Y-m-j', $this->releaseDate)->format("d/m/Y");
		$main .= "Date de sortie : $date </br>";
		$main .= "Genre : $this->genre </br>";
		echo $main;
	}
}