<?php

/* Checks if the user is logged in
 *
 */
function check_logged_in(string $ticket_id, string $username){
<<<<<<< HEAD
	$filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

	if (isset($user_data[$username]) && ($user_data[$username]['ticket'] == $ticket_id)){
		return true;
	}

	return false;	
=======
        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$username]) && ($user_data[$username]['ticket'] == $ticket_id)){
                return true;
        }

        return false;
>>>>>>> e69944a26aa18b0cd43d1a49fd0e051ee9ddb949
}


?>
