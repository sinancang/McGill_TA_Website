<?php

        //--- Routing for register requests ---//

        include "../utils/db_operations.php";
	include "../utils/encrypt.php";
	
	// TO DO: check valid e-mail

	// encrypt password
	$encrypted_password = encrypt_password($_POST['password']);

	$error_code;

	// attempt to register user
	if ($_POST['type'] == 'student'){
		$error_code = register_new_student($_POST['username'], $_POST['email'], $encrypted_password);
		
		if ($error_code == 1){
			http_response_code(200);
		} else {
			http_response_code(409);
		}
	} else {
		$error_code = register_new_user($_POST['username'], $_POST['email'], $encrypted_password, $_POST['type']);
		if ($error_code == 1){
			http_response_code(200);
		} else {
			http_response_code(409);
		}
	}

	// error code -1 means email already registered
	// error code 0 means username already in use (student case) or TA/Prof/Admin hasn't been pre-added
	echo $error_code;
?>
