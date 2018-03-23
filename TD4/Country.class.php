<?php
require_once 'MyPDO.imac-movies.include.php';

/**
 * Classe Country
 */
class Country {

	/***********************ATTRIBUTS***********************/
	
	// Code
	private $code = null;
	// Nom
	private $name = null;


	/*********************CONSTRUCTEURS*********************/
	
	// Constructeur non accessible
	function __construct() {}

	/**
	 * Usine pour fabriquer une instance de Country à partir d'un code (via la bdd)
	 * @param string $code code du pays à créer (bdd)
	 * @return Country instance correspondant à $code
	 * @throws Exception s'il n'existe pas cet $code dans a bdd
	 */
	public static function createFromCode($code){
		$stmt = MyPDO::getInstance()->prepare("
			SELECT *
			FROM Country
			WHERE code = ?
		");
		$stmt->bindValue(1, $code);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Country");
		if (($object = $stmt->fetch()) !== false) {
			return $object;
		} else {
			throw new Exception("Erreur : le pays $code n'existe pas.");
		}
	}

	/********************GETTERS SIMPLES********************/
	
	/**
	 * Getter sur l'identifiant
	 * @return int $id
	 */
	public function getCode() {
		return $this->code;
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
	 * Récupère tous les enregistrements de la table Country de la bdd
	 * qui ont au moins un film associé au pays
	 * Tri par ordre alphabétique
	 * @return array<Country> liste d'instances de Country
	 */
	public static function getAll() {
		$stmt = MyPDO::getInstance()->prepare("
			SELECT DISTINCT c.* 
			FROM Country c
			INNER JOIN movie m ON m.idCountry = c.code
			ORDER BY c.name
		");
		$stmt->execute();

		// On récupère un tableau d'instances de la classe Country
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Country');
		if (($objects = $stmt->fetchAll()) !== false) {
			return $objects;
		} else {
			throw new Exception("Error");
		}
	}
}
