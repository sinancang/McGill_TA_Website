<?php


	$file = fopen("../db/TA_performance_logs.csv", "a+") or die("unable to open file!");
	`../utils/submit_performance_log.php?user=${user}&target-ta=${target_ta}&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`


	//is review correct? Are commas protected?
	$userData = $_GET['user'] . "," .  $_GET['target-ta'] . "," . $_GET['course-code'] . "," . $_GET['course-term']  . "," . "{$_GET['review']}" . "\n";

	if(fwrite($file, $userData)){
		//echo "success";
	}
	else{
		echo "error";
	}
	fclose($file);

?>