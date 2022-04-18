<?php


$file = fopen("../db/TA_review.csv", "a+") or die("unable to open file!");

$username=$_GET['username']; //not sure if working!
$course = $_POST['course_selected']; //the naming true??
$term = $_POST['term'];
$TAname =  $_POST['TA_dropdown'];
$score = $_POST['score'];
$review = $_POST['review'];

$userData = $username . "," . $course . "," .  $term . "," . $TAname . "," . $score . "," . "{$review}" . ","  .  "\n";


if(fwrite($file, $userData)){
	echo "success";
}
else{
    echo "error";
}




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

fclose($file);

?>