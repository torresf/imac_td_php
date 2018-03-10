<?php

function searchMovies($movies, $title, $date_start, $date_end, $genres, $director) {

	// Initialise les dates de début et de fin si elles ne sont pas définies
	if (!(empty($date_start) && empty($date_end))) {
		$date_start = $date_start ? DateTime::createFromFormat('Y-m-j', $date_start) : DateTime::createFromFormat('Y-m-j', "0001-01-01");
		$date_end = $date_end ? DateTime::createFromFormat('Y-m-j', $date_end) : new DateTime("now");
	}

	$temp_array = array();

	if ($movies) {
		foreach ($movies as $movie) {

			// Converti la date du film en objet DateTime pour pouvoir la comparer avec $date_start et $date_end
			$releaseDate = DateTime::createFromFormat('Y-m-j', $movie['releaseDate']);

			// On vérifie que les critères de recherches sont valides
			if (!empty($title)) {
				if (!empty($director)) {
					// strpos permet de vérifier que la chaine de caractère est bien présente dans le chaine en premier paramètre
					if (strpos($movie['title'], $title) !== false || ($releaseDate >= $date_start && $releaseDate <= $date_end) || strpos($movie['director'], $director) !== false) {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							}
						} else {
							array_push($temp_array, $movie);
						}
					} else {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							} 
						}
					}
				} else {
					if (strpos($movie['title'], $title) !== false || ($releaseDate >= $date_start && $releaseDate  <= $date_end)) {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							} 
						} else {
							array_push($temp_array, $movie);
						}
					} else {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							} 
						}
					}
				}
			} else {
				if (!empty($director)) {
					if (($releaseDate >= $date_start && $releaseDate  <= $date_end) || strpos($movie['director'], $director) !== false) {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							} 
						} else {
							array_push($temp_array, $movie);
						}
					} else {
						if (!empty($genres)) {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							} 
						}
					}
				} else {
					if (!empty($genres)) {
						if ($releaseDate >= $date_start && $releaseDate  <= $date_end) {
							array_push($temp_array, $movie);
						} else {
							foreach ($genres as $genre) {
								if ($movie['genre'] == $genre) {
									array_push($temp_array, $movie);
								}
							}
						}
					} else {
						if ($releaseDate >= $date_start && $releaseDate  <= $date_end) {
							array_push($temp_array, $movie);
						}
					}
				}
			}
		}
	}
	return $temp_array; // On retourne le tableau trié
}

?>