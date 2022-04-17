<?php
$file = fopen("../db/TA_wish_list.csv", "a+") or die("unable to open file!");

$username=$_GET['username']; //not sure if working!
$course_selected=['course_selected'];

//is review correct? Are commas protected?
$userData = $username . "," .  $course_selected . "," . $_GET['TA'] . "," . $_GET['term'] . "\n";

if(fwrite($file, $userData)){
	//echo "success";
}
else{
    echo "error";
}
fclose($file);

?>