<?php 

require_once("Movie.class.php");
require_once("data.movies.php");

if (isset($_GET) && !empty($_GET)) {

	//On récupère l'id en GET
	$id = $_GET["id"];

	// On parcourt le tableau de films pour trouver celui qui correspond à l'id stocké
	if ($movies) {
		foreach ($movies as $item) {
			if ($item['id'] == $id) {
				// Un fois le film trouvé, on crée une nouvelle instance de la class Movie avec les bons attributs.
				$movie = new Movie($item["id"], $item["title"], $item["releaseDate"], $item["genre"], $item["director"]);

				// On sort de la boucle foreach dès que le film a été trouvé
				break;
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Détails d'un film</title>
</head>
<body>
	<?php 
		if (!empty($movie))
			$movie->renderHTML();
	?>
</body>
</html>