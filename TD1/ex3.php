<?php 
require_once("data.movies.php"); // Loading of datas, especially the movie array containing all the data

if(isset($_POST['SubmitButton'])){ //cCheck if form was submitted
	$year = $_POST['year']; // Get year
	$genre = $_POST['genre']; // Get genre
	$movies = render_movie_list($movies, $genre, $year); // Filter by genre and year
}

?> <!-- Closing the php tag to write html -->

<h1>Movies</h1>
<form action="" method="post">
	<select name="genre">
		<option value="" selected>all</option>
		<option value="Drama">Drama</option>
		<option value="Science Fiction">Science Fiction</option>
		<option value="Action">Action</option>
		<option value="Adventure">Adventure</option>
		<option value="Thriller">Thriller</option>
		<option value="Horror">Horror</option>
		<option value="Western">Western</option>
		<option value="Comedy">Comedy</option>
	</select>
	<input type="text" name="year" placeholder="year" />
	<input type="submit" name="SubmitButton"/>
</form>

<?php

if ($movies) {
	echo "<div class='container'>";
	foreach ($movies as $movie) { // For each movie, we create an item in the grid
		echo "<div class='movie'><h3>{$movie['title']}</h3>"; // Display the title
			echo "<ul>";
				echo $movie['director']; // Display the director
				echo "<div class='genre ".($movie["genre"] == 'Science Fiction' ? "sf" : "")."'>{$movie['genre']}</div>"; //Adding the class "sf", to the sci-fi movies
				if ($movie['year'] > date("Y") - 10) {
					echo "<div class='year recent'>{$movie['year']} - récent</div>"; //Adding the class "recent", to the recent movies (< 10 years old)
				} else {
					echo "<div class='year'>{$movie['year']}</div>";
				}
			echo "</ul>";
		echo "</div>";
	}
	echo "</div>";
} else { // If the movie array is empty, we display a message
	echo "Pas de données disponibles";
}

// Function that filters the movie array by genre and year (Ex : $movies = render_movie_list($movies, "Drama", 1999))
function render_movie_list($movies, $genre, $year){
	$temp_array = array();
	if ($movies) {
		if ($genre && $year) { //If the year and te genre are defined, filter by year and genre
			foreach ($movies as $movie) {
				if ($movie['genre'] == $genre && $movie['year'] == $year)
					array_push($temp_array, $movie);
			}
		} else if (!$genre && $year) { //If only the year is defined, filter by year
			foreach ($movies as $movie) {
				if ($movie['year'] == $year)
					array_push($temp_array, $movie);
			}
		} else if ($genre && !$year) { //If only the genre is defined, filter by genre
			foreach ($movies as $movie) {
				if ($movie['genre'] == $genre)
					array_push($temp_array, $movie);
			}
		} else { // No filter
			$temp_array = $movies;
		}
	}
	return $temp_array; // return the filtered array
}

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