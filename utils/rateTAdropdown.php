<?php

$val = $_GET['selectvalue']; //not sure about this!


$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);


foreach($arr as $key=>$value){
	//looping through each user (key has the username in it!)
	$i=0;
	foreach($value as $key2=>$value2){
		if($key2=="courses"){ //has course array
			//if in the given term, TA exists:
			if($value2[$i]["role"] == "ta"){
                if(strcmp($val, $value2[$i]["term"]) == 0){
                    echo "<option> $key </option>";
                   
                }
				$i = $i + 1;
				
			}
			

		}
	}
}		
?>