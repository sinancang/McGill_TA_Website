<?php
$val = $_GET['course'];


$filename = "../db/all_courses.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);
//$course = $_GET['course'];
//$course = "Comp 307"; for debug
echo "<option> Select a Course </option>";

foreach($arr as $key=>$value){
	//looping through each user
	$course =  $value['course code'];
	echo "<option> $course </option>";
    //key has course in it

}	



/*

*/


?>