<?php

    //--- Routing for dashboard requests ---//

    // import utility files
    require '../utils/check_logged_in.php'; // includes function to ensure user is logged in

    // check if user is logged in. if not, redirect to login page
    // WE NEED TO PASS THE SESSION TOKEN TO THE LOGIN CHECK INSTEAD!!!!
    if (check_logged_in($_GET['user']) === 1) {


        // sys-ops: manage users
        if ($_GET['view'] == 'manage-users') {
            include("../matter/manage_users.php");    
        }
        // sys-ops: import users (csv file)
        else if ($_GET['view'] == 'import-users') {              
            include("../matter/import_users.php");    
        }
        // sys-ops: add users manually
        else if ($_GET['view'] == 'add-manually-users') {         
            include("../matter/add_users_manually.php");    
        }
        // main dashboard
        else if ($_GET['view'] == 'main') {         
            include("../matter/main_dashboard.php");    
        }
        // if no view specified, load whole dashboard because we
        // assume it's the first time dashboard is requested
        else if ($_GET['user'] != ""){
            include("../matter/dashboard_default.php");
        }
        else {
            echo "Page Not Found";
        }
    }
    // if login check failed, redirect to login page
    else {
        header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
    }

    

?>