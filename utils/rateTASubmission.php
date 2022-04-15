<?php

//creates json object from the html form. 

$TAname =  $_POST['TA_dropdown'];
$course = $_POST['course'];
$term = $_POST['term'];
$score = $_POST['score'];
$review = $_POST['review'];


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

if(file_put_contents('TA_review.json', $final_data)){
    echo "appended";
}
else{
    echo "err";
}

?>