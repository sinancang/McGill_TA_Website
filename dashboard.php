<?php

        // before displaying dashboard, check if user is logged in
        //require 'util/check_logged_in.php';	
        $username = $_GET['user'];  

        function check_logged_in(string $username) {

            if (($file = fopen("../db/db.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($data);
    
                    if ($data[0] == $username) {
                        return 1;
                    }
    
                }
    
                fclose($file);
            }
    
            return 0;
    
        }


        if (check_logged_in($_GET['user']) === 1) {

            // display dashboard header
            include("./matter/dashboard_header.php");
            include("./matter/dashboard_content.php");
            
        
        }
        // if login check failed, redirect to login page
        else {
            header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/register.html");
        }
    

?>
