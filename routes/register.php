<?php
	//--- Routing for register requests ---//

        include "../utils/db_operations.php";
	include "../utils/encrypt.php";
	
	// TO DO: check valid e-mail

	// encrypt password
	$encrypted_password = encrypt_password($_POST['password']);

	$error_code = -3;
	
	// attempt to register user
	if ($_POST['type'] == 'student'){
		if(register_new_student($_POST['username'], $_POST['email'], $encrypted_password) == 1){
			// success
			http_response_code(200);
		} else {
			// username or email already exists
			http_response_code(409);
		}
	} else {
		if (register_new_user($_POST['username'], $_POST['email'], $encrypted_password, $_POST['type']) == 1){
			// success
			http_response_code(200);
		} else {
			// TA/Prof/Admin hasn't been pre-added, resource not found
			http_response_code(404);
		}
	}
?>
