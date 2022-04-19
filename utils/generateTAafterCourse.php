<?php

$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);
$course = $_GET['course'];
//$course="Comp 307";

static $firstTime = true;


echo "<table>";
foreach($arr as $key=>$value){
	//looping through each user 
    //key has user name in it
        $i=0;
        foreach($value as $key2=>$value2){
            if($key2=="courses"){
                echo "<tr>";
                echo "<tr>"; 
                foreach($value2 as $key3=>$value3){
                    if($value3["role"] == "ta"){
                        echo $key;
                        echo str_repeat('&nbsp;', 5); // adds 5 spaces
                        echo $value3["course num"];
                        echo str_repeat('&nbsp;', 5); // adds 5 spaces
                        echo $value3["term"];
                        echo  "<br>";
                        echo  "</td>";
                        echo "</tr>";
        

                    }
                }
                $i = $i + 1;
    
            }
        }
    
}
echo "</table>";




?>