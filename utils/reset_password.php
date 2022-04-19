<?php

require "./encrypt.php";
$old_password = $_POST['password_old'];
$new_password = $_POST['password_new'];
$username = $_POST['username'];

$filename = ",,/db/user_data.json";
$data = file_get_contents($filename);
$user_data = json_decode($data, true);

$encrypted_old_password = encrypt_password($old_password);

if ($user_data[$username]['password'] == $encrypted_old_password){
	$encrypted_new_password = encrypt_password($new_password);
	$user_data[$username]['password'] = $encrypted_new_password;
	http_response_code(200);
} else {
	http_response_code(400);
}
?>
