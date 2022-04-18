<?php

function add_ta_review() {
    $file = fopen("../db/TA_review.csv", "a+") or die("unable to open file!");

    $username = $_GET['user'];
    $course = $_GET['course-code'];
    $term = $_GET['course-term'];
    $TAname =  $_GET['ta-name'];
    $score = $_GET['rating'];
    $review = $_GET['review'];

    $userData = $username . "," . $course . "," .  $term . "," . $TAname . "," . $score . "," . "{$review}" .  "\n";


    if(fwrite($file, $userData)){
        echo "success";
    }
    else{
        echo "error";
    }



    /*
    $filename = "../db/TA_review.json";

    $data = file_get_contents($filename);
    $TAdata = json_decode($data, true);

    $post_data = array(
        'name' => $TAname,
        'course' => $course,
        'term'  => $term,
        'score'  => $score,
        'review' => $review
    );
        
    $TAdata[] = $post_data;
    $final_data= json_encode($TAdata);

    if(file_put_contents("../db/TA_review.json", $final_data)){
        echo "appended";
    }
    else{
        echo "err";
    }
    */

    fclose($file);
    
}

?>