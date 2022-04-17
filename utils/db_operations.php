<?php 

    /* 
        Function used by sys-ops.
        Adds prof to list of pre-verified profs.

        NOTE: This ALLOWS a prof to sign up with the system BUT does NOT ACTUALLY sign up the prof!
    */
    function add_prof_course_record(string $prof, string $course_code, string $course_name, string $term) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$prof])) {
            $i = 0;
            while (isset($user_data[$prof]['courses'][$i])) {
                
                if ($user_data[$prof]['courses'][$i]['course num'] == $course_code) {
                    echo "Cannot add record. Record already Exists.";
                    return;
                }
                $i++;
            }
            $new_entry = array('course num'=>$course_code, 'course name' => $course_name, 'term'=>$term, 'role'=>'prof');
            $user_data[$prof]['courses'][] = $new_entry;

            if ($user_data[$prof]['type'] == 'ta' 
                || $user_data[$prof]['type'] == 'student'
                || !isset($user_data[$prof]['type'])) {
                $user_data[$prof]['type'] = 'prof';
            }

            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }
        else {
            $courses_array = array('course num'=>$course_code, 'course name'=>$course_name, 'term'=>$term, 'role'=>'prof');
            $courses_array = json_decode($courses_array, true);
            $user_data[$prof]['registered'] = false;
            $user_data[$prof]['courses'][] = $courses_array;
            //array('registered'=>false, 'courses' => $courses_array);
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
        }

        echo "Successfully added new record!";
        $date = date('F j Y, \a\t g:ia');
        add_record_to_activity_history($_GET['user'], "Added {$prof} as Professor to {$course_code}", $date);
    }


    // go through incoming file and add all records
    function import_profs_and_courses() {
        
        if (($handle = fopen("../incoming/prof_and_course_data.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $term = $data[0];
                $course_num = $data[1];
                $course_name = $data[2];
                $prof_name = $data[3];
                add_prof_course_record($prof_name, $course_num, $course_name, $term);
            }
            fclose($handle);
        }
        else {
            echo "Unable to import at this time. Please try again later or contant system operator.";
            return;
        }

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
    function deactivate_user(string $user) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$user])) {
            $user_data[$user]["deactivated"] = true;
            //$user_data = array_values($user_data);
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            $date = date('F j Y, \a\t g:ia');
            add_record_to_activity_history($_GET['user'], "Deactivated user {$user}", $date);
        }
        else {
            echo 'Server Error. Cannot deactivate user at this time';
        }
    }

    // reactivate user account
    function reactivate_user(string $user) {
        echo 'we get here';
        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$user])) {
            $user_data[$user]["deactivated"] = false;
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            add_record_to_activity_history($_GET['user'], "Reactivated user {$user}", $date);
        }
        else {
            echo 'Server Error. Cannot reactivate user at this time';
        }
    }


    // preregister a prof or admin
    function pre_register_user(string $name, string $email, string $type) {
        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$name])) {
            return 0;
        }
        else {
            $user_data[$name]['registered'] = false;
            $user_data[$name]['email'] = $email;
            $user_data[$name]['type'] = $type;
            $user_data[$name]['courses'] = '[]';
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            $date = date('F j Y, \a\t g:ia');
            add_record_to_activity_history($_GET['user'], "Added new user {$name} as {$type}", $date);
            return 1;
        }


    }

?>  
