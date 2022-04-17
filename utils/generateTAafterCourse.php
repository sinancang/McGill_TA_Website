<?php

$filename = "../db/course_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);
$course = $_GET['course'];
//$course="Comp 307";

foreach($arr as $key=>$value){
	//looping through each user 
    //key has course in it
    if($key == $course){
        //echo $key;
        $i=0;
        foreach($value as $key2=>$value2){
            if($key2=="TA"){ //has TA array
                $val = $value2[$i]["name"];
                echo " $val ";
                $i = $i + 1;
    
            }
        }
    }
}	


?>