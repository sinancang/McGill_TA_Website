<?php 

    /* 
    function used by sys-ops.
    Adds prof to list of pre-verified profs.
    NOTE: This allows a prof to sign up with the system BUT does NOT sign up the prof!

    If prof, course combo already exists, does nothing.
    Otherwise, appends prof, course to csv file
    */
    function add_verified_prof(string $prof, string $course_code) {


        $file = fopen("../db/verified_profs.csv","r") or die("Unable to open file first!");
        $row = 1;

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE){
	
            $num = count($data);

            $row++;
            
            if ($data[0] == $prof && $data[1] == $course_code){
                echo 'Failed to add record. Record already exists.';
                fclose($file);
                exit;
            }
        }

        $file = fopen("../db/verified_profs.csv","a") or die("Unable to open file!");
        $line = array($prof, $course_code);

        fputcsv($file, $line);
        fclose($file);

        echo "Successfully added course {$course_code} for professor {$prof}.";
    }







?>