<?php 

require_once "Movie.class.php";
require_once "../Cast/Cast.class.php";
require_once "../Country.class.php";

echo '<a href="movies.php">Retour à la liste des films</a><br/><br/>';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if (isset($id) && !empty($id)) {

		try {
			// Instanciation d'un objet Movie
			$movie = Movie::createFromId($id);
		} catch (Exception $e) {
			/**
			 *  Si l'instanciation n'a pas fonctionné,
			 *  on affiche le message d'erreur
			 *	et on tue le script
			 */
			echo $e->getMessage();
			die();
		}
		
		// Affichage des données du film
		$main = "<h3>" . $movie->getTitle() . "</h3>";
		$main .= "Release date : " . date_format(date_create($movie->getReleaseDate()), "d/m/Y") . "<br />";

		// Affichage du pays
		$main .= "Country : " . Country::createFromCode($movie->getIdCountry())->getName() . "<br />";

		// Listage des genres
		$genres = $movie->getGenres();
		$main .= "Genre(s) : <br />";
		$main .= "<ul>";
		foreach ($genres as $genre) {
			$main .= "<li>{$genre->getName()}</li>";
		}
		$main .= "</ul>";
		
		// Listage des Réalisateurs
		$directors = Cast::getDirectorsFromMovieId($movie->getId());
		if (!empty($directors)) {
			$main .= "Director(s) : ";
			$main .= "<ul>";
			foreach ($directors as $director) {
				$main .= "<li><a href='../Cast/cast.php?id={$director->getId()}'>{$director->getFirstName()} {$director->getLastName()}</a></li>";
			}
			$main .= "</ul>";
		}

		// Listage des Acteurs
		$actors = Cast::getActorsFromMovieId($movie->getId());
		if (!empty($actors)) {
			$main .= "Actors(s) : ";
			$main .= "<ul>";
			foreach ($actors as $actor) {
				$main .= "<li><a href='../Cast/cast.php?id={$actor->getId()}'>{$actor->getFirstName()} {$actor->getLastName()}</a></li>";
			}
			$main .= "</ul>";
		}

		echo $main;
	}
}

?>

<form method="POST" action="">
	<input type="hidden" name="idMovie">
	<input type="submit" name="SubmitButton" value="Supprimer le film"/>
</form>

<?php 

if (isset($_POST['SubmitButton'])) {
	Movie::removeMovie($movie->getId());
	header('Location: movies.php');
}

?>