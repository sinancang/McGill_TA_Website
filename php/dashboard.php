<?php

    require 'check_logged_in.php';


    $username = $_GET['user'];


	
	//echo $_GET['user'];
    //echo "Hello World";

    
    // before displaying dashboard, check if user is logged in
    if (check_logged_in($username) === 1) {
        display("../matter/dashboard_header.html");
        
        $file = fopen("../matter/dashboard_content.html", "r");

        while(!feof($file)) {
            $line = fgets($file);
            if (strstr($line, "Welcome User")) {
                $line = str_replace("Welcome User", "Hi, {$username}", $line);
            }


            echo $line;
        }
        fclose($file);
    
    }
    // if login check failed, redirect to login page
    else {
        header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
    }
    

?>
