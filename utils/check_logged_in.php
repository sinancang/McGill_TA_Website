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
function check_logged_in(string $ticket_id, string $permission){
	$file = fopen("../db/tickets.csv", "r") or die ("Unable to open file!");

	$row = 1;
	
	while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
		if ($data[0] == $ticket_id && $data[1] == $permission){
			return TRUE;
		}
	}	
	
	
	return false;
}


?>
