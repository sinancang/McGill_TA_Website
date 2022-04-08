<?php
$file = fopen("../db/db.csv","a+") or die("Unable to open file!!!");
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
// no other user has same username
$userData = $_POST['user'] . "," . $_POST['pass'] . "\n";
if(fwrite($file, $userData)){
	echo "success";
}
fclose($file);
?>