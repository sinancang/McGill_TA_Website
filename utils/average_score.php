<?php


$filename = "../db/TA_review.json";
$data = file_get_contents($filename);
$arr = json_decode($data, true);
$TA = $_GET['TA'];
//$TA="AnotherTA";

$score = 0;
$i=1;
foreach($arr as $key=>$value){
	//looping through each user 
        //echo $value["name"];
        if($value["name"] == $TA){
            $score += $value["score"];
            $score = $score / $i;
            $i += 1;
        }
}
echo $score;

?>