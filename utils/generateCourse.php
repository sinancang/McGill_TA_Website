<?php
$val = $_GET['course'];


$filename = "../db/course_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);
$course = $_GET['course'];
//$course = "Comp 307"; for debug
echo "<option> Select a Course </option>";

foreach($arr as $key=>$value){
	//looping through each user 
	echo "<option> $key </option>";
    //key has course in it

}	



/*

*/


?>