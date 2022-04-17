<?php
//TODO: create a data base for TA

$file = fopen("../db/TA_db.csv","r") or die("Unable to open file!");
$row = 1;

while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
	$num = count($data);

	$row++;
	
	if ($data[0] == $_POST['course'] && $data[1] == $_POST['term'] && $data[3] == $_POST['score'] && $data[4] == $_POST['comment']){
		echo "success";
	}
}

fclose($file);
?>
