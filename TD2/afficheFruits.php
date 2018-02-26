<?php

$main;

if (isset($_POST["fruits"])) {
	$fruits = $_POST["fruits"];
	$main = "J'adore ";
	foreach ($fruits as $key => $fruit) {
		$main = $main."les ".$fruit;
		if ($key == sizeof($fruits) - 1) { // If last element, display a dot instead of comma.
			$main = $main.".";
		} else {
			$main = $main.", ";
		}
	}
} else {
	$main = "Je n'aime aucun fruit.";
}

echo $main;