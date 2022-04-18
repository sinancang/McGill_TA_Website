<?php
//this is for generating all TA's 
$filename = "../db/user_by_role.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);

echo "<option> Select a TA </option>";
foreach($arr as $key=>$value){
    //looping through each user (key has the username in it!)
    if($key == "ta"){
        foreach($value as $key2=>$value2){
            
            echo "<option> $value2 </option>"; 
        }
       
    }
}


$file = fopen("../db/TA_wish_list.csv", "a+") or die("unable to open file!");

$term = $_GET['term'];
$TA = $_GET['TA'];
$username = $_GET['username'];//?
$course = $_GET['selected-course']; //?

$userData = $username . "," .  $course . "," . $TA .  "," . $term . "\n";

if(fwrite($file, $userData)){
	//echo "success";
}
else{
    echo "error";
}
fclose($file);


?>