<?php

    //--- Routing for dashboard requests ---//

    // import utility files
    require '../utils/check_logged_in.php'; // includes function to ensure user is logged in
    require '../utils/db_operations.php'; // includes functions for db manipulation


    // maybe need to do something about this:
    $_POST['user'] = $_GET['user'];
    $_POST['new-prof'] = $_GET['new-prof'];
    $_POST['course-code'] = $_GET['course-code'];


    // check if user is logged in. if not, redirect to login page
    // WE NEED TO PASS THE SESSION TOKEN TO THE LOGIN CHECK INSTEAD!!!!
    if (check_logged_in($_GET['user']) !== 1 && check_logged_in($_POST['user']) !== 1) {
        header("Location: https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/login");
        exit();
    }


    // sys-ops: manage users
    if ($_GET['view'] == 'manage-users') {
        include("../matter/manage_users.php");
    }
    // sys-ops: add users manually
    else if ($_GET['view'] == 'add-manually-users') {         
        include("../matter/add_users_manually.php");    
    }
    // sys-ops: post new prof or admin 
    else if ($_GET['action'] == "manual-upload") {
        add_prof_course_record( 
            $_GET['new-prof'], 
            $_GET['course-code'], 
            $_GET['course-name'],
            $_GET['term']
        );    
    }      
    // main dashboard
    else if ($_GET['view'] == 'main') {         
        include("../matter/main_dashboard.php");    
    }
    // default view. used for loading dashboard first time
    else if ($_GET['view'] == 'default') {       
        include("../matter/dashboard_default.php");    
    }
    else if ($_GET['action'] == 'delete-user') {
        deactivate_user($_GET['target']);
        include("../matter/manage_users.php");
    }
    else if ($_GET['action'] == 'reactivate-user') {
        echo 'we get to reactivation';
        reactivate_user($_GET['target']);
        include("../matter/manage_users.php");
    }
    else if ($_GET['action'] == 'prof-courses-import') {
        import_profs_and_courses();
    }
    else if ($_GET['action'] == 'add-new-user-form') {
        include("../matter/add_new_user_form.php");
    }
    else if ($_GET['action'] == 'create-new-user') {
        if (pre_register_user($_GET['name'], $_GET['email'], $_GET['type']) == 1) {
            include("../matter/manage_users.php");
        }
        else {
            echo "Account already exists.";
        }
    }
    else if ($_GET['action'] == 'edit-user-form') {
        include("../matter/edit_user_form.php");
    }
    else {
        echo "Page Not Found";
    }
    
?>