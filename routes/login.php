<?php

//--- Routing for login requests ---//

$file = fopen("../db/users.csv","r") or die("Unable to open file!");
$row = 1;

while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
	
	$num = count($data);

	$row++;
	
	if ($data[0] == $_POST['user'] && $data[1] == $_POST['pass']){
		echo $_POST['user'];
		fclose($file);
		exit();
	}
}
echo "fail";
fclose($file);
?>