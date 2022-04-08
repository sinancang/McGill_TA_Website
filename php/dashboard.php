<?php

    require 'check_logged_in.php';

    $username = $_POST['user'];
	
	echo $username;

    /*
    // before displaying dashboard, check if user is logged in
    if (check_logged_in($username) === 1) {
        readfile("../matter/dashboard.html");
    }
    // if login check failed, redirect to login page
    else {
        header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
    }
    */

?>
