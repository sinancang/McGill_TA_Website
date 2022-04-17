<?php

$val = $_GET['selectvalue']; //not sure about this!


$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);

echo "<option>-- Select a TA --</option>";
echo "hiiiii";

foreach($arr as $key=>$value){
	//looping through each user
	for ($i=0; $i < count($value['courses']); $i++){
        //if in the given term, TA exists:
        if($value2[$i]["role"] == "ta"){
            if(strcmp($val, $value2[$i]["term"]) == 0){
                echo "<option> $key </option>";
                
            }           
        }
	}
}		
?>