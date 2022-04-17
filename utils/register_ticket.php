<?php
function register_ticket(string $ticket, string $type){
	$file = fopen("../db/tickets.csv", "a") or die ("Unable to open file!");
	$str = $ticket .  "," . $type . "\n";
	fwrite($file, $str);
}
?>
