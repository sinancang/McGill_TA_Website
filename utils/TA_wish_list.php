<?php
$file = fopen("../db/TA_wish_list.csv", "a+") or die("unable to open file!");


//is review correct? Are commas protected?
$userData = $_GET['user'] . "," .  $_GET['course-code'] . "," . $_GET['target-ta'] . "," . $_GET['course-term'] . "\n";

if(fwrite($file, $userData)){
}
else{
    echo "error";
}
fclose($file);

?>