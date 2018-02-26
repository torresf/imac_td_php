<?php

$main;

$main = "<form action='' method='post'>
			<input type='text' name='number' placeholder='number' />
			<input type='submit' name='SubmitButton'/>
		</form>";

if(isset($_POST['SubmitButton'])){ // Check if form was submitted
	$number = $_POST['number']; // Get number
	$main = $main."<ul>";
	for ($i = 0; $i <= 10; $i++) { 
		$main = $main."<li>".$number."x".$i." = ". $number*$i."</li>";
	}
	$main = $main."</ul>";
}

echo $main;

