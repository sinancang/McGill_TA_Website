<?php

    

    // this is a temporary function that doesnt actually check if user is logged in!!!!
    // all it does for now is check if the user exists
    // return 1 if successful
    // 0 otherwise
    function check_logged_in(string $username) {

        if (($file = fopen("../db/db.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($data);

                echo $data[0];
                if ($data[0] == $username) {
                    return 1;
                }

            }

            fclose($file);
        }

        return 0;

    }

?>
