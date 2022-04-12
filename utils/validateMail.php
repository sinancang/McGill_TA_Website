<?php

// currently only checks the validity of e-mail
// TO DO: connect to SMTP server to confirm the e-mail exists

echo 'we got here 1';

$mail = $_GET['mail'];
echo $mail;
if (filter_var($mail, FILTER_VALIDATE_EMAIL) != false){
	echo 'we got here 2';
	echo "success";
} else {
	echo "Not a valid e-mail";
}
?>
