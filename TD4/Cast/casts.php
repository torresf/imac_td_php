<?php 

require_once "Cast.class.php";

$casts = Cast::getAll();
foreach ($casts as $cast) {
	$main = "<a href='cast.php?id={$cast->getId()}'>";
	$main .= $cast->getFirstname(). " " . $cast->getLastname();
	$main .= "</a><br />";
	echo $main;
}

?>