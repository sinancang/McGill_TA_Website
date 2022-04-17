<?php

/* Checks if the user is logged in
 *
 * receives ticket id & permission
 * checks if ticket is in tickets.csv
 * if it is, checks if the ticket has the permission
 * if so, http 200
 * otherwise, http 404
 *
 */
function check_logged_in(string $ticket_id, string $username){
	$filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

	if (isset($user_data[$username]) && ($user_data[$username]['ticket'] == $ticket_id)){
		return true;
	}

	return false;	
}


?>
