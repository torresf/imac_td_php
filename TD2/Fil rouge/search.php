<?php require_once("data.movies.php"); // Chargement des données ?>

<h1>Rechercher un film</h1>
<form method="GET" action="movies.php">
	<div>
		<label>Titre</label>
		<input type="text" name="title" placeholder="Titre" />
	</div>
	
	<div>
		<label>Date de début</label>
		<input type="date" name="date_start" />
		<label>Date de fin</label>
		<input type="date" name="date_end" />
	</div>
	
	<div>
		<label>Réalisateur</label>
		<input type="text" name="director" placeholder="Réalisateur">
	</div>
	
	<div>
		<label>Genres : </label>
		<ul>
			<?php
			// Pour chaque genre, on crée une checkbox
			foreach ($genres as $genre) {
				echo "<li>";
					echo "<input type='checkbox' id='$genre' name='genres[]' value='$genre'>";
					echo "<label for='$genre' name='genres[]'>$genre</label>";
				echo "</li>";
			}
			?>
		</ul>
	</div>
	

	<input type="submit" value="Rechercher"/>
</form>



<!-- CSS facultatif -->
<style type="text/css">

body {
	font-family: "Open Sans", Arial;
}
h1 {
	text-align: center;
}
form {
	background-color: #eee;
	width: 35%;
	margin-left: 50%;
	transform: translateX(-50%);
	padding: 20px;
}
label {
	font-weight: bold;
}
input {
	background-color: white;
	border: 0px;
	padding: 10px;
	margin-top: 10px;
}

input[type="submit"] {
	cursor: pointer;
	background-color: #f34141;
	color: white;
}
ul{
	list-style: none;
}
ul li label {
	margin-left: 10px;
	font-weight: normal;
}

</style>