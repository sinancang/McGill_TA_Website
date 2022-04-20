<?php
$username = $_POST['username'];
$course_term = $_POST['course_term'];
$course_name = $_POST['course_name'];
$course_code = $_POST['course_code'];

$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$user_data = json_decode($data, true);

$new_course = array('course num'=>$course_code, 'course name'=>$course_name, 'term'=>$course_term, 'role'=>'student');
$user_data[$username]['courses'][] = $new_course;
file_put_contents($filename, json_encode($user_data));
http_response_code(200);

?>
