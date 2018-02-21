<?php 
require_once("data.movies.php");

if ($movies) {
	echo "<h1>Liste de films</h1>";
	echo "<div class='container'>";
	foreach ($movies as $movie) {
		echo "<div class='movie'><h3>{$movie['title']}</h3>";
			echo "<ul>";
				echo $movie['director'];
				echo "<div class='genre ".($movie["genre"] == 'Science Fiction' ? "sf" : "")."'>{$movie['genre']}</div>";
				echo "<div class='year'>{$movie['year']}</div>";
			echo "</ul>";
		echo "</div>";
	}
	echo "</div>";
} else {
	echo "Pas de données disponibles";
}

?>

<style type="text/css">
.container {
	position: relative;
	font-family: "Arial";
	display: grid;
	grid-template-columns: repeat(4, 1fr);
	grid-auto-flow: row;
	grid-gap: 15px;
}
.movie {
	position: relative;
	padding: 10px;
	margin: 10px;
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
	top: 10px;
	right: 10px;
	padding: 5px;
	font-size: .8em;
	color: white;
	background-color: rgba(100,100,200, 1);
}
.genre.sf {
	background-color: rgba(10,30,230, 1);
}
</style>