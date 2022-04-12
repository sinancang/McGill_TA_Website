<?php 

    /* 
        Function used by sys-ops.
        Adds prof to list of pre-verified profs.

        NOTE: This ALLOWS a prof to sign up with the system BUT does NOT ACTUALLY sign up the prof!
    */
    function add_verified_prof(string $prof, string $course_code) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$prof])) {
            $i = 0;
            while (isset($user_data[$prof]['courses'][$i])) {
                
                if ($user_data[$prof]['courses'][$i]['course name'] == $course_code) {
                    echo "Cannot add record. Record already Exists.";
                    return;
                }
                $i++;
            }
            $user_data[$prof]['courses'][]['course name'] = $course_code;
            file_put_contents($filename, json_encode($user_data));
        }
        else {
            $user_data[$prof] = array('registered'=>false, 'courses' => array('course name'=>$course_code));
            file_put_contents($filename, json_encode($user_data));
        }

        echo "Successfully added new record!";
        $date = date('F j Y, \a\t g:ia');
        add_record_to_activity_history($_POST['user'], "Added {$prof} as Professor to {$course_code}", $date);
    }


    /* 
        Adds entry to activity history of specific user

        username: email or username of user who performed the activity
        action: action (as a string) that user performed
        date: date and time when action was performed
    */
    function add_record_to_activity_history(string $username, string $action, string $date) {

        $filename = "../db/activity_history.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$username])) {
            $new_entry = array('action' => $action, 'date' => $date);
            array_push($user_data[$username], $new_entry);
            file_put_contents($filename, json_encode($user_data));
        }
        else {
            $user_data[$username][] = array('action' => $action, 'date' => $date);
            file_put_contents($filename, json_encode($user_data));
        }
    }


    // New user registration
    function register_new_user(string $email, string $password) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$email])) {

            $user_data[$email]['password'] = $password;
            $user_data[$email]['registered'] = true;
            file_put_contents($filename, json_encode($user_data));
        }
        else {
            echo "Failed to register!";
            return 0;
        }

        echo "Successfully added new record!";
        return 1;

    }

?>  
