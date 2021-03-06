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

        $coursesFile = "../db/all_courses.json";
        $contents = file_get_contents($coursesFile);
        $all_courses = json_decode($contents, true);


        $found = false;
        for ($i=0; $i<count($all_courses); $i++) {
            if ($all_courses[$i]['course code'] == $course_code) $found = true;
        }
        if (!$found) {
            $new_entry = array('course code'=>$course_code, 'course name'=>$course_name, 'term'=>$term);
            array_push($all_courses, $new_entry);
            file_put_contents($coursesFile, json_encode($all_courses, JSON_PRETTY_PRINT));
        }

        if (isset($user_data[$prof])) {
            $i = 0;
            while (isset($user_data[$prof]['courses'][$i])) {
                
                if ($user_data[$prof]['courses'][$i]['course num'] == $course_code
                    && $user_data[$prof]['courses'][$i]['term'] == $term) {
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
            //$courses_array = json_decode($courses_array, true);
            $user_data[$prof]['registered'] = false;
            $user_data[$prof]['courses'][] = $courses_array;
            $user_data[$prof]['type'] = 'prof';
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
    function register_new_user(string $username, string $email, string $password, string $role) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$username]) && !$user_data[$username]['registered']) {
            $user_data[$username]['password'] = $password;
	        $user_data[$username]['registered'] = true;
	        file_put_contents($filename, json_encode($user_data));
	    
	        // succesfully registered
	        return 1;

        } else {
            // TA/Prof/Admin hasn't been pre-added 
            return -1;
        }
    }

    function register_new_student(string $username, string $email, string $password) {
    	$filename = "../db/user_data.json";
	    $data = file_get_contents($filename);
	    $user_data = json_decode($data, true);

        // check if email is already registered
        
        for ($i = 0; $i < $user_data.count(); $i++){
            if ($user_data[$i]['email'] == $email){			
                // email already registered
                return 0;
            }
        }

        // if username already in use, don't add
        if (isset($user_data[$username])) {
            // username already registered
            return 0;

        // else, register user
        } else {

            // add user to user_data.json
            $user_data[$username]['email'] = $email;
            $user_data[$username]['registered'] = true;
            $user_data[$username]['password'] = $password;
	    $user_data[$username]['type'] = "student";

	    // default courses
	    $course_array = array('course num'=>"COMP307", 'course name'=>"Principles of Web Development",
		    "term"=>"WINTER2022", "role"=>"student");
	    $user_data[$username]['courses'][0] = $course_array;

	    $course_array1 = array('course num'=>"PSYC100", 'course name'=>"Intro to Psychology",
                    "term"=>"WINTER2022", "role"=>"student");
	    $user_data[$username]['courses'][1] = $course_array1;

	    $course_array2 = array('course num'=>"MATH140", 'course name'=>"Calculus I",
                    "term"=>"WINTER2021", "role"=>"student");
            $user_data[$username]['courses'][2] = $course_array2;

            file_put_contents($filename, json_encode($user_data));
            
            // successfully registered user
            return 1;
        }


	// TO DO: send confirmation e-mail
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
        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$user])) {
            $user_data[$user]["deactivated"] = false;
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            $date = date('F j Y, \a\t g:ia');
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
            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            $date = date('F j Y, \a\t g:ia');
            add_record_to_activity_history($_GET['user'], "Added new user {$name} as {$type}", $date);
            return 1;
        }
    }

    function set_user_data(string $user_to_edit, string $name, string $email, string $type, array $course_data) {
        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        $user_data = json_decode($data, true);

        if (isset($user_data[$user_to_edit])) {
            $user_data[$user_to_edit]['email'] = $email;
            $user_data[$user_to_edit]['type'] = $type;


            for ($i=0; $i<count($course_data); $i++) {

                for ($j=0; $j<count($user_data[$user_to_edit]['courses']); $j++) {

                    if ($user_data[$user_to_edit]['courses'][$j]['course num'] == $course_data[$i][0]) {
                        $user_data[$user_to_edit]['courses'][$j]['role'] = $course_data[$i][1];
                        break;
                    }
                }
            }

            file_put_contents($filename, json_encode($user_data, JSON_PRETTY_PRINT));
            $date = date('F j Y, \a\t g:ia');
            add_record_to_activity_history($_GET['user'], "Updated {$user_to_edit} user info", $date);
            return 1;
        }
        else {
            return 0;
        }
    }


    // Sets office hours for user (user is determined by $_GET)
    function set_office_hours() {
        echo "here 1";
        $file = fopen("../db/office_hours.csv", "a+") or die("unable to open file!");
        echo "here 2";

        //$username=$_GET['user'];
        //$coure=$_GET['course_selected'];
    
        $userData = $_GET['user'] . "," . $_GET['course-code']. "," . $_GET['course-term'] . "," . $_GET['day'] . "," . $_GET['start'] . ", " . $_GET['end'] . "," .  $_GET['location'] . ",". "{$_GET['duties']}" . "\n";
    
        echo "here 3";
        if (fwrite($file, $userData)){
            echo "success";
        }
        else {
            echo "error";
        }
        echo "here 4";
        fclose($file);
        return;
    }

?>  
