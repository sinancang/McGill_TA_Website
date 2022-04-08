<?php

    require 'util/check_logged_in.php';
	
	//echo $_GET['user'];
    //echo "Hello World";

    $username = $_GET['user'];

    
    // before displaying dashboard, check if user is logged in
    if (check_logged_in($_GET['user']) === 1) {


        // display dashboard header
        include("matter/dashboard_header.php");
        include("matter/dashboard_content.php");
        
    
    }
    // if login check failed, redirect to login page
    else {
        header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
    }
    

?>
