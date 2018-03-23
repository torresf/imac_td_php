<?php 

require_once "./MyPDO.imac-movies.include.php";

$stmt = MyPDO::getInstance()->prepare("
	SELECT *
	FROM Cast
	ORDER BY lastname, firstname
");

$stmt->execute();

while (($row = $stmt->fetch()) !== false) {
	echo "<div>{$row['lastname']} {$row['firstname']}</div>";
}

?>