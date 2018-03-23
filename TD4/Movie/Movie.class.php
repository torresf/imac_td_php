<?php
require_once '../MyPDO.imac-movies.include.php';
require_once '../Genre.class.php';

/**
 * Classe Movie
 */
class Movie {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $id = null;
	// Titre
	private $title = null;
	// Date de sortie
	private $releaseDate = null;
	//Identifiant du pays
	private $idCountry = null;

	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Movie à partir d'un id (via la bdd)
	 * @param int $id identifiant du film à créer (bdd)
	 * @return Movie instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($id){
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Movie
			WHERE id = ?
		");

		$stmt->bindValue(1, $id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Movie");
		if (($object = $stmt->fetch()) !== false) {
			return $object;
		} else {
			throw new Exception("Erreur : l'id N°$id n'existe pas.");
		}
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter sur l'identifiant
	 * @return int $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Getter sur le titre
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Getter sur la date de sortie
	 * @return string $releaseDate
	 */
	public function getReleaseDate() {
		return $this->releaseDate;
	}

	/**
	 * Getter sur l'identifiant du pays
	 * @return string $idCountry
	 */
	public function getIdCountry() {
		return $this->idCountry;
	}

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Récupère tous les enregistrements de la table Movie de la bdd
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getAll() {
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Movie
			ORDER BY releaseDate DESC, title
		");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère tous les films du réalisateur/de la réalisatrice
	 * Tri par ordre décroissant sur la date de sortie
	 * puis par ordre alphabétique sur le titre
	 * @param int $idDirector identifiant du réalisateur/de la réalisatrice
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getFromDirectorId($idDirector){
		$stmt = MyPDO::getInstance()->prepare("
			SELECT m.*
			FROM Movie m
			INNER JOIN director d ON m.id = d.idMovie
			INNER JOIN cast c ON d.idDirector = c.id
			WHERE c.id = ?
			ORDER BY releaseDate DESC, title
		");
		$stmt->bindValue(1, $idDirector);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère tous les films de l'act.eur.rice avec son rôle pour chaque
	 * Tri par ordre décroissant sur la date de sortie
	 * puis dans l'ordre alphabétique sur le titre
	 * @param int $idActor identifiant l'act.eur.rice
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function getFromActorId($idActor){
		$stmt = MyPDO::getInstance()->prepare("
			SELECT m.*, a.name as role
			FROM Movie m
			INNER JOIN actor a ON m.id = a.idMovie
			INNER JOIN cast c ON a.idActor = c.id
			WHERE c.id = ?
			ORDER BY releaseDate DESC, title
		");
		$stmt->bindValue(1, $idActor);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère les genres du film courant ($this)
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
	public function getGenres() {
		$stmt = MyPDO::getInstance()->prepare("
			SELECT DISTINCT genre.* 
			FROM genre
			INNER JOIN moviegenre mg ON mg.idGenre = genre.id
			INNER JOIN movie m ON m.id = mg.idMovie
			WHERE m.id = ?
			ORDER BY genre.name
		");
		$stmt->bindValue(1, $this->getId());
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Genre');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère les films correspondants aux champs de recherche
	 * @return array<Movie> liste d'instances de Movie
	 */
	public static function searchMovies($title, $cast, $date_start, $date_end, $genres, $country) {

		// Si aucun genre n'est sélectionné, la recherche se fait sur tous les genres
		if (empty($genres)) {
			$genres_array = Genre::getAll();
			$genres = "";
			foreach ($genres_array as $genre) {
				$genres .= $genre->getName() .",";
			}
		} else {
			$genres = implode(",", $genres);
		}

		$stmt = MyPDO::getInstance()->prepare("
			SELECT m.id, m.title, m.releaseDate
			FROM movie m, country, cast, director d, actor a, genre g, moviegenre mg
			WHERE m.title LIKE :title
				AND country.code = :country
				AND m.idCountry = country.code
				AND ((CONCAT(cast.firstname, ' ', cast.lastname) LIKE :cast
					AND cast.id = d.idDirector
					AND d.idMovie = m.id) OR (CONCAT(cast.firstname, ' ', cast.lastname) LIKE :cast
					AND cast.id = a.idActor
					AND a.idMovie = m.id))
				AND DATE(m.releaseDate) BETWEEN DATE(:date_start) AND DATE(:date_end)
				AND FIND_IN_SET(g.name, :genres) 
				AND g.id = mg.idGenre
				AND m.id = mg.idMovie
			GROUP BY m.title
			ORDER BY m.title
		");

		// Dates par défaut
		if ($date_start=="")
			$date_start = "0000-01-01";
		if ($date_end=="")
			$date_end = "2100-01-01";

		$stmt->bindValue(":title", "%".$title."%");
		$stmt->bindValue(":country", $country);
		$stmt->bindValue(":cast", "%".$cast."%");
		$stmt->bindValue(":date_start", $date_start);
		$stmt->bindValue(":date_end", $date_end);
		$stmt->bindValue(":genres", $genres);

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Movie');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Ajoute un film à la base de données
	 */
	public static function addMovie($title, $releaseDate, $country) {

		// Préparation de la requête
		$stmt = MyPDO::getInstance()->prepare("
			INSERT INTO Movie VALUES (:id, :title, :releaseDate, :country)
		");

		$id = count(Movie::getAll());
		$stmt->bindValue(":id", $id+1);
		$stmt->bindValue(":title", $title);
		$stmt->bindValue(":releaseDate", $releaseDate);
		$stmt->bindValue(":country", $country);

		$stmt->execute();
	}

	/**
	 * Supprime un film de la base de données
	 */
	public static function removeMovie($idMovie) {
		// Préparation de la requête
		$stmt = MyPDO::getInstance()->prepare("
			DELETE FROM Movie 
			WHERE id = :id
		");
		$stmt->bindValue(":id", $idMovie);
		$stmt->execute();
	}

}
