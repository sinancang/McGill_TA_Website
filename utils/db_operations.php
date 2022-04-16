<?php 

    /* 
        Function used by sys-ops.
        Adds prof to list of pre-verified profs.

        NOTE: This ALLOWS a prof to sign up with the system BUT does NOT ACTUALLY sign up the prof!
    */
    function add_verified_prof(string $prof, string $course_code, string $course_name, string $term) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$prof])) {
            $i = 0;
            while (isset($user_data[$prof]['courses'][$i])) {
                
                if ($user_data[$prof]['courses'][$i]['course code'] == $course_code) {
                    echo "Cannot add record. Record already Exists.";
                    return;
                }
                $i++;
            }
            $new_entry = array('course code'=>$course_code, 'course name' => $course_name, 'term'=>$term, 'role'=>prof);
            $user_data[$prof]['courses'][] = $new_entry;

            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }
        else {
            $user_data[$prof] = array('registered'=>false, 'courses' => array('course name'=>$course_code));
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }

        echo "Successfully added new record!";
        $date = date('F j Y, \a\t g:ia');
        add_record_to_activity_history($_GET['user'], "Added {$prof} as Professor to {$course_code}", $date);
    }


    // Adds email of prof to list of profs in user_by_type
    function add_to_list_of_profs(string $email) {

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
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }
        else {
            $user_data[$username][] = array('action' => $action, 'date' => $date);
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
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
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }
        else {
            //echo "Failed to register!";
            return 0;
        }

        //echo "Successfully added new record!";
        return 1;

    }


    /*

        Removes user from all databases where they are present
        Idea: Instead of removing, we could "deactivate" account?

    */
    function delete_user(string $email) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);
        echo $user_data;
        echo "\n";

        array_filter($user_data, function() {
            echo key($user_data);
            return true;
        });

        if (isset($user_data[$email])) {
            unset($user_date[$email]);
            echo 'user deleted';
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }
        else {
            echo 'Server Error. Cannot delete user at this time';
        }
    

    }

?>  
