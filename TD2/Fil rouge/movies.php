<?php

require_once("data.movies.php");
require_once("functions.php");

$main = "";

$title = $_GET["title"] ? $_GET["title"] : "";
$date_start = $_GET["date_start"] ? $_GET["date_start"] : "";
$date_end = $_GET["date_end"] ? $_GET["date_end"] : "";
$genres = isset($_GET["genres"]) ? $_GET["genres"] : "";
$director = $_GET["director"] ? $_GET["director"] : "";

$movies = searchMovies($movies, $title, $date_start, $date_end, $genres, $director);

if ($movies) {
	$main .= "<div class='container'>";
	foreach ($movies as $movie) { // For each movie, we create an item in the grid
		$main .= "<div class='movie'><h3>{$movie['title']}</h3>"; // Display the title
			$main .= "<ul>";
				$main .= $movie['director']; // Display the director's name
				$main .= "<div class='genre'>{$movie['genre']}</div>";
				$main .= "<div class='year'>{$movie['releaseDate']}</div>";
			$main .= "</ul>";
		$main .= "</div>";
	}
	$main .= "</div>";
} else { // If the movie array is empty, we display a message
	$main = "Pas de données disponibles";
}

echo $main;

?>



<!-- Additional CSS -->
<style type="text/css">
body {
	font-family: Open Sans, Arial;
}
h1 {
	text-align: center;
}
.container {
	position: relative;
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	grid-auto-flow: row;
	grid-gap: 20px;
	padding: 0 15%;
}
.movie {
	position: relative;
	padding: 10px 10px 50px 10px;
	background-color: rgba(0,0,0,.1);
}
.movie h3 {
	margin: 0;
}
.movie ul {
	padding: 0;
}
.genre {
	position: absolute;
	bottom: 10px;
	right: 10px;
	padding: 5px;
	font-size: .8em;
	color: white;
	background-color: #555;
}
.genre.sf {
	background-color: rgba(10,70,230, 1);
}

.year {
	position: absolute;
	bottom: 10px;
	left: 10px;
	padding: 5px;
	font-size: .8em;
	color: white;
	background-color: #555;
}
.year.recent {
	background-color: #f34141;
}

form {
	text-align: center;
}
form input, select {
	padding: 5px;
	text-align: center;
}
</style>