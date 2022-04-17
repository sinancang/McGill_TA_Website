<?php

	//--- Routing for login requests ---//
	include "../utils/encrypt.php";

	$filename = "../db/user_data.json";
	$data = file_get_contents($filename);
	$user_data = json_decode($data, true);

	$username = $_POST['username'];
	$unencrypted_password =  $_POST['password'];

	$encrypted_password = encrypt_password($unencrypted_password);
	if (isset($user_data[$username])) {
		if (isset($user_data[$username]["registered"]) && $user_data[$username]["registered"] == true) {
			if ($user_data[$username]["password"] == $encrypted_password) {
				http_response_code(200);
				exit();
			}
		}
	}
	http_response_code(400);
?>
