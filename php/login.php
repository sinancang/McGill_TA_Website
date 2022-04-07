<?php
// receives username and encrypted password
// checks the database if it finds matching user
// $username = $_POST['username']
// $password = $_POST['pass']

$file = fopen("../db/db.csv","r") or die("Unable to open file!");
$row = 1;

echo $_POST['username'];
echo $_POST['pass'];

while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
	
	$num = count($data);

	echo "<p> $num fields in line $row: <br /></p>";
	$row++;
	
	if ($data[0] == $_POST['username'] && $data[1] == $_POST['pass']){
		echo "<p>found user!</p>"
	}
}
fclose($file);
?>
