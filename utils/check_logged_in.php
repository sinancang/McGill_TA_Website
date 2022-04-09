<?php

    

    // this is a temporary function that doesnt actually check if user is logged in!!!!
    // all it does for now is check if the user exists
    // return 1 if successful
    // 0 otherwise
    function check_logged_in(string $username) {

        $filename = "../db/user_data.json";
        $data = file_get_contents($filename);
        //echo $data;
        $users = json_decode($data, true);
        
        
        if (isset($users[$username])) {
            return 1;
            /*
            $user_data = json_decode($users[$username], true);
            if (isset($user_data["registered"]) && $user_data["registered"] == true) {
                //if ($user_data["password"] == $_POST['pass']) {
                    return 1;
                //}
            }
            */
        };


        return 0;
    }

?>