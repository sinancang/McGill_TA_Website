<?php
function register_ticket(string $ticket, string $username){
	$filename = "../db/user_data.json";
	$data = file_get_contents($filename);
	$user_data = json_decode($data, true);

	// username will always be present as this is called after login
	$user_data[$username]['ticket'] = $ticket;
}
?>
