<?php
    $course_code = $_GET['course-code'];
    $course_term = $_GET['course-term'];
    $user = $_GET['user'];

    $filename = "../db/user_data.json";
    $data = file_get_contents($filename);
    $arr = json_decode($data, true);

    echo "<option>-- Select a TA --</option>";

    foreach($arr as $key=>$value){
        //looping through each user
        for ($i=0; $i < count($value['courses']); $i++){
            //if in the given term, TA exists:
            if($value['courses'][$i]["role"] == "ta"){
                if($value['courses'][$i]["term"] == $course_term
                    && $value['courses'][$i]['course num'] == $course_code
                    && $key != $user){
                        echo "<option> $key </option>";                  
                }           
            }
        }
    }		
?>
