<?php
$file = fopen("../db/db.csv","r") or die("Unable to open file!");
$row = 1;

while (($data = fgetcsv($file, 1000, ",")) !== FALSE){

        $num = count($data);

        $row++;

        if ($data[0] == $_POST['user']){
                echo "failure";
		fclose($file);
		exit();
	}
}

fclose($file);
?>
