<?php

$val = $_GET['selectvalue'];


$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);



foreach($arr as $key=>$value){
	//looping through each user (key has the username in it!)
	$i=0;
	foreach($value as $key2=>$value2){
		if($key2=="courses"){ //has course array
			//if in the given term, TA exists:
			if($value2[$i]["role"] == "TA" && $value2[$i]["term"] == $val){
				$i = $i + 1;
				array_push($TANames, $key);
				echo $key;
				//creating a dropdown select option
				echo "<option> $key </option>"; 
			}
			

		}
	}
}	
?>
