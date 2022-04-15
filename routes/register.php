<?php

        //--- Routing for register requests ---//

        include "../utils/db_operations.php";
	include "../utils/encrypt.php";
	
	// TO DO: check valid e-mail

	// encrypt password
	$encrypted_password = encrypt_password($_POST['password']);

	// attempt to register user
	if ($_POST['type'] == 'student'){
		
		if (register_new_student($_POST['username'], $_POST['email'], $encrypted_password) == 1){
			http_response_code(200);
		} else {
			http_response_code(409);
		}
	} else {
		// TO DO: implement register for TA, ADMIN OR PROF
	}
?>
