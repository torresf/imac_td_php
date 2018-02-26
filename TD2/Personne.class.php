<?php
class Personne {
	private $prenom;
	private $nom;
	private $age;
	private $ville;

	public function __construct($prenom, $nom, $age, $ville) {
		// -- à compléter
		$this->prenom = (string) ucwords(strtolower($prenom));
		$this->nom = (string) ucwords(strtolower($nom));
		$this->age = (int) $age;
		$this->ville = (string) $ville;
	}

	public function set($attr, $value) {
		if (property_exists('Personne', $attr)) {
			$this->$attr = $value;
		}
	}

	public function get($attr) {
		if (property_exists('Personne', $attr)) {
			return $this->$attr;
		}
	}

	public function afficher() {
		//Récupère l'heure et affiche "Bonjour" si l'heure est inférieur à 18h, "Bonsoir sinon"
		$main;
		if (date('H') < 18) {
			$main = "Bonjour, ";
		} else {
			$main = "Bonsoir, ";
		}
		echo $main."je m'appelle {$this->prenom} {$this->nom}, je viens de {$this->ville} et j'ai {$this->age} ans.</br>";
	}
}