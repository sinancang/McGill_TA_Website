<?php


//what to do with the additional duties?


$file = fopen("../db/office_hours.csv", "a+") or die("unable to open file!");

$username="SomeUser1";

$userData = $username . "," .  $_GET['day'] . "," . $_GET['start'] . ", " . $_GET['end'] . "," . $_GET['location'] . "\n";

if(fwrite($file, $userData)){
	echo "success";
}
else{
    echo "error";
}
fclose($file);

?>