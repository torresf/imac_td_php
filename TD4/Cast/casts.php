<?php 

require_once "Cast.class.php";

// On récupère tous les objets cast
$casts = Cast::getAll();

// On liste ces objets avec un lien vers la page de chaque personne
foreach ($casts as $cast) {
	$main = "<a href='cast.php?id={$cast->getId()}'>";
	$main .= $cast->getFirstname(). " " . $cast->getLastname();
	$main .= "</a><br />";
	echo $main;
}

?>