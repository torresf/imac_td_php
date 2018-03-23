<?php
require_once 'MyPDO.imac-movies.include.php';

/**
 * Classe Genre
 */
class Genre {

	/***********************ATTRIBUTS***********************/
	
	// Identifiant
	private $id = null;
	// Nom
	private $name = null;


	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Genre à partir d'un id (via la bdd)
	 * @param int $id identifiant du genre à créer (bdd)
	 * @return Genre instance correspondant à $id
	 * @throws Exception s'il n'existe pas cet $id dans a bdd
	 */
	public static function createFromId($id) {
		// Préparation de la requête
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Genre
			WHERE id = ?
		");

		//On lie l'id en paramètre à la requête, puis on l'exécute
		$stmt->bindValue(1, $id);
		$stmt->execute();

		// On récupère le résultat sous forme d'instance de Genre
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Genre");
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
	 * Getter sur le nom
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/*******************GETTERS COMPLEXES*******************/

	/**
	 * Récupère tous les enregistrements de la table Genre de la bdd
	 * qui ont au moins un film associé au genre
	 * Tri par ordre alphabétique
	 * @return array<Genre> liste d'instances de Genre
	 */
	public static function getAll() {
		// Préparation de la requête
		$stmt = MyPDO::getInstance()->prepare("
			SELECT DISTINCT genre.* 
			FROM genre
			INNER JOIN moviegenre mg ON mg.idGenre = genre.id
			INNER JOIN movie m ON m.id = mg.idMovie
			ORDER BY genre.name
		");

		// Execution de la requête
		$stmt->execute();

		// On récupère le résultat sous forme de tableau d'instances de Genre
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Genre');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}
}
