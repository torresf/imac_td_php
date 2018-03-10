<?php
require_once("Personne.class.php");

if (isset($_GET) && !empty($_GET)) {
	$prenom = $_GET["prenom"];
	$nom = $_GET["nom"];
	$age = $_GET["age"];
	$ville = $_GET["ville"];

	if (isset($prenom) && isset($nom) && isset($age) && is_numeric($age) && isset($ville)) {
		$personne = new Personne($prenom, $nom, $age, $ville);
		$personne->afficher();
	} else {
		echo "Formulaire incomplet ou faussé.";
	}
}

?>