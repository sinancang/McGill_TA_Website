<?php
//this is for generating all TA's 
$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);


echo "<option> Select a TA </option>";

foreach($arr as $key=>$value){
    //looping through each user (key has the username in it!)
    $name = $value["name"];
    echo "<option> $key </option>"; 
}

$TA = $_GET['TA'];
$term = $_GET['term'];
$course_code = $_GET['course'];
$course_name;


foreach($arr as $key=>$value){
    //looping through each user (key has the username in it!)
    $name = $value["name"];
    foreach($value as $key2=>$value2){
        if($key2 == "courses"){
            foreach($value2 as $key3=>$value3){
                if($value3["course num"] == $course){
                    $course_code = $value3["course name"];
                }
            
        }
    }
}
}

if (isset($arr[$TA])) {
    $new_entry = array('course num'=>$course_num, 'course name' => $course_code, 'term'=>$term, 'role'=>'ta');
    $arr[$TA]['courses'][] = $new_entry;
    file_put_contents($filename,  json_encode($arr, JSON_PRETTY_PRINT));
}

fclose($file);



?>