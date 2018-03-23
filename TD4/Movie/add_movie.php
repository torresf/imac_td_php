<?php 

require_once "Movie.class.php";
require_once "../Country.class.php";

?>
<a href="movies.php">Retour à la liste des films</a>
<h1>Ajouter un film</h1>

<!-- Création du formulaire d'ajout en html -->
<form method="POST" action="">
	<div>
		<label>Titre</label>
		<input type="text" name="title" placeholder="Titre" required>
	</div>
	
	<div>
		<label>Date de sortie</label>
		<input type="date" name="releaseDate" required>
	</div>

	<div>
		<label>Pays : </label>
		<select name="country" required>
			<?php
			$countries = Country::getAll();
			foreach ($countries as $country) {
				echo "<option value='{$country->getCode()}'>{$country->getName()}</option>";
			}
			?>
		</select>
	</div>
	
	<input type="submit" name="SubmitButton" value="Ajouter"/>
</form>

<?php 

if (isset($_POST['SubmitButton'])) {
	if (isset($_POST["title"]) && isset($_POST["releaseDate"]) && isset($_POST["country"])) {
		$title = $_POST["title"];
		$releaseDate = $_POST["releaseDate"];
		$country = $_POST["country"];
		Movie::addMovie($title, $releaseDate, $country);
		header('Location: movies.php');
	}
}

?>