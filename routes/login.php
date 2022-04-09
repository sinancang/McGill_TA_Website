<?php

//--- Routing for login requests ---//

$filename = "../db/user_data.json";
$data = file_get_contents($filename);
$user_data = json_decode($data, true);


if (isset($user_data[$_POST['user']])) {

	if (isset($user_data[$_POST['user']]["registered"]) && $user_data[$_POST['user']]["registered"] == true) {
		if ($user_data[$_POST['user']]["password"] == $_POST['pass']) {
			echo $_POST['user'];
			exit();
		}
	}
};

echo "fail";

?>