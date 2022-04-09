<?php

    //--- Routing for dashboard requests ---//

    // import utility files
    require '../utils/check_logged_in.php'; // includes function to ensure user is logged in
    require '../utils/db_operations.php'; // includes functions for db manipulation

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
        // sys-ops: post new prof and course
        // do sanity check for adding new prof
        else if ($_POST['new-prof'] !== "" && $_POST['course-code'] !== "") {
            // echo 1 if successful, 0 otherwise
            echo add_verified_prof($_POST['new-prof'], $_POST['course-code']);
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