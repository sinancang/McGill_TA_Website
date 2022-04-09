<?php 

    /* 
    function used by sys-ops.
    Adds prof to list of pre-verified profs.
    NOTE: This ALLOWS a prof to sign up with the system BUT does NOT ACTUALLY sign up the prof!
    */
    function add_verified_prof(string $prof, string $course_code) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        // RIGHT ONLY CHECK IF USER EXISTS. WHAT IF USER EXISTS BUT NOT WITH THIS COURSE?
        // NEED TO ACCOUNT FOR THAT SCENARIO!!
        if (isset($user_data[$prof])) {
            echo "Cannot add record. Record already Exists.";
            return;
        }
        $user_data[$prof] = array('registered'=>false, 'courses' => array('course name'=>$course_code));
        file_put_contents($filename, json_encode($user_data));


        echo "Successfully added new record!";
    }







?>