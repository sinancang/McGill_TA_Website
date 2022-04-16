<?php

$filename = "../db/user_by_role.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);

foreach($arr as $key=>$value){
    //looping through each user (key has the username in it!)
	
    if($key == "ta"){
        foreach($value as $key2=>$value2){
            
            echo "<option> $value2 </option>"; 
        }
       
    }
}


//how to handle comma seperated values? Problem in formatting!
$file = fopen("../db/TA_notes.csv", "a+") or die("unable to open file!");

$username="SomeUser1"; //have to fix this!!!!

$userData = $username . "," .  $_GET['review'] . "\n";

if(fwrite($file, $userData)){
	echo "success";
}
else{
    echo "error";
}
fclose($file);


?>