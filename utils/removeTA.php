<?php
//this is for generating all TA's 
$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);

$TA = $_GET['TA'];
$term = $_GET['term'];
$course_num = $_GET['course'];

//$course_name;
$course_num = "COMP202";
$TA = "Julia Alberini";
$exists = false;


if (isset($arr[$TA])) {
    foreach($arr as $key=>$value){
        //looping through each user (key has the username in it!
        $name = $value["name"];
        foreach($value as $key2=>$value2){
            if($key2 == "courses"){
                foreach($value2 as $key3=>$value3){
                    $i = 0;
                    if($value3["course num"] == $course_num && $value3["role"] == "ta"){
                        $exists = true;
                        unset($arr[$TA]['courses'][$i]);
                        $course_code = $value3["course name"];
                        $i = $i + 1;
                    }
                
            }
        }
    }
}
file_put_contents($filename,  json_encode($arr, JSON_PRETTY_PRINT));
if($exists == false){
    echo "TA is already not in the course!";
}

}
else{
    echo "User doesn't exist";
}

fclose($file);



?>