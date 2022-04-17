<?php

	//--- Routing for login requests ---//
	include "../utils/encrypt.php";
	include "../utils/register_ticket.php";

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
				$ticket_id = uniqid(TRUE);
				register_ticket($ticket_id, $user_data[$username]['type']);
				echo $ticket_id;
				exit();
			}
		}
	}
	http_response_code(400);


	// TO DO: generate and add token to url
?>
