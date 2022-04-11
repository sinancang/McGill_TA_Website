<?php

// currently only checks the validity of e-mail
// TO DO: connect to SMTP server to confirm the e-mail exists

$mail = $_GET['mail'];
if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
	echo "success";
} else {
	echo "Not a valid e-mail";
}
?>
