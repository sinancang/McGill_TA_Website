<?php
// receives username and encrypted password
// checks the database if it finds matching user
// $username = $_POST['username']
// $password = $_POST['pass']

$file = fopen("../db/db.csv","r") or die("Unable to open file!");
$row = 1;
while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
	
	$num = count($data);

	echo "<p> $num fields in line $row: <br /></p>/n";
	
	$row++;
	for ($c = 0; $c < $num; $c++){
		echo $data[$c] . "<br />\n"
	}
}

fclose($file);
?>
