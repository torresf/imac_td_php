<?php
require_once '../MyPDO.imac-movies.include.php'; // TO DO : à modifier

/**
 * Classe Cast
 */
class Cast {

	/***********************ATTRIBUTS***********************/
	
	// Identidiant
	private $id=null;
	// Prénom
	private $firstname=null;
	// Nom
	private $lastname=null;
	// Année de naissance
	private $birthYear=null;
	// Année de décès
	private $deathYear=null;

	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Cast à partir d'un id (via la bdd)
	 * @param int $id identifiant du cast à créer (bdd)
	 * @return Cast instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($id){
		// TO DO
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Cast
			WHERE id = ?
		");
		$stmt->bindValue(1, $id);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Cast");
		if (($object = $stmt->fetch()) !== false) {
			return $object;
		} else {
			throw new Exception("Erreur : le cast N°$id n'existe pas.");
		}
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter sur l'identifiant
	 * @return int $id
	 */
	public function getId() {
		// TO DO
		return $this->id;
	}

	/**
	 * Getter sur le prénom
	 * @return string $firstname
	 */
	public function getFirstname() {
		// TO DO
		return $this->firstname;
	}

	/**
	 * Getter sur le nom
	 * @return string $lastname
	 */
	public function getLastname() {
		// TO DO
		return $this->lastname;
	}

	/**
	 * Getter sur l'année de naissance
	 * @return int $birthYear
	 */
	public function getBirthYear() {
		// TO DO
		return $this->birthYear;
	}

	/**
	 * Getter sur l'année de décès
	 * @return int $deathYear (null si vivant)
	 */
	public function getDeathYear() {
		// TO DO
		return $this->deathYear;
	}
	
	/**
	 * Vérifie si le cast est vivant.e
	 * @return bool
	 */
	public function isAlive() {
		// TO DO
		return $this->deathYear == null;
	}

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Récupère tous les enregistrements de la table Cast de la bdd
	 * Tri par ordre alphabétique sur le nom puis sur le prénom
	 * @return array<Cast> liste d'instances de Cast
	 */
	public static function getAll() {
		// TO DO
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Cast
			ORDER BY lastname, firstname
		");

		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cast');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère tou.te.s les réalisateurs/réalisatrices d'un film
	 * Tri par ordre alphabétique selon le nom puis le prénom
	 * @param  $idMovie identifiant du film
	 * @return array<Cast> liste des instances de Cast
	 */
	public static function getDirectorsFromMovieId($idMovie) {
		// TO DO next : #04 Jointure Cast - Movie
		$stmt = MyPDO::getInstance()->prepare("
			SELECT Cast.*
			FROM Cast
			INNER JOIN director ON cast.id = director.idDirector
			INNER JOIN movie ON director.idMovie = movie.id
			WHERE movie.id = ?
			ORDER BY firstname, lastname
		");
		$stmt->bindValue(1, $idMovie);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cast');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

	/**
	 * Récupère tou.te.s les acteurs/acteurs d'un film avec leur rôle
	 * Tri par ordre alphabétique selon le nom puis le prénom
	 * @param  $idMovie identifiant du film
	 * @return array<Cast> liste d'instances de Cast
	 */
	public static function getActorsFromMovieId($idMovie) {
		// TO DO next : #04 Jointure Cast - Movie
		$stmt = MyPDO::getInstance()->prepare("
			SELECT c.*, a.name
			FROM Cast c
			INNER JOIN actor a ON c.id = a.idActor
			INNER JOIN movie m ON a.idMovie = m.id
			WHERE m.id = ?
			ORDER BY firstname, lastname
		");
		$stmt->bindValue(1, $idMovie);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Cast');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}

}

?>