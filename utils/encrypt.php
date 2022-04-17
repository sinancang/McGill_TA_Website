<?php
function encrypt_password(string $unencrypted_password){
	return hash("sha3-224", $unencrypted_password, false);
}
?>
