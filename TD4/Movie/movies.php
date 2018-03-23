<?php 

require_once "Movie.class.php";
require_once "../Genre.class.php";
require_once "../Country.class.php";

?>

<!-- Création du formulaire en html -->
<form method="POST" action="">
	<div>
		<label>Titre</label>
		<input type="text" name="title" placeholder="Titre" value="<?php if (isset($_POST["title"])) echo $_POST["title"] ?>">
	</div>
	<div>
		<label>Date de début</label>
		<input type="date" name="date_start" value="<?php if (isset($_POST["date_start"])) echo $_POST["date_start"] ?>">
		<label>Date de fin</label>
		<input type="date" name="date_end" value="<?php if (isset($_POST["date_end"])) echo $_POST["date_end"] ?>">
	</div>
	<div>
		<label>Cast</label>
		<input type="text" name="cast" placeholder="Membre du cast" value="<?php if (isset($_POST["cast"])) echo $_POST["cast"] ?>">
	</div>
	<div>
		<label>Genres : </label>
		<ul>
			<?php
			// Pour chaque genre, on crée une checkbox
			$genres = Genre::getAll();
			foreach ($genres as $genre) {
				echo "<li>";
					echo "<input type='checkbox' id='{$genre->getName()}' name='genres[]' value='{$genre->getName()}'";
					// On coche la checkbox si elle était coché dans la requête précédente
					if (isset($_POST["genres"]) && !empty($_POST["genres"])) {
						if (in_array($genre->getName(), $_POST["genres"])) {
							echo "checked";
						}
					}
					echo ">"; // On ferme la checkbox
					echo "<label for='{$genre->getName()}' name='genres[]'>{$genre->getName()}</label>"; // On affiche le label du genre
				echo "</li>";
			}
			?>
		</ul>
	</div>
	<div>
		<label>Pays : </label>
		<select name="country">
			<?php
			// On récupère tous les pays qui ont au minimum un film 
			$countries = Country::getAll();
			foreach ($countries as $country) {
				if ($_POST["country"] == $country->getCode()) {
					// On sélectionne le pays sélectionné de la requête précédente
					echo "<option value='{$country->getCode()}' selected>{$country->getName()}</option>";
				} else {
					echo "<option value='{$country->getCode()}'>{$country->getName()}</option>";
				}
			}
			?>
		</select>
			
	</div>
	
	<input type="submit" name="SubmitButton" value="Rechercher"/>
</form>

<a href="./add_movie.php">Ajouter un film</a></br>
<a href="./movies.php">Voir tous les films</a></br>

<?php

$movies = Movie::getAll();

// Gestion de la recherche
if (isset($_POST['SubmitButton'])) {
	if (isset($_POST["title"]) && isset($_POST["date_start"]) && isset($_POST["date_end"]) && isset($_POST["cast"]) && isset($_POST["country"])) {
		$title = $_POST["title"];
		$date_start = $_POST["date_start"];
		$date_end = $_POST["date_end"];
		$cast = $_POST["cast"];
		$genres_tri = (!empty($_POST["genres"])) ? $genres_tri = $_POST["genres"] : $genres_tri = array();
		$country = $_POST["country"];
		$movies = Movie::searchMovies($title, $cast, $date_start, $date_end, $genres_tri, $country);
	}
}

// Affichage des films triés
$main = "<h1>Liste des films</h1>";
foreach ($movies as $movie) {
	$main .= "<a href='movie.php?id={$movie->getId()}'>";
	$main .= $movie->getTitle(). " : " . $movie->getReleaseDate();
	$main .= "</a><br />";
}
echo $main;

?>