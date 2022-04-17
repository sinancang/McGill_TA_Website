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
	
	
	
	
	return true;
}


?>
