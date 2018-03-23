<?php 

require_once "Movie.class.php";
require_once "../Cast/Cast.class.php";
require_once "../Country.class.php";

?> <a href="movies.php">Retour à la liste des films</a><br/> <?php

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if (isset($id) && !empty($id)) {

		try {
			// Instanciation d'un objet Movie
			$movie = Movie::createFromId($id);

			// Affichage des données du film
			$main = "<h3>{$movie->getTitle()}</h3>";
			$main .= "Release date : " . date_format(date_create($movie->getReleaseDate()), "d/m/Y") . "<br />";

			// Affichage du pays
			$main .= "Country : " . Country::createFromCode($movie->getIdCountry())->getName() . "<br />";

			// Listage des genres
			$genres = $movie->getGenres();
			if (!empty($genres)) {
				$main .= "Genre(s) : <br />";
				$main .= "<ul>";
				foreach ($genres as $genre) {
					$main .= "<li>{$genre->getName()}</li>";
				}
				$main .= "</ul>";
			}
			
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
		} catch (Exception $e) {
			/**
			 *  Si l'instanciation n'a pas fonctionné,
			 *  on affiche le message d'erreur
			 */
			echo $e->getMessage();
		}		
	}
}

if (isset($movie)) { 
	?>

	<!-- Formulaire de suppression -->
	<form method="POST" action="">
		<input type="hidden" name="idMovie">
		<input type="submit" name="SubmitButton" value="Supprimer le film"/>
	</form>

	<?php 
}

// Suppression d'un film
if (isset($_POST['SubmitButton'])) {
	// Appel de la fonction de suppression avec l'id correspondant au film
	Movie::removeMovie($movie->getId());
	// Redirection vers movies.php une fois le film supprimé
	header('Location: movies.php');
}

?>