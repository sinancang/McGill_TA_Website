<?php
//change name to TAoperations!


$val = $_GET['term'];


$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);


foreach($arr as $key=>$value){
	//looping through each user (key has the username in it!)
	$i=0;
	foreach($value as $key2=>$value2){
		if($key2=="courses"){ //has course array
			//if in the given term, TA exists:
			if($value2[$i]["role"] == "TA"){
                if(strcmp($val, $value2[$i]["term"]) == 0){
                    echo "<option> $key </option>";
                   
                }
				$i = $i + 1;
				
			}
			

		}
	}
}	



$file = fopen("../db/TA_notes.csv", "a+") or die("unable to open file!");

$username=$_GET['username']; //not sure if working!
$course_selected=['course-selected'];

//is review correct? Are commas protected?
$userData = $username . "," .  $course_selected . "," . "{$_GET['review']}" . "\n";

if(fwrite($file, $userData)){
	//echo "success";
}
else{
    echo "error";
}
fclose($file);


?>