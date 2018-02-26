<?php require_once("Personne.class.php"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Test Personne</title>
</head>
<body>
	<?php 
		$personnes = array();
		$personne1 = new Personne("FloRiAn", "torRes nomcomposé", 20, "Grenoble");
		$personne2 = new Personne("Tom", "Samaille", 20, "Grenoble");
		$personne3 = new Personne("Machin", "TRuc", 21, "Paris");
		array_push($personnes, $personne1, $personne2, $personne3);
		
		foreach ($personnes as $personne) {
			$personne->afficher();
		}
		
	?>
</body>
</html>