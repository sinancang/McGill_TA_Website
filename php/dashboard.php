<?php

    require 'check_logged_in.php'; // includes function to ensure user is logged in



    if ($_GET['view'] == 'manage-users') {
        if (check_logged_in($_GET['user']) === 1) {
            
            include("../matter/manage_users.php");    
        }
        else {
            echo 'fail';
        }
    }
    else if ($_GET['view'] == 'add-manually-users') {
        if (check_logged_in($_GET['user']) === 1) {
            
            include("../matter/add_users_manually.php");    
        }
        else {
            echo 'fail';
        }
    }
    else {
        // before displaying dashboard, check if user is logged in
        $username = $_GET['user'];
        if (check_logged_in($_GET['user']) === 1) {
            // display dashboard header
            include("../matter/dashboard_header.php");
            include("../matter/dashboard_content.php");
            
        
        }
        // if login check failed, redirect to login page
        else {
            header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
        }
    }

    

?>