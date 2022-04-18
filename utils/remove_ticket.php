<?php

$username = $_POST['username'];
$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$user_data = json_decode($data, true);
$user_data[$username]['ticket'] = null;
?>
