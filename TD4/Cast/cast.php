<?php 

require_once "Cast.class.php";
require_once "../Movie/Movie.class.php";

echo '<a href="../Movie/movies.php">Retour à la liste des films</a><br/><br/>';

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	if (isset($id) && !empty($id)) {
		try {
			// Instanciation d'un objet Cast
			$cast = Cast::createFromId($id);
		} catch (Exception $e) {
			/**
			 *  Si l'instanciation n'a pas fonctionné,
			 *  on affiche le message d'erreur
			 *	et on tue le script
			 */
			echo $e->getMessage();
			die();
		}

		// Affichage du nom et de la date de naissance
		$main = $cast->getFirstname(). " " . $cast->getLastname() . "<br />";
		$main .= "Born in ". $cast->getBirthYear() . "<br />";

		// Récupération des films en tant que réalisateur
		$d_movies = Movie::getFromDirectorId($cast->getId());
		if (!empty($d_movies)) {
			$main .= "Movies as Director :";
			$main .= "<ul>";
			foreach ($d_movies as $movie) {
				$main .= "<li><a href='../Movie/movie.php?id={$movie->getId()}'>{$movie->getTitle()} ({$movie->getReleaseDate()})</a></li>";
			}
			$main .= "</ul>";
		}

		// Récupération des films en tant qu'acteur
		$a_movies = Movie::getFromActorId($cast->getId());
		if (!empty($a_movies)) {
			$main .= "Movies as Actor : ";
			$main .= "<ul>";
			foreach ($a_movies as $movie) {
				$main .= "<li><a href='../Movie/movie.php?id={$movie->getId()}'>{$movie->getTitle()} ({$movie->getReleaseDate()}) : {$movie->role}</a></li>";
			}
			$main .= "</ul>";
		}

		echo $main;
	}
}


?>